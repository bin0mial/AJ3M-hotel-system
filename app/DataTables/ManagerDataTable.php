<?php

namespace App\DataTables;

use App\Models\Manager;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use function Matrix\add;

class ManagerDataTable extends DataTable
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
                return $this->getManagerActionColumn($data);
            })
            ->addColumn("avatar_image", function ($data) {
                return $this->getAvatarImage($data);
            }, false)
            ->rawColumns(['avatar_image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Manager $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Manager $model)
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
            ->setTableId('manager-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->lengthMenu()
            ->dom('Blfrtip')
            ->orderBy(0, 1)
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

            Column::make('id')->title("Manager ID"),
            Column::computed("avatar_image"),
            Column::make("user.name")->title("Name"),
            Column::make("user.national_id")->title("National ID"),
            Column::make("user.email")->title("Email"),
            Column::make("user.created_at")->title("Created At"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Manager_' . date('YmdHis');
    }

    protected function getManagerActionColumn($data)
    {
        $edit = route("managers.edit", [$data->id]);
        $delete = route("managers.destroy", $data->id);
        $current_datatable = strtolower(basename(__FILE__, "DataTable.php"));
        return "<div class='d-flex'>"
            . "<a class='btn btn-warning' href='$edit'>Edit</a>"
            . "<button class='btn btn-danger ml-2 delete-user' onclick='deleteButton(\"$delete\", \"{$data->user->name }\", \"$current_datatable\")'>Delete</button>";
    }

    protected function getAvatarImage($data)
    {
        return "<img class='w-100 rounded-circle' src=\"{$data->user->avatar_image}\" alt=\"{$data->user->name} avatar image.\"/>";
    }
}
