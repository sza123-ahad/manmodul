@extends('superadmin.layout')
@section('content')
<div class="container-fluid">
<div class="row">
<div class="col">
    <div class="card">
        <div class="card-header">
            Management Fungsi
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Path</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                       <td>{{ $item->nama_fungsi }}</td>
                       <td>{{ $item->code_fungsi }}</td>
                       <td>{{ $item->link }}</td>
                    </tr>     
                    @endforeach
                   
                    
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
</div>    
</div>
@endsection