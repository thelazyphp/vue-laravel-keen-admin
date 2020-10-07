<?php

namespace App\Parsing\Parsers;

use GuzzleHttp\Client;
use Throwable;
use App\Parsing\DOM\Document;
use App\Parsing\Rule;
use App\Models\Ad;

/**
 * @abstract
 */
abstract class Parser
{
    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $options = [
        'client' => [
            //
        ],
    ];

    /**
     * @var string[]
     */
    protected $proxy = [
        //
    ];

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var bool
     */
    protected $useProxy = false;

    /**
     * @param  null|\GuzzleHttp\Client  $client
     * @param  bool  $useProxy
     */
    public function __construct(?Client $client = null, $useProxy = false)
    {
        $this->registerRules();

        $options = [
            'cookies' => true,

            'headers' => [
                'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36',
            ],
        ];

        $this->client = $client ?? new Client(array_merge_recursive($options, $this->options['client']));
        $this->useProxy = $useProxy;
    }

    /**
     * @return false|float
     */
    public function start()
    {
        set_time_limit(0);

        $start = microtime(true);

        try {
            $this->parse();
        } catch (Throwable $e) {
            //

            return false;
        }

        return microtime(true) - $start;
    }

    /**
     * @return void
     */
    protected function registerRules()
    {
        //
    }

    /**
     * @return void
     */
    protected function parse()
    {
        //
    }

    /**
     * @param  string  $url
     * @return void
     */
    protected function parsePage($url)
    {
        $document = new Document();

        try {
            $res = $this->client->get($url);
        } catch (Throwable $e) {
            //

            return;
        }

        if (!$document->loadHTML((string) $res->getBody())) {
            //

            return;
        }

        $attributes = [];

        foreach ($this->rules as $key => $value) {
            if ($value instanceof Rule) {
                $value = $value->evaluate($document);
            }

            $attributes[$key] = $value;
        }

        $this->attributesParsed(
            $document,
            $url,
            $attributes
        );

        try {
            $model = Ad::updateOrCreate([
                'category' => $this->category,
                'source'   => $this->source,
                'url'      => $url,
            ], $attributes);

            $this->modelCreated(
                $document,
                $url,
                $model,
                $attributes
            );

            $model->save();
        } catch (Throwable $e) {
            //

            return;
        }
    }

    /**
     * @param  \App\Parsing\DOM\Document  $document
     * @param  string  $url
     * @param  array  $attributes
     * @return void
     */
    protected function attributesParsed(
        Document $document,
        $url,
        &$attributes)
    {
        if (
            empty($attributes['price_sq_m_amount'])
            && !empty($attributes['price_amount'])
            && !empty($attributes['size_total'])
        ) {
            $attributes['price_sq_m_amount'] = ceil(
                $attributes['price_amount'] / $attributes['size_total']
            );
        }
    }

    /**
     * @param  \App\Parsing\DOM\Document  $document
     * @param  string  $url
     * @param  \App\Models\Ad  $model
     * @param  array  $attributes
     * @return void
     */
    protected function modelCreated(
        Document $document,
        $url,
        Ad $model,
        &$attributes)
    {
        $history = $model->price_history;

        if (count($history) > 100) {
            $history = [];
        }

        if (
            !empty($model->price_amount)
            && (empty($history)
                || $history[count($history) - 1]['amount'] != $model->price_amount)
        ) {
            $history[] = [
                'date'     => $model->published_at,
                'amount'   => $model->price_amount,
                'currency' => $model->price_currency,
            ];
        }

        $model->price_history = $history;

        $history = $model->price_sq_m_history;

        if (count($history) > 100) {
            $history = [];
        }

        if (
            !empty($model->price_sq_m_amount)
            && (empty($history)
                || $history[count($history) - 1]['amount'] != $model->price_sq_m_amount)
        ) {
            $history[] = [
                'date'     => $model->published_at,
                'amount'   => $model->price_sq_m_amount,
                'currency' => $model->price_sq_m_currency,
            ];
        }

        $model->price_sq_m_history = $history;
    }
}
