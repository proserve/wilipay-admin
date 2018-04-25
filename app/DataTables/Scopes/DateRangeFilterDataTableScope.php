<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class DateRangeFilterDataTableScope implements DataTableScope
{
    private $field;

    /**
     * LogsDataTableScope constructor.
     * @param string $field
     */
    public function __construct(string $field='created_at')
    {
        $this->field = $field;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        if (isset($_REQUEST['startDate']))
            $query = $query->where($this->field, '>', $_REQUEST['startDate']);
        if (isset($_REQUEST['endDate']))
            $query = $query->where($this->field, '<', $_REQUEST['endDate']);
        return $query;
    }

}
