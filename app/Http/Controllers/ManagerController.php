<?php

namespace App\Http\Controllers;

use App\DataTables\ManagerDataTable;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(ManagerDataTable $managerDataTable){
        return $managerDataTable->render("manager.index");
    }
}
