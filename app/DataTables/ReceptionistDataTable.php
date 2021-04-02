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
        ->orderBy(0)
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
            Column::make('user.id')->title("Receptionist ID"),
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

            $delete_btn =
                "<button type='button' class='btn btn-danger ml-1' data-toggle='modal' data-target='#Rdelete$data->id'>Delete</button>"
                ."<div class='modal fade' id='Rdelete$data->id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>"
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
                                ."<div class='modal-body'>Are you sure you want to <span class='text-danger'>delete Receptionist: $data->name</span> ? </div>"
                                ."<div class='modal-footer'>"
                                        ."<a class='btn btn-delete btn-danger '  onclick='deleteRButton(\"$delete\", \"{$data->name}\" , \"$current_datatable\")'  id='$data->id' type='submit'>Yes ,delete</a>"
                                    ."<button type='button' class='btn btn-secondary ml-1' data-dismiss='modal'>Cancel</button>"
                                ."</div>"
                        ."</div>"
                    ."</div>"
                ."</div>";

            $html = "<div class='d-flex w-100  justify-content-center'>"
                    . "<a class='btn btn-info' href='$edit'>Edit</a>"
                    . $ban_unban
                    . $delete_btn
                . "</div>";
            return $html;

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
