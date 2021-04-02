<?php

namespace App\DataTables;

use App\Models\Floor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FloorDataTable extends DataTable
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
                return $this->getFloorActionColumn($data);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Floor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Floor $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('floor-table')
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
            Column::make('id')->title("Floor ID"),
            Column::make('name')->title("Name"),
            Column::make('number')->title("Number"),
            Column::make('manager_id')->title("Manager ID"),
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
        return 'Floor_' . date('YmdHis');
    }


    protected function getFloorActionColumn($data)
    {
        if (Auth::user()->hasRole('admin') || $data->manager_id == Auth::user()->manager->id) {
            $edit = route("floors.edit", [$data->id]);
            $delete = route("floors.destroy", $data->id);
            $current_datatable = strtolower(basename(__FILE__, "DataTable.php"));

            $delete_btn =
                "<button type='button' class='btn btn-danger ml-1' data-toggle='modal' data-target='#Fdelete$data->id'>Delete</button>"
                ."<div class='modal fade' id='Fdelete$data->id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>"
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
                        ."<div class='modal-body'>Are you sure you want to <span class='text-danger'>delete Floor: $data->name</span> ? </div>"
                            ."<div class='modal-footer'>"
                            ."<button class='btn btn-danger' onclick='deleteFFButton(\"$delete\", \"{$data->name }\", \"$current_datatable\" ,\"$data->id\")'  id='$data->id' type='submit'>Yes ,delete</button>"
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
