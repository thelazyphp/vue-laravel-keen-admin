<?php

namespace App\Parsing\Parsers;

use App\Models\Ad;
use Throwable;
use App\Parsing\Rule;
use GuzzleHttp\Client;
use App\Parsing\DOM\Document;

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
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $clientOptions = [
        'cookies' => true,

        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36',
        ],
    ];

    /**
     * @param  \GuzzleHttp\Client|null  $client
     */
    public function __construct(?Client $client = null)
    {
        $this->registerRules();
        $this->client = $client ?? $this->makeClient();
    }

    /**
     * @param  int|null  $limit
     * @return float|false
     */
    public function start($limit = null)
    {
        error_reporting(0);
        set_time_limit(0);

        $start = microtime(true);
        $document = new Document();
        $links = $this->parseLinks($limit);

        foreach ($links as $url) {
            try {
                $res = $this->client->get($url);
            } catch (Throwable $e) {
                //

                continue;
            }

            if (!$document->loadHTML((string) $res->getBody())) {
                //

                continue;
            }

            $attributes = [];

            foreach ($this->rules as $name => $value) {
                if ($value instanceof Rule) {
                    $value = $value->evaluate($document);
                }

                $attributes[$name] = $value;
            }

            $this->attributesParsed($document, $url, $attributes);

            $search = [
                'category' => $this->category,
                'source' => $this->source,
                'url' => $url,
            ];

            try {
                $ad = Ad::updateOrCreate($search, $attributes);
                $this->modelCreated($document, $url, $ad);
            } catch (Throwable $e) {
                //

                continue;
            }
        }

        return microtime(true) - $start;
    }

    /**
     * @param  \App\Parsing\DOM\Document  $document
     * @param  string  $url
     * @param  array  $attributes
     * @return void
     */
    protected function attributesParsed(Document $document, $url, &$attributes)
    {
        //
    }

    /**
     * @param  \App\Parsing\DOM\Document  $document
     * @param  string  $url
     * @param  \App\Models\Ad  $model
     * @return void
     */
    protected function modelCreated(Document $document, $url, Ad $model)
    {
        // $model->save();
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function makeClient()
    {
        return new Client($this->clientOptions);
    }

    /**
     * @abstract
     * @return void
     */
    abstract protected function registerRules();

    /**
     * @abstract
     * @param  int|null  $limit
     * @return array
     */
    abstract protected function parseLinks(?int $limit = null): array;
}
