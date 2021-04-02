<?php

namespace App\DataTables;

use App\Models\Receptionist;
use App\Models\Manager;
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
        ->setTableId('receptionist-table')
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
            Column::make('id')->title("Receptionist ID"),
            Column::make('user.name')->title("Name"),
            Column::make('user.email')->title("Email"),
            Column::make('user.national_id')->title("National ID"),
            Column::make('user.created_at')->title("created_at"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->addClass("w-25")
        ];
    }

    protected function getReceptionistActionColumn($data)
    {
        $ban_unban = null;

        if (Auth::user()->hasRole('admin') || $data->manager_id == Auth::user()->manager->id) {
            $edit   = route("receptionists.edit" , [$data->id]);
            $delete = route("receptionists.destroy" ,[$data->id]);
            $ban    = route("receptionists.ban" ,[$data->id]);
            $current_datatable = strtolower(basename(__FILE__, "DataTable.php"));
            if ($data->user->hasRole('ban')){
                $ban_unban = "<a class='btn btn-success ml-1'
                    onclick='banButton(\"$ban\", \"{$data->name}\" , \"$current_datatable\")'>Unban</a>";
            } else {
                $ban_unban = "<a class='btn btn-warning ml-1'
                    onclick='banButton(\"$ban\", \"{$data->name}\" , \"$current_datatable\")'>Ban</a>";
            }
            $html = "<div class='d-flex w-100  justify-content-center'>"
                . "<a class='btn btn-info' href='$edit'>Edit</a>"
                . $ban_unban
                . "<a class='btn btn-danger ml-1' onclick='deleteButton(\"$delete\", \"{$data->name}\" , \"$current_datatable\")'>Delete</a>"
                . "</div>";
            return $html;

        // }
        $edit = route("manager.index");
        $delete = route("manager.index");
        return "<div class='d-flex'>"
            . "<a class='btn btn-warning' href='$edit'>Edit</a>"
            . "<a class='btn btn-danger ml-2' href='$delete'>Delete</a>"
            . "</div>";
    }

//                ."<button type='button' class='btn btn-danger ml-1' data-toggle='modal' data-target='#delete$data->id'>"
//                ."Delete"
//                ."</button>"
//                ."<div class='modal fade' id='Rdelete$data->id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>"
//                    ."<div class='modal-dialog modal-dialog-centered'>"
//                            ."<div class='modal-content'>"
//                                ."<div class='modal-header'>"
//                                    ."<h5 class='modal-title  text-dark' id='exampleModalLabel'>"
//                                    ."Are you sure you want to delete this receptionists ?"
//                                    ."</h5>"
//                                    ."<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"
//                                    ."<span aria-hidden='true'>&times;</span>"
//                                    ."</button>"
//                                ."</div>"
//                                ."<div class='modal-footer'>"
//                                ."<form class='d-inline' method='DELETE' action='$delete'>"
//                                    ."<meta name='csrf-token' content='{{ csrf_token() }}'>"
//                                    ."{{ method_field('DELETE') }}"
//                                    ."<button class='btn btn-delete btn-danger ' onclick='delete_recept(event)'  id='$data->id' type='submit'>Yes ,delete</button>"
//                                ."</form>"
//                                ."<button type='button' class='btn btn-secondary ml-1' data-dismiss='modal'>Cancel</button>"
//                            ."</div>"
//                        ."</div>"
//                    ."</div>"
//                ."</div>"



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
