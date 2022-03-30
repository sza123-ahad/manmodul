@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="title">
                    Profil
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                   
                  <div class="col-sm-4 text- c">
                      <p>
                          <table>
                              <tr>
                                  <td>Username</td>
                                  <td>: <b class="text-dark"> {{ Auth::user()->username }} </b></td>
                              </tr>
                              <tr>
                                <td>Nama Lengkap</td>
                                <td>: <b class="text-dark"> {{ Auth::user()->name }} </b></td>
                            </tr>
                            <tr>
                                <td>Level</td>
                                <td>: <b class="text-dark"> {{ Auth::user()->akses }} </b></td>
                            </tr>
                          </table>
                         
                      </p>
                  </div>
                  <div class="col-sm-2 text-left">
                    <img src="{{ Auth::user()->file_path }}" alt="" title="{{ Auth::user()->file_path }}">

                </div>
                  
                 
                </div>
            </div>    
        </div>

    </div>
</div>
@endsection