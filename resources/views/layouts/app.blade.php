<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard &mdash;</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/gear.svg') }}" type="image/x-icon">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap4.css') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    @livewireStyles
</head>

<body style="background: #e2e8f0">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">MUTU APP</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">MUTU</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">MAIN MENU</li>
                        <li class="{{ setActive('/dashboard') }}"><a class="nav-link"
                                href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span></a></li>


                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">FARMASI</li>
                        @endif
                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('farmasis.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>INM</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('farmasis.index')
                                <li class="{{ setActive('/farmasi') }}"><a class="nav-link"
                                        href="{{  route('farmasis.index') }}"><i class="fas fa-book-open"></i>Fornas</a>
                                    </li>
                                @endcan
                                {{-- @can('list.index')
                                <li class="{{ setActive('/list') }}"><a class="nav-link"
                                        href="{{  route('list.index') }}"><i class="fas fa-book-open"></i>obat</a>
                                    </li>
                                @endcan --}}
                            </ul>
                        </li>
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('farmasis.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>IMPRS</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                
                                @can('imprs.index')
                                <li class="{{ setActive('/imprs') }}"><a class="nav-link"
                                        href="{{  route('imprs.index') }}"><i class="fas fa-book-open"></i>Double Check</a>
                                    </li>
                                @endcan
                            
                                @can('obat_racikans.index')
                                <li class="{{ setActive('/obat_racikan') }}"><a class="nav-link"
                                        href="{{  route('obat_racikans.index') }}"><i class="fas fa-book-open"></i>Waktu Tunggu Obat Racikan</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('farmasis.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>IMUT</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('obat_jadis.index')
                                <li class="{{ setActive('/obat_jadi') }}"><a class="nav-link"
                                        href="{{  route('obat_jadis.index') }}"><i class="fas fa-book-open"></i>Waktu Tunggu Obat Jadi</a>
                                    </li>
                                @endcan
                            </ul>
                            <ul class="dropdown-menu">
                                @can('pemberian_obats.index')
                                <li class="{{ setActive('/pemberian_obat') }}"><a class="nav-link"
                                        href="{{  route('pemberian_obats.index') }}"><i class="fas fa-book-open"></i>Pemberian Obat</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">OK</li>
                        @endif
                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('oks.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>OK
                                Management</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('oks.index')
                                <li class="{{ setActive('/ok') }}"><a class="nav-link"
                                        href="{{  route('oks.index') }}"><i class="fas fa-book-open"></i>Operasi</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">PPI</li>
                        @endif

                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('ppis.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>INM</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('ppis.index')
                                <li class="{{ setActive('/ppi') }}"><a class="nav-link"
                                        href="{{  route('ppis.index') }}"><i class="fas fa-book-open"></i>Cuci Tangan</a>
                                    </li>
                                @endcan
                            
                                @can('apds.index')
                                <li class="{{ setActive('/apd') }}"><a class="nav-link"
                                        href="{{  route('apds.index') }}"><i class="fas fa-book-open"></i>Apd</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('idos.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>IMPRS</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('idos.index')
                                <li class="{{ setActive('/ido') }}"><a class="nav-link"
                                        href="{{  route('idos.index') }}"><i class="fas fa-book-open"></i>IDO</a>
                                    </li>
                                @endcan
                            
                                @can('plebitis.index')
                                <li class="{{ setActive('/plebiti') }}"><a class="nav-link"
                                        href="{{  route('plebitis.index') }}"><i class="fas fa-book-open"></i>PLEBITIS</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">RI</li>
                        @endif

                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('ris.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>INM</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('ris.index')
                                <li class="{{ setActive('/ri') }}"><a class="nav-link"
                                        href="{{  route('ris.index') }}"><i class="fas fa-book-open"></i>Indentifikasi Pasien</a>
                                    </li>
                                @endcan
                            
                                @can('visites.index')
                                <li class="{{ setActive('/visite') }}"><a class="nav-link"
                                        href="{{  route('visites.index') }}"><i class="fas fa-book-open"></i>Jam Visite Dokter</a>
                                    </li>
                                @endcan
                            
                                @can('clinicals.index')
                                <li class="{{ setActive('/clinical') }}"><a class="nav-link"
                                        href="{{  route('clinicals.index') }}"><i class="fas fa-book-open"></i>Clinical Pathway</a>
                                    </li>
                                @endcan
                            </ul>
                            <ul class="dropdown-menu">
                                @can('jatuhs.index')
                                <li class="{{ setActive('/jatuh') }}"><a class="nav-link"
                                        href="{{  route('jatuhs.index') }}"><i class="fas fa-book-open"></i>Resiko Jatuh</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('ewss.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>IMPRS</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('ewss.index')
                                <li class="{{ setActive('/ews') }}"><a class="nav-link"
                                        href="{{  route('ewss.index') }}"><i class="fas fa-book-open"></i>Pengisian EWS</a>
                                    </li>
                                @endcan
                            
                                @can('inters.index')
                                <li class="{{ setActive('/inter') }}"><a class="nav-link"
                                        href="{{  route('inters.index') }}"><i class="fas fa-book-open"></i>Intervensi Risiko Jatuh</a>
                                    </li>
                                @endcan
                            
                                @can('dpjps.index')
                                <li class="{{ setActive('/dpjp') }}"><a class="nav-link"
                                        href="{{  route('dpjps.index') }}"><i class="fas fa-book-open"></i>Verifikasi DPJP</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">RAJAL</li>
                        @endif

                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('rajals.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>RAJAL
                                Management</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('rajals.index')
                                <li class="{{ setActive('/rajal') }}"><a class="nav-link"
                                        href="{{  route('rajals.index') }}"><i class="fas fa-book-open"></i>Waktu Tunggu</a>
                                    </li>
                                @endcan
                            
                                @can('asess.index')
                                <li class="{{ setActive('/ases') }}"><a class="nav-link"
                                        href="{{  route('asess.index') }}"><i class="fas fa-book-open"></i>Assesment</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">RM</li>
                        @endif

                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('rmrs.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>RM
                                Management</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('rmrs.index')
                                <li class="{{ setActive('/rmr') }}"><a class="nav-link"
                                        href="{{  route('rmrs.index') }}"><i class="fas fa-book-open"></i>Kelengkapan Rajal</a>
                                    </li>
                                @endcan
                            
                                @can('rmris.index')
                                <li class="{{ setActive('/rmri') }}"><a class="nav-link"
                                        href="{{  route('rmris.index') }}"><i class="fas fa-book-open"></i>Kelengkapan RI</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>


                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">Radiologi</li>
                        @endif

                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('radios.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Radiologi
                                Management</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('radios.index')
                                <li class="{{ setActive('/radio') }}"><a class="nav-link"
                                        href="{{  route('radios.index') }}"><i class="fas fa-book-open"></i>Radiologi</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        
                        
                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">LABORATORIUM</li>
                        @endif

                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('nilai_kritiss.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>INM</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('nilai_kritiss.index')
                                <li class="{{ setActive('/nilai_kritis') }}"><a class="nav-link"
                                        href="{{  route('nilai_kritiss.index') }}"><i class="fas fa-book-open"></i>REGISTRASI PELAPORAN HASIL NILAI KRITIS</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('monitorings.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>IMPRS</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('monitorings.index')
                                <li class="{{ setActive('/monitoring') }}"><a class="nav-link"
                                        href="{{  route('monitorings.index') }}"><i class="fas fa-book-open"></i>MONITORING IDENTIFIKASI SAMPLE</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        
                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">MUTU</li>
                        @endif

                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('imprs.grafik_doublecheck') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>INM</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('farmasis.grafik_fornas')
                                <li class="{{ setActive('/grafik_fornas') }}"><a class="nav-link"
                                        href="{{  route('farmasis.grafik_fornas') }}"><i class="fas fa-book-open"></i>Grafik INM</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('imprs.grafik_doublecheck') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>IMPRS</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('imprs.grafik_doublecheck')
                                <li class="{{ setActive('/grafik_doublecheck') }}"><a class="nav-link"
                                        href="{{  route('imprs.grafik_doublecheck') }}"><i class="fas fa-book-open"></i>Grafik IMPRS</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">PENGATURAN</li>
                        @endif

                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan

                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Users
                                Management</span></a>
                            @endif

                            <ul class="dropdown-menu">
                                @can('roles.index')
                                    <li class="{{ setActive('admin/role') }}"><a class="nav-link"
                                        href="{{ route('roles.index') }}"><i class="fas fa-unlock"></i> Roles</a>
                                </li>
                                @endcan

                                @can('permissions.index')
                                    <li class="{{ setActive('/permission') }}"><a class="nav-link"
                                    href="{{ route('permissions.index') }}"><i class="fas fa-key"></i>
                                    Permissions</a></li>
                                @endcan

                                @can('users.index')
                                    <li class="{{ setActive('/user') }}"><a class="nav-link"
                                        href="{{ route('users.index') }}"><i class="fas fa-users"></i> Users</a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            @yield('content')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2024 <div class="bullet"></div> MUTU APP <div class="bullet"></div> RSU 'Aisyiyah Purworejo
                </div>
                <div class="footer-right">
                    <div class="bullet"></div> Semangat yaa🫰<div class="bullet"></div>
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        //active select2
        $(document).ready(function () {
            $('select').select2({
                theme: 'bootstrap4',
                width: 'style',
            });
        });

        //flash message
        @if(session()->has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif
    </script>

    @livewireScripts
</body>
</html>
