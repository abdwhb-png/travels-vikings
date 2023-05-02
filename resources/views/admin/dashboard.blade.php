@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Total Members</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0"> {{ $members['total_count'] }}</h2>
                            </div>
                            <div class="row mt-3">
                                <h6 class="text-muted font-weight-normal">Added today: <span class="text-success ms-2 font-weight-medium">+ {{ $members['today_count'] }}</span></h6>
                            </div>
                            <div class="row">
                                <h6 class="text-muted font-weight-normal">Added yesterday: <span class="text-success ms-2 font-weight-medium">+ {{ $members['yesterday_count'] }}</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-account-multiple text-primary ms-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Total Deals</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0"> {{ $deals['total_count'] }}</h2>
                            </div>
                            <div class="row mt-3">
                                <h6 class="text-muted font-weight-normal">Added today: <span class="text-success ms-2 font-weight-medium">+ {{
                                        $deals['today_count'] }}</span></h6>
                            </div>
                            <div class="row">
                                <h6 class="text-muted font-weight-normal">Added yesterday: <span class="text-success ms-2 font-weight-medium">+
                                        {{ $deals['yesterday_count'] }}</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-airplane text-danger ms-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Total Granted Commissions</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0"> $ {{ $com['total_com'] }}</h2>
                            </div>
                            <div class="row mt-3">
                                <h6 class="text-muted font-weight-normal">Granted today: <span
                                        class="text-success ms-2 font-weight-medium">$ {{
                                        $com['today_com'] }}</span></h6>
                            </div>
                            <div class="row">
                                <h6 class="text-muted font-weight-normal">Granted yesterday: <span
                                        class="text-success ms-2 font-weight-medium">$
                                        {{ $com['yesterday_com'] }}</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-cash-usd text-warning ms-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">${{ $balance['total'] }}</h3>
                                <p class="text-success ms-2 mb-0 font-weight-medium">+{{ $balance['today'] }}$</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <span class="mdi mdi-wallet icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">All members balances</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $frozen['members'] }}</h3>
                                <p class="text-success ms-2 mb-0 font-weight-medium">$ {{ $frozen['balance'] }}</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-weather-snowy icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">All frozen members</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $completed_tasks }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-calendar-check icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Today Completed Tasks</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body d-none">
                    <div class="row ">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">$31.53</h3>
                                <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Expense current</h6>
                </div>
            </div>
        </div>
    </div>
@endsection