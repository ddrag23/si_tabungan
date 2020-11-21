<?php

namespace App\Http\Controllers;

use App\Models\OutgoingTransaction;
use App\Models\Tabungan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OutgoingTransactionController extends Controller
{

  public function index()
  {
    return view('modules.transaksi_keluar.v_list-transaksi_keluar', ['users' => User::latest()->get()]);
  }

  public function store(OutgoingTransaction $outgoing, Request $request)
  {
    $validator = Validator::make($request->all(), [
      'user_id' => 'required',
      'nominal' => 'required|numeric'
    ]);
    $nominal = (Int)$request->nominal;

    if ($validator->fails()) {
      return response()->json(['success' => false, 'message' => $validator->getMessageBag()->toArray()]);
    } else {
      $tabungan = Tabungan::where('user_id', $request->user_id)->first();
      if (!empty($tabungan)) {
        if ($tabungan->saldo - $nominal > 0) {
          $outgoing->create([
            'user_id' => $request->user_id,
            'nominal' => $nominal,
            'created_by' => Auth::user()->id
          ]);

          $tabungan->update([
            'user_id' => $request->user_id,
            'saldo' => $tabungan->saldo - $nominal,
            'modified_by' => Auth::user()->id
          ]);
        } else {
          return response()->json(['success' => false, 'warning' => true, 'message' => 'Tabungan anda kurang untuk melakukan penarikan']);
        }
      } else {
        return response()->json(['success' => false, 'warning' => true, 'message' => 'Anda belum memiliki tabungan']);
      }
      return response()->json(['success' => true, 'message' => 'Data berhasil dimasukkan']);
    }
  }

  public function destroy(OutgoingTransaction $outgoing)
  {
    $outgoing->delete();
    return response()->json(['message' => 'Data berhasil dihapus']);
  }

  public function getJsonData()
  {
    $query = OutgoingTransaction::with('user')->orderBy('created_at', 'desc')->get();
    return DataTables::of($query)->addIndexColumn()
      ->editColumn('name', fn ($row) => $row->user->name)
      ->editColumn("created_at", fn ($row) => date('d-m-Y', strtotime($row->created_at)))
      ->addColumn('action', fn ($row) =>
      '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '"><i class="fas fa-trash"></i> Delete</a>')
      ->rawColumns(['action'])
      ->make(true);
  }

  public function getJsonTotal(OutgoingTransaction $outgoing)
  {
    return response()->json(['total' => $outgoing->sum('nominal')]);
  }
}
