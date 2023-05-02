@extends('layouts.app')

@section('content')
<h1>Contact</h1>
   <div class="row border border-secondary rounded-lg col-10 mx-auto p-5">
    <div class="row">
        <h2><i class="mdi mdi-email"></i> {{ $help->email }}</h2>
        <h2><i class="mdi mdi-phone"></i> {{ $help->phone }}</h2>
    </div>
   </div>
@endsection