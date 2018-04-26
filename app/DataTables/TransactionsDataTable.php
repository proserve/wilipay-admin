<?php

namespace App\DataTables;

use App\Card;

use App\Transaction;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

class TransactionsDataTable extends DataTable
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
        $transactions = Transaction::with('account.customer');
        return $this->applyScopes($transactions);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public
    function html()
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
    protected
    function getColumns()
    {
        return [
            'id',
            'purpose',
            'type',
            'amount',
            'created_at',
        ];
    }
}