<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ \App\Models\Setting::where('jenis_setting','title-sidebar')->first()->uraian }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('dashmin/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('dashmin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('dashmin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('dashmin/css/style.css')  }}" rel="stylesheet">
    <style>
        .mycolor{
            background-color: #48B7FD;
        }
    </style>
</head>
@yield('header')

<body>
    @include('sweetalert::alert')
    <div class="container-fluid">    
            <!-- Sidebar Start -->
            @php
                $set = \App\Models\Setting::where('jenis_setting','color')->where('status','Y')->get();
                // dd($set->first()->code);
            @endphp
            <div class="sidebar {{  $set->first()->code }}  text-whit e pe-4 pb-3">
                <nav class="navbar {{  $set->first()->code }} text-light navbar-light">
                
                    <a href="" class="navbar-brand mx-4 mb-3">
                        <h3 class="{{ $set->first()->cfont }}"><i class="fa fa-hashtag me-2"></i>
                            {{ \App\Models\Setting::where('jenis_setting','title-sidebar')->first()->uraian }}
                        </h3>
                    </a>

                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative"> 
                            <img class="rounded-circle" src="{{ Auth::user()->file_path }}" alt="" style="width: 40px; height: 40px;">
                            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                            <span>Admin</span>
                        </div>
                    </div>


                    @php
                        $akses = Auth()->user()->akses;
                        // dd($akses);
                        $tmp_menu = \App\Models\Menu::where('hak_akses',$akses)->get();
                    @endphp
                   
                        <div class="navbar-nav w-100">
                            <a href="beranda" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                            <a href="tampiluser" class="nav-link dropdown-toggle {{ $set->first()->cfont }}" >

                            @foreach ($tmp_menu as $item)
                            <a href="{{ $item->link }}" class="nav-link dropdown-toggle {{ $set->first()->cfont }}" >
                                <i class="fa fa-laptop me-2 text-dark"></i>{{ $item->nama_menu }}</a>
                            @endforeach
                        
                            {{-- <a href="beranda" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                            <a href="tampiluser" class="nav-link dropdown-toggle {{ $set->first()->cfont }}" >
                                <i class="fa fa-laptop me-2 text-dark"></i>Users</a>
                                <a href="template" class="nav-link dropdown-toggle {{ $set->first()->cfont }}"  >
                                    <i class="fa fa-laptop me-2 text-dark"></i>Template</a>
                                <a href="setdb" class="nav-link dropdown-toggle {{ $set->first()->cfont }}"  >
                                    <i class="fa fa-laptop me-2 text-dark"></i>Database</a>
                                    <a href="manmenu" class="nav-link dropdown-toggle {{ $set->first()->cfont }}"  >
                                        <i class="fa fa-laptop me-2 text-dark"></i>Man Menu</a> --}}
                            
                            
                        </div>
                </div>

                    
                    
                </nav>
            </div>

            
    <!-- Sidebar End -->
        @yield('sidebar')
        
        
<div class="content">
        <!-- Nav bar -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="admin/beranda" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4" action="search_all" method="GET">
                <input class="form-control border-0" type="search" placeholder="Search" name="value_search">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>
              @php
                $notif = Auth::user()->notifications()->whereNull('read_at')->get();
                // dd($notif);
             @endphp
            <div class="navbar-nav align-items-center ms-auto"> 
                <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    
                    <i class="fa fa-bell me-lg-2 text-primary"></i>
                    <span class="d-none d-lg-inline-flex text-primary">Notificatin</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item">
                      
                          
                            
                    @foreach ($notif as $item)
                        @foreach ($item->data as  $item2)
                                    <h6 class="fw-normal mb-0">
                                        <a href="bacanotif/{{ $item->id }}"  class="text-dark"> {{ $item2  }} </a> 
                                    </h6>
                                 <small class="text-primary">{{ $item->created_at }}</small>
                          
                        @endforeach
                    @endforeach
                </a>
                <hr class="dropdown-divider">
                    {{-- <a href="#" class="dropdown-item text-center">See all notifications</a> --}}
                </div>
            </div>
                <div class="nav-item dropdown">
                    
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="{{ Auth::user()->file_path }}" alt="" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="/admin/profil" class="dropdown-item">My Profile</a>
                        <a href="/admin/tampiluser" class="dropdown-item">Settings</a>
                        <a href="/logout" class="dropdown-item">Log Out</a>
                    </div>
                </div>
            </div>
        </nav>
        @yield('content')
        <!-- endNavbar -->
           
        @yield('footer')
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
            </div>
            <!-- JavaScript Libraries -->
            <script src="{{ asset('dashmin/js/jquery-3.4.1.min.js')}}"></script>
            <script src="{{ asset('dashmin/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{ asset('dashmin/lib/chart/chart.min.js')}}"></script>
            <script src="{{ asset('dashmin/lib/easing/easing.min.js')}}"></script>
            <script src="{{ asset('dashmin/lib/waypoints/waypoints.min.js')}}"></script>
            <script src="{{ asset('dashmin/lib/owlcarousel/owl.carousel.min.js')}}"></script>
            <script src="{{ asset('dashmin/lib/tempusdominus/js/moment.min.js')}}"></script>
            <script src="{{ asset('dashmin/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
            <script src="{{ asset('dashmin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>
            <!-- end javascript libraries -->

            <!-- Template Javascript -->
            <script src="{{ asset('dashmin/js/main.js')}}"></script>
            <script src="{{  asset('dashmin/js/jquery-3.2.1.slim.min.js') }}" ></script>
            <script src="{{  asset('dashmin/js/bootstrap.min.js') }}" ></script>
            
                    
            @yield('script')
        </body>
        </html>