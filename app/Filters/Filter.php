<?php
namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filter
{
    protected $request;
    protected $builder;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filterName => $filterValue) {
            if (!$this->shouldFilter($filterName)) {
                continue;
            }

            $this->$filterName($filterValue);
        }

        return $this->builder;
    }

    public function getFilters()
    {
        return $this->request->only($this->filters);
    }

    /**  
     * We should only filter if the filter method exists AND 
     * it is present in the query string.
     */
    public function shouldFilter($filter)
    {
        return method_exists($this, $filter) && $this->request->has($filter);
    }
}
