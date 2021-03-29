<?php

namespace App\DataTables;

use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReceptionistDataTable extends DataTable
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
                return $this->getReceptionistActionColumn($data);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Receptionist $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Receptionist $model)
    {
        return $model->newQuery()->with(["user"]);
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
            Column::make('user.id')->title("ID"),
            Column::make('user.name')->title("Name"),
            Column::make('user.email')->title("Email"),
            Column::make('user.national_id')->title("National ID"),
            Column::make('user.created_at')->title("created_at"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    protected function getReceptionistActionColumn($data)
    {
        if ($data->manager_id == Auth::user()->manager->id || Auth::user()->hasRole('admin')) {
            $edit = route("manager.index");
            $delete = route("manager.index");
            return "<div class='d-flex'>"
                . "<a class='btn btn-warning' href='$edit'>Edit</a>"
                . "<a class='btn btn-danger ml-2' href='$delete'>Delete</a>"
                . "</div>";

        }
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Receptionist_' . date('YmdHis');
    }
}
