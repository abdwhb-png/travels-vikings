@extends('layouts.admin.app')

@section('content')
    @if($param == 'all')
        <deals-list-component></deals-list-component>
    @endif 
@endsection