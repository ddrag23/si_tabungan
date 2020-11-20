<?php

namespace App\Http\Controllers;

use App\Models\IncomeTransaction;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TabunganController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('modules.tabungan.v_list-tabungan');
  }

  public function show(Tabungan $tabungan)
  {
    //
  }

  public function destroy(Tabungan $tabungan)
  {
    $tabungan->delete();
    IncomeTransaction::where('user_id', $tabungan->user_id)->delete();
    return response()->json(['message' => 'Data berhasil dihapus']);
  }

  public function getJsonData()
  {
    $query = Tabungan::with('user')->get();
    return DataTables::of($query)->addIndexColumn()
      ->editColumn('name', fn ($row) => $row->user->name)
      ->editColumn("created_at", fn ($row) => date('d-m-Y', strtotime($row->created_at)))
      ->editColumn("updated_at", fn ($row) => date('d-m-Y', strtotime($row->updated_at)))
      ->addColumn('action', fn ($row) =>
      '<a href="javascript:void(0)" class="detail btn btn-warning btn-sm" data-id="' . $row->user_id. '"><i class="fas fa-eye"></i> Detail</a>
      <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '"><i class="fas fa-trash"></i> Delete</a>')
      ->rawColumns(['action'])
      ->make(true);
  }

  public function getJsonTotal(Tabungan $tabungan)
  {
    return response()->json(['total' => $tabungan->sum('saldo')]);
  }
}
