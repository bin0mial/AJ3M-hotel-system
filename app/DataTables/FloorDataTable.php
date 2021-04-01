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
        if (Auth::user()->hasRole('admin') || $data->manager_id == Auth::user()->id) {
            $edit = route("floors.edit", [$data->id]);
            $delete = route("floors.destroy", $data->id);
            $current_datatable = strtolower(basename(__FILE__, "DataTable.php"));
            return "<div class='d-flex justify-content-center'>"
                . "<a class='btn btn-info' href='$edit'>Edit</a>"
                . "<button class='btn btn-warning ml-2 delete-user' onclick='deleteButton(\"$delete\", \"{ }\", \"$current_datatable\")'>Lock</button>";
        }

    }
}
