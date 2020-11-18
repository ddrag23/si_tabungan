<?php

namespace App\Http\Controllers;

use App\Http\Requests\TabunganRequest;
use App\Models\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    //
  public function index()
  {
    return view('modules.tabungan.v_list-tabungan');
  }

  public function store(TabunganRequest $request)
  {
    Tabungan::create([
      'users_id' => $request->user_id
    ]);
  }
}
