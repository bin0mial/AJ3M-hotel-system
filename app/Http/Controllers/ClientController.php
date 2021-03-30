<?php

namespace App\Http\Controllers;

use App\DataTables\ClientDataTable;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index (ClientDataTable $DataTable){
        return $DataTable->render("client.index");
    }
}
