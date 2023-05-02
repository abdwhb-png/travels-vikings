@extends('layouts.admin.app')

@section('content')
    @if($param == 'settings')
        <system-settings-component></system-settings-component>
    @endif
    @if($param == 'users')
    <system-users-component></system-users-component>
    @endif
    @if($param == 'roles')
   <system-roles-component></system-roles-component>
    @endif
    @if($param == 'customer-service')
    <system-customer-service-component></system-customer-service-component>
    @endif
@endsection