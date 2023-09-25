<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use Illuminate\Http\Request;

class MainController extends Controller
{
   public function Index()
   {

    $rumah = Rumah::all();

    return view('admin.index', compact('rumah'));
   }

}
