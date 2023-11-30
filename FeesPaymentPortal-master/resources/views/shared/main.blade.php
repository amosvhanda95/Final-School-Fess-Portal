<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min2167.css?v=3.2.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css') }}">
   
  

    
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">
    <script nonce="a17c5ee1-837f-4a03-8b93-d7a2e17ed4db">
        (function(w, d) {
            ! function(bv, bw, bx, by) {
                bv[bx] = bv[bx] || {};
                bv[bx].executed = [];
                bv.zaraz = {
                    deferred: [],
                    listeners: []
                };
                bv.zaraz.q = [];
                bv.zaraz._f = function(bz) {
                    return function() {
                        var bA = Array.prototype.slice.call(arguments);
                        bv.zaraz.q.push({
                            m: bz,
                            a: bA
                        })
                    }
                };
                for (const bB of ["track", "set", "debug"]) bv.zaraz[bB] = bv.zaraz._f(bB);
                bv.zaraz.init = () => {
                    var bC = bw.getElementsByTagName(by)[0],
                        bD = bw.createElement(by),
                        bE = bw.getElementsByTagName("title")[0];
                    bE && (bv[bx].t = bw.getElementsByTagName("title")[0].text);
                    bv[bx].x = Math.random();
                    bv[bx].w = bv.screen.width;
                    bv[bx].h = bv.screen.height;
                    bv[bx].j = bv.innerHeight;
                    bv[bx].e = bv.innerWidth;
                    bv[bx].l = bv.location.href;
                    bv[bx].r = bw.referrer;
                    bv[bx].k = bv.screen.colorDepth;
                    bv[bx].n = bw.characterSet;
                    bv[bx].o = (new Date).getTimezoneOffset();
                    if (bv.dataLayer)
                        for (const bI of Object.entries(Object.entries(dataLayer).reduce(((bJ, bK) => ({
                                ...bJ[1],
                                ...bK[1]
                            }))))) zaraz.set(bI[0], bI[1], {
                            scope: "page"
                        });
                    bv[bx].q = [];
                    for (; bv.zaraz.q.length;) {
                        const bL = bv.zaraz.q.shift();
                        bv[bx].q.push(bL)
                    }
                    bD.defer = !0;
                    for (const bM of [localStorage, sessionStorage]) Object.keys(bM || {}).filter((bO => bO
                        .startsWith("_zaraz_"))).forEach((bN => {
                        try {
                            bv[bx]["z_" + bN.slice(7)] = JSON.parse(bM.getItem(bN))
                        } catch {
                            bv[bx]["z_" + bN.slice(7)] = bM.getItem(bN)
                        }
                    }));
                    bD.referrerPolicy = "origin";
                    bD.src = "{{ asset('assets/js/') }}sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(bv[
                        bx])));
                    bC.parentNode.insertBefore(bD, bC)
                };
                ["complete", "interactive"].includes(bw.readyState) ? zaraz.init() : bv.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/dashboard" class="nav-link">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/dashboard" class="brand-link">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Posb Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">FEES PAYMENTS</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">{{ request()->user()->first_name }}
                            {{ request()->user()->last_name }}

                        </a>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (auth()->check() && auth()->user()->type === 1)
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-school"></i>
                                    <p> Schools Section <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/school/create" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add new School</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/school" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Registered Schools</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/bank_account" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Schools Bank Account</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/bursars" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Schools Bursars</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-school"></i>
                                    <p> Branches & Agents <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/branch/create" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add new Branch</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="/branch" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Available Branches / Agents</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-credit-card"></i>
                                <p> Payments <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/payment/create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Capture Fees Payment</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/payment/zou" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ZOU Fees Payment</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/payments" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payments History</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if (auth()->check() && auth()->user()->type === 1)
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p> Reports <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/generate-report" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Generate Reports</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="/user" class="nav-link">
                                    <i class="nav-icon far fa-user"></i>
                                    <p> System Users <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/user/create" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add new User</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="/user" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Available Users</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

{{-- 
                        cross boader section --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-user"></i>
                                <p> Cross-Boarder  <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <!-- Customers Dropdown -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Customers <i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/customer/create" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Register Customer</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/customer" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Available Customers</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Beneficiary <i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/beneficiary/create" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Register Beneficiary</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/beneficiary" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Available Beneficiaries</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                        
                                <!-- Payments Dropdown -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payments <i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/crossboarder" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Make Payment</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/crossboader-payment" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Payments History</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-question-circle"></i>
                                    <p> Support <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="log-viewer" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Logs <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        {{-- <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="/log-viewer" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Ethix Requests</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/log-viewer" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>System Logs</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="pages/examples/forgot-password.html" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Support Logs</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="pages/examples/recover-password.html" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Access Logs</p>
                                                </a>
                                            </li>
                                        </ul> --}}
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Notifications<i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="/sms" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>SMS</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/email" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Email</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/pops" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>POPs</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-lightbulb"></i>
                                    <p> APIS <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Schools & Universities <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="/clients" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Client Credentials</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="pages/examples/login.html" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Generate Access</p>
                                                </a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a href="log-viewer" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Requests Logs</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="log-viewer" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Error Logs</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ZSS<i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="/log-viewer" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Client Credentials</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/log-viewer" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Generate Access</p>
                                                </a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a href="/log-viewer" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Requests Logs</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/log-viewer" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Error Logs</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                            <li>
                                <a href="/auth/logout" class="nav-link">
                                    <i class="nav-icon far fa-lightbulb"></i>
                                    <p> Logout <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                            </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="https://posb.co.zw">Posb</a>. 
            </strong> All rights reserved. 
            <div
                class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </body>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/js/adminlte2167.js?v=3.2.0') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src=" {{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>




    <script>
        $(".alert").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>


</html>
