<?php

namespace App\Http\Filters;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class QueryFilter
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $ignoreParams = [
        'lang',
        'page',
        'limit',
    ];

    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        $casts = $this->casts($this->request);
        $filterable = $this->filterable($this->request);

        foreach ($this->request->query() as $param => $value) {
            if (isset($casts[$param])) {
                $param = $casts[$param];
            }

            if (in_array($param, $this->ignoreParams)) {
                continue;
            }

            if (! empty($filterable) && ! in_array($param, $filterable)) {
                continue;
            }

            if (is_array($value)) {
                foreach ($value as $op => $val) {
                    $method = Str::camel('filter_'.$param.'_'.$op);

                    if (method_exists($this, $method)) {
                        call_user_func(
                            [$this, $method], $val
                        );
                    } else {
                        switch ($op) {
                            case 'l':
                                $this->builder = $this->builder->where($param, '<', $val);
                                break;
                            case 'le':
                                $this->builder = $this->builder->where($param, '<=', $val);
                                break;
                            case 'g':
                                $this->builder = $this->builder->where($param, '>', $val);
                                break;
                            case 'ge':
                                $this->builder = $this->builder->where($param, '>=', $val);
                                break;
                            case 'in':
                                $this->builder = $this->builder->whereIn($param, explode(',', $val));
                                break;
                            case 'like':
                                $this->builder = $this->builder->where($param, 'like', '%'.$val.'%');
                                break;
                        }
                    }
                }
            } else {
                $method = Str::camel('filter_'.$param);

                if (method_exists($this, $method)) {
                    call_user_func(
                        [$this, $method], $value
                    );
                } else {
                    $this->builder = $this->builder->where($param, $value);
                }
            }
        }

        return $this->builder;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function casts(Request $request)
    {
        return [];
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return string[]
     */
    protected function filterable(Request $request)
    {
        return [];
    }

    /**
     * @param  string  $field
     * @return void
     */
    protected function filterSortAsc($field)
    {
        $this->builder = $this->builder->orderBy($field, 'asc');
    }

    /**
     * @param  string  $field
     * @return void
     */
    protected function filterSortDesc($field)
    {
        $this->builder = $this->builder->orderBy($field, 'desc');
    }
}
