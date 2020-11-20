<?php

namespace App\Http\Controllers;

use App\Models\IncomeTransaction;
use App\Models\Tabungan;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IncomeTransactionController extends Controller
{

  public function index()
  {
    return view('modules.transaksi_masuk.v_list-transaksi_masuk', [
      'users' => User::latest()->get()
    ]);
  }

  public function getTotalJson(IncomeTransaction $income)
  {
    return response()->json(['total' => $income->sum('nominal')]);
  }

  public function getJsonData()
  {
    $query = IncomeTransaction::with('user')->orderBy('created_at','desc')->get();
    return Datatables::of($query)->addIndexColumn()
      ->editColumn('name', fn($row) => $row->user->name)
      ->editColumn("created_at", fn($row) => date('d-m-Y', strtotime($row->created_at)))
      ->addColumn('action', fn($row) =>
        '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '"><i class="fas fa-trash"></i> Delete</a>'
      )
      ->rawColumns(['action'])
      ->make(true);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), ['user_id' => 'required', 'nominal' => 'required|numeric']);
    if ($validator->fails()) {
      return response()->json(['success' => false, 'message' => $validator->getMessageBag()->toArray()]);
    } else {
      IncomeTransaction::create([
        'user_id' => $request->user_id,
        'nominal' => $request->nominal,
        'created_by' => Auth::user()->id
      ]);
      $tabungan = Tabungan::where('user_id', $request->user_id)->first();
      if (!empty($tabungan)) {
        Tabungan::where('user_id', $request->user_id)->update([
          'user_id' => $request->user_id,
          'saldo' => $tabungan->saldo + $request->nominal,
          'modified_by' => Auth::user()->id
        ]);
      } else {
        Tabungan::create([
          'user_id' => $request->user_id,
          'saldo' => $request->nominal,
          'created_by' => Auth::user()->id
        ]);
      }
      return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }
  }

  public function destroy(IncomeTransaction $income)
  {
    $income->delete();
    return response()->json(['message' => 'Data berhasil dihapus']);
  }

}
