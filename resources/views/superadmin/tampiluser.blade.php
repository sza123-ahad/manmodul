

@extends('superadmin.layout')


@section('sidebar')

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            
        </div>
        <div class="card">
            <div class="card-body">
            <div class="bg-light rounded h-100 p-4">
                {{-- <h6 class="mb-4"></h6> --}}
                <div class="btn-group" role="group">
                    <form action="adduser">
                        <button type="submit" class="btn btn-primary">
                             <i class="fa fa-edit "></i> Tambah </button>
                 </form>
                 &nbsp;&nbsp;&nbsp;
                    <form action="deleteuser" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>
                             Delete All</button>
                </div>
            </div>
        </div>


       <div class="card">
           <div class="card-header">
            <b>List Data User</b>
           </div>
           <div class="card-body">

              <div class="table table-striped">
                <table class="table table-bordered table-light">
                    <thead>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama Lengkap</th>
                        <th>Akses</th>
                        <th>Fhoto</th>
                        <th>Aksi

                            <div class="form-group">
                            </div>
                        </th>
                    </thead>
                    <tbody>
                        
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ $data->firstItem()  + $key}}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->password_show }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->akses }}</td>
                            <td><img src="{{ $item->file_path }}" width="100px"  height="100px"></td>
                            <td>
                            <button type="button" class="btn  btn-xs  edit_button"
                             data-toggle="modal" 
                             data-target="#userModal"
                             data-id ="{{ $item->id }}"
                             data-username="{{ $item->username }}"
                             data-password="{{ $item->password_show }}"
                             data-name ="{{ $item->name }}"
                             data-akses="{{ $item->akses }}"
                         >
                                <i class="fas fa-edit text-primary"></i>
                              </button>

                              <input class="form-check-input" type="checkbox"  name="id[]" value="{{ $item->id }}">
                              
                              
                            </td>
                        </tr>    
                        @endforeach
                    </form>
                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>
              </div>
              <div class="card-footer">
                  <div class="d-flex justify-content-left">
                    {{ $data->links() }}
                  </div>
               
              </div>
           </div>
       </div>
    </div>
    <!-- Widgets End -->

    
  
</div>
  <!-- Modal -->
  <form method="POST" action="prosesedituser" enctype="multipart/form-data">
      @csrf
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Ubah Data </h5>
          {{-- <button type="button" id="butoonclose" class="btn btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
          <div class="card text-left">
            
            <div class="card-body">
              <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="hidden" class="form-control ubah-id" name="id">
                       <input type="text" class="form-control ubah-username" name="username" id="" >
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <label for="">Password</label>
                    <input type="text" class="form-control ubah-password" name="password" id="" >
                  </div>
                  <div class="col-sm-6">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control ubah-name" name="name" id="" >
                  </div>
              </div>
              <div class="row">
                @php
                use Illuminate\Support\Facades\DB;
                $pilih_akses = DB::table('users')->selectRaw('akses')->groupBy('akses')->get();
                // dd($pilih_akses);
            @endphp
            
                  <div class="col">
                    {{-- <label for="">Level</label>
                    <input type="text"class="form-control" name="username" id="ubah-username" > --}}
                    <div class="form-group">
                      <label for="">Pilih Level</label>
                      <select class="form-control ubah-akses" name="akses" id="ubah-akses">
                        <option value="">--</option>
                        
                        @foreach ($pilih_akses as  $item)
                            <option value="{{ $item->akses }}">{{ $item->akses }}</option>
                        @endforeach
                      </select>
                    </div>
                    <br/>
                    <div class="form-group">
                      <label for="">Upload Fhoto</label>
                      <input type="file" class="form-control-file" name="file_foto" id="" placeholder="" aria-describedby="fileHelpId">
                      {{-- <small id="fileHelpId" class="form-text text-muted">Help text</small> --}}
                    </div>

                </div> 
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id ="buttonclose" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
    <!-- endModal -->
@include('sweetalert::alert')

<script src="{{  asset('dashmin/js/jquery-3.2.1.slim.min.js') }}" ></script>

<script src="{{  asset('dashmin/js/bootstrap.min.js') }}" ></script>
<script>
   $(document).on("click",'.edit_button',function(e){
        var username = $(this).data('username');
        var password = $(this).data('password');
        var name =$(this).data('name');
        var akses = $(this).data('akses');
        var id = $(this).data('id');

        

        $('#userModal').modal("show");
        
        $(".ubah-id").val(id);
        $(".ubah-username").val(username);
        $(".ubah-password").val(password);
        $(".ubah-name").val(name);
        $(".ubah-akses").val(akses);
        
        $('#buttonclose').click(function(){
            $('#userModal').modal("hide");
         });
    });
   
</script>
@endsection


