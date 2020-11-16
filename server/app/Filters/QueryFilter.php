<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

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

        $filterable = $this->filterable($this->request);
        $filter = $this->request->query('filter', []);

        foreach ($filter as $field => $value) {
            if (empty($filterable) || in_array($field, $filterable)) {
                if (is_array($value)) {
                    foreach ($value as $op => $val) {
                        $method = Str::camel($field).Str::camel($op);

                        if (method_exists($this, $method)) {
                            $this->builder = call_user_func(
                                [$this, $method], $val
                            );
                        } else {
                            switch ($op) {
                                case 'l':
                                    $this->builder = $this->builder->where($field, '<', $val);
                                    break;
                                case 'le':
                                    $this->builder = $this->builder->where($field, '<=', $val);
                                    break;
                                case 'g':
                                    $this->builder = $this->builder->where($field, '>', $val);
                                    break;
                                case 'ge':
                                    $this->builder = $this->builder->where($field, '>=', $val);
                                    break;
                                case 'in':
                                    $this->builder = $this->builder->whereIn($field, explode(',', $val));
                                    break;
                            }
                        }
                    }
                } else {
                    $method = Str::camel($field);

                    if (method_exists($this, $method)) {
                        $this->builder = call_user_func(
                            [$this, $method], $value
                        );
                    } else {
                        $this->builder = $this->builder->where($field, $value);
                    }
                }
            }
        }

        if ($this->request->query('sort')) {
            $sortable = $this->sortable($this->request);
            $order = 'asc';
            $field = $this->request->query('sort');

            if (strpos($field, '-') === 0) {
                $order = 'desc';
                $field = substr($field, 1);
            }

            if (empty($sortable) || in_array($field, $sortable)) {
                $this->builder = $this->sort($field, $order);
            }
        }

        return $this->builder;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function sortable(Request $request)
    {
        return [
            //
        ];
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function filterable(Request $request)
    {
        return [
            //
        ];
    }

    /**
     * @param  string  $field
     * @param  string  $order
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function sort($field, $order)
    {
        return $this->builder->orderBy($field, $order);
    }
}
