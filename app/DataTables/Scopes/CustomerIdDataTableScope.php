<?php

namespace App\DataTables\Scopes;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Contracts\DataTableScope;

/**
 * @property  customer_id
 */
class CustomerIdDataTableScope implements DataTableScope
{
    private $customer_id;

    /**
     * CustomerIdDataTableScope constructor.
     * @param $customerId
     */
    public function __construct($customerId)
    {
        $this->customer_id = $customerId;
    }


    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        return $query->where('customer_id', $this->customer_id);
    }

}
