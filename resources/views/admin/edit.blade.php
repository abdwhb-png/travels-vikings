@extends('layouts.admin.app')

@section('content')
    @if($param == 'member')
        <edit-member-component id="{{ $id }}" page-title="Edit {{ ucfirst($param) }}"></edit-member-component>
    @endif
    @if($param == 'password')
    <change-password-component id="{{ $id }}" page-title="Change Member Password"></change-password-component>
    @endif
    @if($param == 'customer-service')
        <edit-customer-service-component id="{{ $id }}" page-title="Edit {{ ucfirst($param) }}"></edit-customer-service-component>
    @endif
    @if($param == 'system-user')
    <edit-system-user-component id="{{ $id }}" page-title="Edit {{ ucfirst($param) }}">
    </edit-system-user-component>
    @endif
    @if($param == 'deal')
    <div class="row">
        <h3 class="text-center mb-3 text-white">Edit Deal</h3>
        <div class="col-6 mx-auto bg-dark py-4 rounded">
            <form method="POST" action="/admin/update/deal/{{ $deal->id }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="title" required id="" value="{{ $deal->title }}" />
                    <label for="" class="text-black">Deal Title</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control" required id="" rows="3" value="{{ $deal->description }}"></textarea>
                    <label for="" class="text-black">Deal Description</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="file" id="" name="image">
                    <label for="" class="text-black">Deal Image</label>
                </div>
                <div class="row">
                    <button class="btn btn-primary w-25 mx-auto" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection