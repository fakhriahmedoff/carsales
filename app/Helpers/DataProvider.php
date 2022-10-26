<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Itstructure\GridView\DataProviders\EloquentDataProvider;
use Itstructure\GridView\Helpers\SortHelper;

class DataProvider extends EloquentDataProvider
{

    private array $enabledFilters;

    private string $alias;

    public function __construct(Builder $query, array $enabledFilters = [], string $mainTableAlias = '')
    {
        $this->enabledFilters = $enabledFilters;
        $this->alias          = $mainTableAlias;
        parent::__construct($query);
    }

    public function selectionConditions(Request $request, bool $strictFilters = false): void
    {
        if ($request->get('sort')) {
            $this->query->orderBy(SortHelper::getSortColumn($request), SortHelper::getDirection($request));
        }

        if (!is_null($request->filters)) {
            foreach ($request->filters as $column => $value) {
                if (!in_array($column, $this->enabledFilters)) {
                    continue;
                }
                if (is_null($value)) {
                    continue;
                }

                $column = empty($this->alias) ? $column : ($this->alias . '.' . $column);

                if ($strictFilters) {
                    $this->query->where($column, '=', $value);
                } else {
                    $this->query->where($column, 'like', '%' . $value . '%');
                }
            }
        }
    }

}
