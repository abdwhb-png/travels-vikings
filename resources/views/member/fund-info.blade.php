@extends('layouts.member.app')

@section('content')
<div class="row ">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Please fill your wallet info</h4>
                @if(Auth::user()->member->fundInfo)
                    <h6 class="text-muted">Network :</h6>
                    <p>{{ Auth::user()->member->fundInfo->network}}</p>
                    <h6 class="text-muted">Wallet Address :</h6>
                    <p>{{ Auth::user()->member->fundInfo->wallet_address}}</p>
                    <div class="row">
                        <code>Please contact the customer service to change your wallet info</code> 
                        <a href="{{ route('contact') }}" class="btn btn-primary col-auto">Contact customer service</a>
                    </div>
                @else
                <form class="forms-sample" action="{{ route('member.fund-info') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-4">
                        <select class="form-select text-muted bg-dark border-0" name="network" required id="network" name="network" aria-label="network">
                            <option selected disabled>Choose the network</option>
                            <option value="ERC-20">ERC 20</option>
                            <option value="TRC-20">TRC 20</option>
                        </select>
                        <label for="network" class="text-secondary">Netword</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" name="wallet_address" required class="form-control text-muted bg-dark" id="wallet" placeholder="Enter your wallet address here">
                        <label for="wallet" class="text-secondary">Wallet Address</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg me-2">Submit</button>
                    <button type="reset" class="btn btn-dark btn-lg">Cancel</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection