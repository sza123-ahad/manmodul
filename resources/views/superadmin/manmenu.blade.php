@extends('superadmin.layout')

@section('content')
<div class="container-fluid">
   <h1>Manajemen Menu</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                 
              

                <div class="card-body">
                    <form action="simpanmenu" method="POST">
                        @csrf
                    <div class="row">
                       <div class="col-4">
                           <div class="card">
                                <div class="card-header">
                                    <b>Form Tambah Menu</b>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Nama Menu</label>
                                        <input type="hidden" class="form-control edit-id" name="id" >
                                        <input type="text"
                                          class="form-control edit-nama_menu" name="nama_menu" id="nama_menu" aria-describedby="helpId" placeholder="" required>
                                      </div>
           
                                      <div class="form-group">
                                       <label for="">Link</label>
                                       <input type="text"
                                         class="form-control edit-link" name="link" id="link" aria-describedby="helpId" placeholder="" required>
                                     </div>
           
                                     <div class="form-group">
                                       <label for="">Sub Menu</label>
                                       <select class="form-control edit-id_sub_menu" name="id_sub_menu" id="id_sub_menu" required>
                                         <option>--Pilih--</option>
                                         <option value="1">Sidebar</option>
                                       </select>
                                     </div>
           
                                   <div class="form-group">
                                     <label for="">Status Aktif</label>
                                     <select class="form-control edit-status" name="status" id="status" required>
                                       <option>--Pilih--</option>
                                       <option value="aktif">Aktif</option>
                                       <option value="nonaktif">Tidak Aktif</option>
                                     </select>
                                   </div>
           
                                  <div class="form-group">
                                    <label for="">Jenis Menu</label>
                                    <select class="form-control edit-jns_menu" name="jns_menu" id="jns_menu" required>
                                       <option>--Pilih--</option>
                                      <option value="front_end">Menu Public</option>
                                      <option value="back_end">Menu Member</option>
                                    </select>
                                  </div>

                                  @php
                                    $dlev = \App\Models\Level::all();
                                  @endphp

                                  <div class="form-group">
                                    <label for="">Hak Akses</label>
                                    <select class="form-control edit-hak_akses" name="hak_akses" id="hak_akses">
                                      <option>--Pilih--</option>
                                     @foreach ($dlev as $item)
                                         <option value="{{ $item->level }}" >{{ $item->level }}</option>
                                     @endforeach
                                    </select>
                                  </div>

                                </div>
                           </div>
                           <a class="btn btn-primary" onclick="cleartambah()"><i class="fa fa-plus-circle"></i> Tambah</a>
                           <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Proses Simpan</button>
                        </form>

                       </div>
                       <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                   <b>Tampil Menu </b>
                        </div>
                        <div class="card-body">
                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Link</th>
                                        <th>ID SUB</th>
                                        <th>Jenis</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item->nama_menu }}</td>
                                        <td>{{ $item->link }}</td>
                                        <td>{{ $item->id_sub_menu }}</td>
                                        <td>{{ $item->jns_menu }}</td>
                                        <td>{{ $item->hak_akses }}</td>
                                        <td>{{ $item->status }}</td>
                                        {{-- <td><a href="editmanmenu\{{ $item->id }}" >
                                        <i class="fa fa-edit"></i>
                                        </a>
                                        </td> --}}
                                        <td><a   value="{{ $item->id }}" class="btn btn-info" onclick="edMenu({{ $item->id }})"> <i class="fa fa-edit"></i></a></td>
                                    </tr>    
                                    @endforeach
                                   
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7"></td>
                                    </tr>
                                   
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $data->links() }}
                        </div>
                    </div>
                        
                        
                       </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">

                               </div>
                             
                        </div>
                    </div>
                {{-- </form> --}}

                </div>
            </div>
        </div>                                      

</div>

@endsection
@include('sweetalert::alert')
@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{  asset('dashmin/js/bootstrap.min.js') }}" ></script>
<script>
    function edMenu(id){
        var kode = id;
        // alert(kode);
        $.ajax({
            type : "GET",
            url : 'apiedit/'+kode,

        }).done(function(data){
            console.log(data);
        $(".edit-id").val(data.id);
         $(".edit-nama_menu").val(data.nama_menu);
         $(".edit-id_sub_menu").val(data.id_sub_menu);
         $(".edit-link").val(data.link);
         $(".edit-status").val(data.status);
         $(".edit-jns_menu").val(data.jns_menu);
         $(".edit-hak_akses").val(data.hak_akses);
        });

    } 

function cleartambah(){
    // alert("tes");
        $(".edit-id").val('');
         $(".edit-nama_menu").val('');
         $(".edit-id_sub_menu").val('');
         $(".edit-link").val('');
         $(".edit-status").val('');
         $(".edit-jns_menu").val('');
         $(".edit-hak_akses").val('');
}

    
</script>
@endsection




