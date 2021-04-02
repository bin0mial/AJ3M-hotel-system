<?php

namespace App\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        return $model->newQuery()->with('user')->select('clients.*')->where('approval','false');
       
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('client-table')
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
            Column::make('mobile')->title("Mobile"),
            Column::make('country')->title("Country"),
            Column::make('gender')->title("Gender"),
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
     * @return string$data
     */
    protected function filename()
    {
        return 'Client_' . date('YmdHis');
    }



    protected function getClientActionColumn($data)
    {
        if ($data->receptionist_id == null && $data->approval == 'false') {
           
            $accept = route("client.accept", [$data->id]);
            $delete = route("client.destroy", $data->id);
            $current_datatable = strtolower(basename(__FILE__, "DataTable.php"));
            return "<div class='d-flex  justify-content-center'>"
                . "<a class='btn btn-warning' href='$accept'>Accept</a>"
                . "<button class='btn btn-danger ml-2 delete-user' onclick='deleteButton(\"$delete\", \"{$data->user->name }\", \"$current_datatable\")'>Delete</button>";

        }
    }
}
