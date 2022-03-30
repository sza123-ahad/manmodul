@extends('admin.layout')
@section('sidebar')
@endsection
@section('content')
<!-- Content Start -->
{{-- <div class="content"> --}}
  <div class="card">
      <div class="card-header">
          Form Tambah Data user
      </div>
      <div class="card-body">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Tambah User</h6>
            <form action="tambahuser" method="POST"> 
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Username </label>
                    <input type="text" class="form-control" id="" name="username">
                   
                    
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="text" class="form-control" id="" name="password">
                </div>
                <div class="mb-3">
                    <div class="form-group">
                      <label for="">Nama lengkap</label>
                      <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                      
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                      <label for=""></label>
                      <select class="form-control" name="akses" id="">
                        <option value="">-- Pilih --</option>
                        <option value="admin">Admin</option>
                        <option value="operator">Operator</option>
                        <option value="level1">Level 1</option>
                        <option value="level2">Level 2</option>
                        <option value="level3">Level 3</option>
                      </select>
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
      </div>
  </div>
@endsection
  @section('footer')
   <!-- Footer Start -->
   <div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                &copy; <a href="#">IT Nusantara VI</a>, All Right Reserved. 
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->    
@endsection






