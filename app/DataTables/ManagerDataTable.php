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
            ->addColumn('action',function (){
                return $this->getManagerActionColumn();
            })
            ->setRowClass('{{ $id % 2 == 0 ? "alert-secondary" : "alert-light"}}')
            ->addRowAttr("test", '{{ $created_at }}');
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

            Column::make('user.id')->title("Manager ID"),
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

    protected function getManagerActionColumn()
    {
        $edit = route("manager.index");
        $delete = route("manager.index");
        return "<div class='d-flex'>"
            ."<a class='btn btn-warning' href='$edit'>Edit</a>"
            ."<a class='btn btn-danger ml-2' href='$delete'>Delete</a>"
            ."</div>";
    }
}
