<?php

namespace App\DataTables;

use App\Customer;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function ajax()
    {
        return DataTables::of($this->query())->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $customers = Customer::with(['profile'])->select('users.*');
        return $this->applyScopes($customers);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'reset', 'reload'],
            ]);
    }


    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'profile.first_name',
            'profile.last_name',
            'phone',
            'email',
            'verified',
            'blocked',
            'profile.birthday',
            'profile.gender',
            'profile.language',
            'profile.country',
            'profile.city',
            'profile.postal_code',
            'created_at',
        ];
    }
}