<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return $this->getClientActionColumn($data);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ClientDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        return $model->newQuery()->with(["user"]);
        return $model->newQuery()->with(["client"]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            
            Column::make('user.name')->title("Name"),
            Column::make('user.email')->title("Email"),
            Column::make('client.mobile')->title("Mobile"),
            Column::make('client.country')->title("Country"),
            Column::make('client.gender')->title("Gender"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Client_' . date('YmdHis');
    }



    protected function getClientActionColumn()
    {
        
        $show_reservations = route("client.show");
        //$delete = route("client.index");
        return "<div class='d-flex'>"
            ."<a class='btn btn-warning' href='$show_reservations'>show</a>"
           
            ."</div>";
    }
}
