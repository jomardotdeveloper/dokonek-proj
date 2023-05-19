<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dokonek</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/schedule.png') }}">
    {{-- <link href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('vendor/chartist/css/chartist.min.css') }}"> --}}
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    @yield('css')
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                {{-- <img class="logo-abbr" src="{{ asset('images/dokonek_logo.png') }}" alt=""> --}}
                {{-- <img class="logo-compact" src="{{ asset('images/dokonek_logo.png') }}" alt=""> --}}
                <img class="brand-title" src="{{ asset('images/dokonek_logo.png') }}" style="height:50px;" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		
		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                {{-- Dashboard --}}
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
									<div class="header-info">
										<span>{{ auth()->user()->name }}</span>

                                        <small>{{ ucfirst(auth()->user()->user_type ) }}</small>
									</div>
                                    @if (auth()->user()->user_type == 'admin')
                                    <img src="{{ asset('images/profile/pic1.jpg') }}" width="20" alt=""/>
                                    @elseif(auth()->user()->user_type == 'doctor')
                                    <img src="{{ auth()->user()->doctor->image_src }}" width="20" alt=""/>
                                    @else
                                    <img src="{{ auth()->user()->patient->image_src }}" width="20" alt=""/>
                                    @endif
                                    
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('profiles.index') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="logout()" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>

                                <form action="{{ route('logout') }}" id="logout-form" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a href="{{ route('dashboard') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    @if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'patient')
                    <li><a href="{{ route('doctors.index') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-user"></i>
                            <span class="nav-text">Doctors</span>
                        </a>
                    </li>
                    @endif
                    
                    <li><a href="{{ route('appointments.index') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-notepad"></i>
                            <span class="nav-text">Appointments</span>
                        </a>
                    </li>
                    @if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'doctor')
                    <li><a href="{{ route('patients.index') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-heart"></i>
                            <span class="nav-text">Patients</span>
                        </a>
                    </li>
                    @endif
                </ul>
            
				<div class="plus-box">
					<p>Dokonek</p>
				</div>
				<div class="copyright">
					<p><strong>Dokonek Dashboard</strong> © 2023 All Rights Reserved</p>
					{{-- <p>Made with <i class="fa fa-heart"></i> by DexignZone</p> --}}
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				@yield('content')
            </div>
        </div>
        <div class="footer">
            <div class="copyright">
               
            </div>
        </div>

    </div>
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
	<script src="{{ asset('js/deznav-init.js') }}"></script>
	{{-- <script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script> --}}
    @stack('scripts')
	
	<script>
        function logout() {
            document.getElementById('logout-form').submit();
        }
    </script>
</body>
</html>