<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class Filter
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
    public function filter(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $key => $value) {
            $method = Str::camel($key);

            if (strpos($value, ':') !== false) {
                $method .= Str::camel(
                    explode(':', $value, 1)[0]
                );
            }

            if (method_exists($this, $method)) {
                $this->builder = call_user_func([$this, $method], $value);
            } elseif (strpos($value, ':') === false) {
                $this->builder = $this->builder->where($key, $value);
            } else {
                [$op, $value] = explode(':', $value, 2);

                switch ($op) {
                    case 'like':
                        $this->builder = $this->builder->where($key, 'like', '%'.$value.'%');
                        break;
                    case 'not':
                        $this->builder = $this->builder->where($key, '<>', $value);
                        break;
                    case 'eq':
                        $this->builder = $this->builder->where($key, $value);
                        break;
                    case 'lt':
                        $this->builder = $this->builder->where($key, '<', $value);
                        break;
                    case 'le':
                        $this->builder = $this->builder->where($key, '<=', $value);
                        break;
                    case 'gt':
                        $this->builder = $this->builder->where($key, '>', $value);
                        break;
                    case 'ge':
                        $this->builder = $this->builder->where($key, '>=', $value);
                        break;
                    case 'in':
                        $this->builder = $this->builder->whereIn($key, explode(',', $value));
                        break;
                    case 'not_in':
                        $this->builder = $this->builder->whereNotIn($key, explode(',', $value));
                        break;
                }
            }
        }

        return $builder;
    }
}
