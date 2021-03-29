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
            ->addColumn('action', 'receptionist.action');
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('user.id'),
            Column::make('user.name'),
            Column::make('user.email'),
            Column::make('user.national_id'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    protected function getActionColumn($data = "tst"): string
    {
        $showUrl = route('admin.brands.show', $data);
        $editUrl = route('admin.brands.edit', $data);
        return "<a class='waves-effect btn btn-success' data-value='$data' href='$showUrl'><i class='material-icons'>visibility</i>Details</a>
                        <a class='waves-effect btn btn-primary' data-value='$data->id' href='$editUrl'><i class='material-icons'>edit</i>Update</a>
                        <button class='waves-effect btn deepPink-bgcolor delete' data-value='$data' ><i class='material-icons'>delete</i>Delete</button>";
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
