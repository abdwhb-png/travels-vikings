@extends('layouts.member.app')

@section('content')
<div class="row">
    <div class="col-sm grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Current Balance</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">$ {{ $member->balance }}</h2>
                            @if($transactions->count()>0)
                                @if($transactions->first()->type == 1)
                                    <p class="text-success ms-2 mb-0 font-weight-medium">+ {{ $transactions->first()->amount }} $</p>
                                @else
                                    <p class="text-danger ms-2 mb-0 font-weight-medium">- {{ $transactions->first()->amount }} $</p>
                                @endif
                            @endif
                        </div>
                        @if($member->balance<= 0)
                        <h6 class="text-danger font-weight-normal">Please fund your account</h6>
                        @else
                        <h6 class="text-muted font-weight-normal">Minimum Withdrawal : ${{ $member->min_withdrawal }}</h6><h6 class="text-muted font-weight-normal">Maximum Withdrawal : ${{ $member->max_withdrawal }}</h6>
                        @endif
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet text-primary ms-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Completed Tasks</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{$member->completed_tasks }} / {{ $daily_task }}</h2>
                            {{-- <p class="text-success ms-2 mb-0 font-weight-medium">+8.3%</p> --}}
                        </div>
                        @if($member->completed_tasks<$daily_task)
                        <h6 class="text-danger font-weight-normal"> Please complete all your daily tasks</h6>
                        @else
                        <h6 class="text-success font-weight-normal"> All daily tasks are completed</h6>
                        @endif
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-rocket text-info ms-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- transactions list --}}
<member-transactions-list-component :transactions='{!! json_encode($transactions) !!}'></member-transactions-list-component>
@endsection