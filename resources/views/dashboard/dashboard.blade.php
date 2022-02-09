@extends('layouts.app')
@section('content')
    <style>
        .content {
            min-height: 120px
        }

    </style>
    <div class="main-content">
        <div class="breadcrumb">
            <h1>Dashboard</h1>
        </div>


        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <!-- ICON BG-->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Add-User"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">Total Customers</p>
                            <p class="text-primary text-24 line-height-1 mb-2"> {{ $totalCustomers }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Add-User"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">Customers last week</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $customersLastWeek }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Add-User"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">Customers this week</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $customersThisWeek }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Add-User"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">Percentage Change</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $percentChange }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="row">
            <!-- ICON BG-->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="fa fa-bar-chart fa-3x text-primary" aria-hidden="true"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">Total orders</p>
                            <p class="text-primary text-24 line-height-1 mb-2"> {{ $totalorders }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-text-left"><i class="fa fa-bar-chart fa-3x text-primary"
                            aria-hidden="true"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Last week's orders</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $lastWeekOrder }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="fa fa-bar-chart fa-3x text-primary" aria-hidden="true"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">This week's orders</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $thisWeekOrders }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="fa fa-bar-chart fa-3x text-primary" aria-hidden="true"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">Percentage Change</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $percentChangeOrder }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>







        <div class="row">
            <!-- ICON BG-->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"> <i class="fa fa-pie-chart fa-3x text-primary"
                            aria-hidden="true"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">Total order transactions</p>
                            <p class="text-primary text-24 line-height-1 mb-2"> {{ $OrderTransactions }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-text-left"><i class="fa fa-pie-chart fa-3x text-primary"
                            aria-hidden="true"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Last week's order Transaction</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $OrderTransactionsLastWeek }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="fa fa-pie-chart fa-3x text-primary" aria-hidden="true"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">This week's order transaction</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $OrderTransactionsThisWeek }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="fa fa-pie-chart fa-3x text-primary" aria-hidden="true"></i>
                        <div class="content text-left">
                            <p class="text-muted mt-2 mb-0">Percentage Change</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $percentChangeT }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    </div>
    </div><!-- ============ Search UI Start ============= -->




@endsection
