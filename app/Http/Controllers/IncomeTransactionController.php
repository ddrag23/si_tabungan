<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\IncomeTransaction;
use App\Models\User;
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
    $model = new IncomeTransaction();
    $query = $model->with('user')->latest()->get();
    return Datatables::of($query)->addIndexColumn()
      ->editColumn('name', function ($row) {
        return $row->user->name;
      })
      ->editColumn("created_at", function ($row) {
        return date('d-m-Y', strtotime($row->created_at));
      })
      ->addColumn('action', function ($row) {

        $btn = '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '"><i class="fas fa-trash"></i> Delete</a>';
        return $btn;
      })
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
      return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }
  }

  public function destroy(IncomeTransaction $income)
  {
    $income->delete();
    return response()->json(['message' => 'Data berhasil dihapus']);
  }
}
