<?php

namespace App\DataTables;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientReservation;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientReservationDataTable extends DataTable
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
            ->addColumn('action', 'clientreservation.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ClientReservation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ClientReservation $model)
    {

        $is_receptionist = Auth::user()->hasRole('receptionist') ;
        return $model->newQuery()->with('user')->select('clients.*')->where('approval',true)
        ->when($is_receptionist,function($query , $is_receptionist ){

             return $query->where('receptionist_id',Auth::user()->receptionist->id);

        });
        
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('clientreservation-table')
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
            Column::make('accompany_number')->title("Client Accompany Number"),
            Column::make('room_number')->title("Room Number"),
            Column::make('paid_price')->title("Client paid price"),
          
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ClientReservation_' . date('YmdHis');
    }
}
