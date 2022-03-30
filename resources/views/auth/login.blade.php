<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Login</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('MDB5/css/mdb.min.css') }}" />
    <style>
      body,html{
      /* Full height */
        height: 100%;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      }
    </style>
  </head>
  @php
                $data = \App\Models\Setting::where('id','9')->first();
                $title = \App\Models\Setting::where('id','10')->first();
                $bglogin = \App\Models\Setting::where('id','11')->first();
              @endphp
  <body style="background-image:url({{ asset($bglogin->path_image) }}">
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <h3 style="text-align: center" class="text-primary"> <br/>   </h3>
              
              {{-- <img src="{{ asset('img/teamwork.png') }}" class="img-fluid" alt="Phone image"> --}}
             <h1 class="text-dark text-center">{{ $title->uraian }}</h1>
              <img src="{{ $data->path_image }}" class="img-fluid" alt="Phone image"> 
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <div class="card">
                    <div class="card-header text-center">
                        <i class="fas fa-user-circle fa-2x text-primary"></i>
                        <p>
                            <b class="text-primary">LOGIN</b> 
                        </p>
                    </div>
                    <div class="card-body ">
                        <form action="proseslogin" method="POST">
                            @csrf
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                              <input type="text" name="username" id="form1Example13" class="form-control form-control-lg" />
                              <label class="form-label" for="form1Example13">Username </label>
                            </div>
                  
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                              <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" />
                              <label class="form-label" for="form1Example23">Password</label>
                            </div>
                  
                    </div>
                </div>
              
                {{-- <div class="d-flex justify-content-around align-items-center mb-4">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      value=""
                      id="form1Example3"
                      checked
                    />
                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                  </div>
                  <a href="#!">Forgot password?</a>
                </div> --}}
      
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
      
                {{-- <div class="divider d-flex align-items-center my-4">
                  <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                </div> --}}
      
                {{-- <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!" role="button">
                  <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                </a>
                <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!" role="button">
                  <i class="fab fa-twitter me-2"></i>Continue with Twitter</a> --}}
      
              </form>
            </div>
          </div>
        </div>
      </section>

    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('MDB5/js/mdb.min.js') }}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
