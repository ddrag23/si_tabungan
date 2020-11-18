@extends('layouts.app',['title' => 'Tabungan'])
@section('content')
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
            <h4>Basic DataTables</h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                <thead>                                 
                    <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Nama Murid</th>
                    <th>Total Tabungan</th>
                    <th>Tabungan Terakhir</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>                                 
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
