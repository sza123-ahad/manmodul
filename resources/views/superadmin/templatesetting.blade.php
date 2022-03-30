@extends('superadmin.layout')

@section('sidebar')

@endsection

@section('content')
<div class="row">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Setting Template</h5>
                    {{-- <p class="card-text">Content</p> --}}
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Layout</th>
                                <th><i class="fas fa-cog"></i> Setting</th>
                                
                            </tr>
                            
                        </thead>
                        <tbody>
                            <tr>   
                                <td>1.</td>
                                <td>Sidebar Color</td>
                                <td><div class="form-group">
                                    <div class="row">
                                        @php
                                            $dt  =\App\Models\Setting::where('jenis_setting','color')->where('status','Y')->first()->id;
                                            // dd($dt);
                                        @endphp
                                        <div class="col-sm-4">
                                            <select class="form-control" name="pilihwarna" id="pilihwarna" >
                                                <option>-- Pilih Warna --</option>
                                                {{ $set = App\Models\Setting::where('jenis_setting','color')->get(); }}
                                                @foreach ($set as $item)
                                                <option value="{{ $item->id}}" @if($dt == $item->id) selected='selected' @endif }}> {{ $item->uraian }} </option>    
                                                @endforeach
                                                
                                                {{-- <option></option> --}}
                                              </select>
                                        </div>
                                        <div class="col-sm-4">

                                        </div>
                                    </div>
                                    
                                   
                                  </div></td>
                            </tr>

                            <tr>
                                @php
                                    $imgL = \App\Models\Setting::find(9);
                                @endphp   
                                <td>2.</td>
                                <td>Setting Image Login</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <form method="post" action="upimglogin" enctype="multipart/form-data">

                                                @csrf
                                                <div class="form-group">
                                                  {{-- <label for=""></label> --}}
                                                  <input type="file" class="form-control-file" name="file" id="" placeholder="" aria-describedby="fileHelpId">
                                                  <small id="fileHelpId" class="form-text text-muted">{{ $imgL->path_image }} </small>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary">Proses Simpan</button>
                                        </form>
                                        </div>
                                    </div>
                                    
                                </td>
                            </tr>

                            <tr>   
                                <td>3.</td>
                                <td>Setting  Judul Login</td>
                                <td>
                                    @php
                                        
                                        $judulL = \App\Models\Setting::find(10);
                                        // dd($judulL);
                                    @endphp
                                    <form action="title_edit" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    {{-- <label for=""></label> --}}
                                                    <input type="text"
                                                      class="form-control" name="uraian" id=""  value="{{ $judulL->uraian }}" aria-describedby="helpId" placeholder="">
                                                    {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                                  </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">Proses Simpan</button>
                                            </div>
                                        </div>
                                   
                                </form>
                                </td>
                            </tr>

                            <tr>   
                                @php
                                    $bgL = \App\Models\Setting::find(11);
                                @endphp
                                <td>4.</td>
                                <td>Setting  Background Login</td>
                                <td>
                                    <form action="bgloginedit" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                  {{-- <label for=""></label> --}}
                                                  <input type="file" class="form-control-file" name="file" id="" placeholder="" aria-describedby="fileHelpId">
                                                  <small id="fileHelpId" class="form-text text-muted">{{ $bgL->path_image   }}</small>
                                                 
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">Proses Simpan</button> 
                                            </div>
                                        </div>
                                   
                                </form>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
{{-- @include('sweetalert::alert') --}}
<script src="/vendor/sweetalert/sweetalert.all.js"></script>
<script>
$(document).ready(function(){
    $("#pilihwarna").on("change",function(){
        
        var id  = $("#pilihwarna option:selected").val();
        $.ajax ({
            type : "GET",
            url: "editwarna/"+id,    
        }).done(function(res){
            window.location.reload();
            Swal.fire(
                    'BERHASIL',
                    'Data telah diubah ',
                    'success'
                    )
        });



       

    });

});
</script>

@endsection