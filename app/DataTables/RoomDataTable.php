<?php

namespace App\DataTables;

use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoomDataTable extends DataTable
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
                return $this->getRoomActionColumn($data);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Room $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room $model)
    {
        return $model->newQuery()->with(["floor"]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('room-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->lengthMenu()
            ->dom('Blfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
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
            Column::make('id')->title("Room ID"),
            Column::make('number')->title("Number"),
            Column::make('price')->title("Price"),
            Column::make('capacity')->title("Capacity"),
            Column::make('floor.name')->title("Floor Name"),
            Column::make('manager_id')->title("Manager ID"),
            Column::make('reserved')->title("Reserved"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass("hover")
                ->addClass('text-center')
                ->addClass("w-25")
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Room_' . date('YmdHis');
    }

    protected function getRoomActionColumn($data)
    {
//        dd($data->manager->id);
        if (Auth::user()->hasRole('admin') || $data->manager->id == Auth::user()->manager->id) {
            $edit = route("rooms.edit", [$data->id]);
            $delete = route("rooms.destroy", $data->id);
            $current_datatable = strtolower(basename(__FILE__, "DataTable.php"));

            $delete_btn =
                "<button type='button' class='btn btn-danger ml-1' data-toggle='modal' data-target='#RRdelete$data->id'>Delete</button>"
                ."<div class='modal fade' id='RRdelete$data->id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>"
                    ."<div class='modal-dialog modal-dialog-centered'>"
                    ."<div class='modal-content'>"
                        ."<div class='modal-header'>"
                            ."<h5 class='modal-title  text-dark' id='exampleModalLabel'>"
                            ."<span class='text-danger'><i class='fas fa-exclamation-triangle'></i><i class='fas fa-times-circle'></i></span> Warning "
                            ."</h5>"
                            ."<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"
                            ."<span aria-hidden='true'>&times;</span>"
                            ."</button>"
                        ."</div>"
                            ."<div class='modal-body'>Are you sure you want to <span class='text-danger'>delete room: $data->number</span> ? </div>"
                            ."<div class='modal-footer'>"
                                ."<button class='btn btn-danger' onclick='deleteRRButton(\"$delete\", \"{$data->name}\", \"$current_datatable\")'  id='$data->id' type='submit'>Yes ,delete</button>"
                                ."<a type='button' class='btn btn-secondary ml-1' data-dismiss='modal'>Cancel</a>"
                            ."</div>"
                        ."</div>"
                    ."</div>"
                ."</div>";

            $html = "<div class='d-flex justify-content-center'>"
                . "<a class='btn btn-info' href='$edit'>Edit</a>"
                . $delete_btn
                . "</div>";
            return $html;
        }

    }

}
