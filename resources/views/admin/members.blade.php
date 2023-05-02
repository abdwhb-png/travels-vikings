@extends('layouts.admin.app')

@section('content')
    @if($param == 'list')
    {{-- @include('admin.members-list') --}}
        <members-list-component></members-list-component>
    @endif
    @if($param == 'connection-logs')
    <connection-logs-component></co,nection-logs-component>
    @endif
@endsection