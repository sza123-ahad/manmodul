@extends('superadmin.layout')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Hasil Pencarian</h3>
        </div>
        <div class="card-body">
           
        @foreach ($all_data as $inx)
        @foreach ($inx as $itemx)
            
        
            @php
                $dt = $itemx;
                // dd($dt);
                $dtc = json_decode($dt,true);
                // dd($dtc);
            @endphp
                    <table class="table table-light">
                        <thead class="thead-light">
                            
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($dtc as $item)
                                <td>{{ $item }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
        @endforeach
        @endforeach

              
        </div>
    </div>    
</div>
@endsection