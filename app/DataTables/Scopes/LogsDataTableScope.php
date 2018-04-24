<?php

namespace App\DataTables\Scopes;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Contracts\DataTableScope;

class LogsDataTableScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        return $query->where('causer_id', Auth::user()->id);
    }
}
