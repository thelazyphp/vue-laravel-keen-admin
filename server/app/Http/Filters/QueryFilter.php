<?php

namespace App\Http\Filters;

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
     * @var string
     */
    protected $searchParam = 'q';

    /**
     * @var string
     */
    protected $sortParam = 'sort';

    /**
     * @var string
     */
    protected $filterParam = 'filter';

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

        if ($this->request->query($this->searchParam)) {
            $this->searchBy(
                $this->request->query($this->searchParam)
            );
        }

        if ($this->request->query($this->sortParam)) {
            $sortable = $this->sortable($this->request);

            foreach ($this->request->query($this->sortParam) as $order => $field) {
                if (empty($sortable) || in_array($field, $sortable)) {
                    $this->sortBy($field, $order);
                }
            }
        }

        if ($this->request->query($this->filterParam)) {
            $filterable = $this->filterable($this->request);

            foreach ($this->request->query($this->filterParam) as $field => $value) {
                if (empty($filterable) || in_array($field, $filterable)) {
                    if (is_array($value)) {
                        foreach ($value as $op => $val) {
                            $method = Str::camel($field).Str::camel($op);

                            if (method_exists($this, $method)) {
                                call_user_func(
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
                            call_user_func(
                                [$this, $method], $value
                            );
                        } else {
                            $this->builder = $this->builder->where($field, $value);
                        }
                    }
                }
            }
        }

        return $this->builder;
    }

    /**
     * @param  string  $search
     * @return void
     */
    protected function searchBy($search)
    {
        //
    }

    /**
     * @param  string  $field
     * @param  string  $order
     * @return void
     */
    protected function sortBy($field, $order)
    {
        $this->builder = $this->builder->orderBy(
            $field, $order
        );
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return string[]
     */
    protected function sortable(Request $request)
    {
        return [
            //
        ];
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return string[]
     */
    protected function filterable(Request $request)
    {
        return [
            //
        ];
    }
}
