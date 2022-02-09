<!DOCTYPE html>
<html lang="en" dir="">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin console | {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{ asset('css/themes/lite-purple.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/perfect-scrollbar.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/plugins/jquery-3.3.1.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.5.23/dist/jspdf.plugin.autotable.js"></script>

</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-header text-white font-weight-bold" style="background: #10182a">

            <div class="logor">
                <img class="img-fluid ml-3" src="https://www.pepperest.com/assets/images/logo/pepperest-logo-white.png"
                    alt="{{ config('app.name') }}">
            </div>
            <div class="menu-toggle text-white" style="color: #fff">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="d-flex align-items-center">


            </div>
            <div style="margin: auto"></div>
            <div class="header-part-right">


                <div class="dropdown">
                    <div class="user col align-self-end">

                        <span id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i
                                class="i-Lock-User mr-1 text-white"></i>{{ Auth::user()->name }}</span>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                            <a class="dropdown-item" href="{{ route('password') }}">Change password</a>
                            <a class="dropdown-item">
                                <form id="lgf" method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <label id="lg"> Sign out</label>
                                </form>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="side-content-wrap">
            <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <ul class="navigation-left">




                    <li class="nav-item"><a class="nav-item-hold" href="{{ route('dashboard') }}"><i
                                class="nav-icon i-Bar-Chart"></i><span class="nav-text">Dashboard</span></a>
                        <div class="triangle"></div>
                    </li>
                    <?php
                    $menu = json_decode(Auth::user()->role, true);
                    ?>
                    @foreach ($menu as $key => $item)
                        <li class="nav-item">
                            @if ($key === 'disputes')

                        <li class="nav-item"><a class="nav-item-hold" href="{{ route('disputes') }}">
                                <i class="nav-icon i-File-Clipboard-File--Text"></i><span
                                    class="nav-text">Disputes</span></a>
                            <div class="triangle"></div>
                        </li>
                    @endif

                    @if ($key === 'account')
                        <li class="nav-item" data-item="sessions"><a class="nav-item-hold" href="#"><i
                                    class="nav-icon i-Administrator"></i><span class="nav-text">Account</span></a>
                            <div class="triangle"></div>
                        </li>
                    @endif




                    @if ($key === 'payments')
                        <li class="nav-item"><a class="nav-item-hold" href="{{ route('payments') }}"><i
                                    class="nav-icon i-Computer-Secure"></i><span
                                    class="nav-text">Payments</span></a>
                            <div class="triangle"></div>
                        </li>
                    @endif


                    @if ($key === 'shipments')
                        <li class="nav-item" data-item="shipments"><a class="nav-item-hold"
                                href="datatables.html"><i class="nav-icon i-File-Horizontal-Text"></i><span
                                    class="nav-text">Shipments</span></a>
                            <div class="triangle"></div>
                        </li>
                    @endif

                    @if ($key === 'transaction')
                        <li class="nav-item" data-item="extrakits"><a class="nav-item-hold"
                                href="{{ route('transactions') }}"><i class="nav-icon i-Suitcase"></i><span
                                    class="nav-text">Transactions</span></a>
                            <div class="triangle"></div>
                        </li>
                    @endif

                    @if ($key === 'report')
                        <li class="nav-item" data-item="others"><a class="nav-item-hold" href="#"><i
                                    class="nav-icon i-Double-Tap"></i><span class="nav-text">Reports</span></a>
                            <div class="triangle"></div>
                        </li>
                    @endif

                    </li>
                    @endforeach




                </ul>
            </div>
            <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">



                <ul class="childNav" data-parent="extrakits">
                    <li class="nav-item"><a href="{{ route('orders') }}"><span class="item-name">Order
                            </span></a></li>
                    <li class="nav-item"><a href="{{ route('invoices') }}"><span
                                class="item-name">Invoice</span></a></li>
                    <li class="nav-item"><a href="{{ route('transactions') }}"><span
                                class="item-name">Transactions</span></a></li>

                </ul>

                <ul class="childNav" data-parent="sessions">
                    <li class="nav-item"><a href="{{ route('customers') }}"><i
                                class="nav-icon i-Add-User"></i><span class="item-name">Customers</span></a></li>
                    <li class="nav-item"><a href="{{ route('admins') }}"><i
                                class="nav-icon i-Find-User"></i><span class="item-name">Add Admin Users</span></a>
                    </li>
                    <li class="nav-item"><a href="{{ route('admin.manage') }}"><i
                                class="nav-icon i-Find-User"></i><span class="item-name">Manage Admin
                                Users</span></a></li>

                </ul>
                <ul class="childNav" data-parent="others">
                    <li class="nav-item"><a href="{{ route('audit') }}"><i
                                class="nav-icon i-Error-404-Window"></i><span class="item-name">Audit
                                Trail</span></a></li>
                    <li class="nav-item"><a href="{{ route('audit.transaction') }}"><i
                                class="nav-icon i-Error-404-Window"></i><span class="item-name">Audit
                                Transactions</span></a></li>
                    <li class="nav-item"><a href="{{ route('audit.order') }}"><i
                                class="nav-icon i-Error-404-Window"></i><span class="item-name">Audit
                                Orders</span></a></li>

                    <li class="nav-item"><a href="{{ route('audit.invoice') }}"><i
                                class="nav-icon i-Error-404-Window"></i><span class="item-name">Audit
                                Invoices</span></a></li>

                </ul>

                <ul class="childNav" data-parent="shipments">
                    <li class="nav-item"><a href="{{ route('shipment.all') }}"><i
                                class="nav-icon i-Error-404-Window"></i><span class="item-name">All</span></a></li>
                    <li class="nav-item"><a href="{{ route('shipmet.status', 'booked') }}"><i
                                class="nav-icon i-Male"></i><span class="item-name">Booked</span></a></li>
                    <li class="nav-item"><a class="open"
                            href="{{ route('shipmet.status', 'in-progress') }}"><i
                                class="nav-icon i-File-Horizontal"></i><span
                                class="item-name">In-progress</span></a></li>
                    <li class="nav-item"><a class="open"
                            href="{{ route('shipmet.status', 'delivered') }}"><i
                                class="nav-icon i-File-Horizontal"></i><span class="item-name">Delivered</span></a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-overlay"></div>
        </div>
        <!-- =============== Left side End ================-->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                @yield('content')
            </div><!-- Footer Start -->

        </div>
    </div><!-- ============ Search UI Start ============= -->


    <script src="{{ asset('js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/scripts/script.min.js') }}"></script>
    <script src="{{ asset('js/scripts/sidebar.large.script.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables.min.js') }}"></script>
    <script src="{{ asset('js/scripts/datatables.script.min.js') }}"></script>
    <script>
        // $(document).ready(function() {
        //     $('#zero_configuration_table').DataTable({
        //         "order": []
        //     });
        // });

        $("#lg").click(function() {
            $("#lgf").submit();
        })
    </script>
</body>


</html>
