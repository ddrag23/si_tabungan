@extends('layouts.app',['title' => 'Transaksi Masuk'])
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-primary total"></h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>Nama Murid</th>
                            <th>Nominal Transaksi</th>
                            <th>Tanggal Transaksi</th>
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
@endsection
@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="form-income" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <select name="user_id" id="user_id" class="form-control select2 border-danger" style="width:100%;">
                            <option value="" disabled selected>- Pilih -</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" class="form-control" id="nominal">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="module" src="{{ asset('js/app/income.js') }}" charset="utf-8"></script>
@endpush
