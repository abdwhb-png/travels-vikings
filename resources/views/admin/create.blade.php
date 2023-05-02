@extends('layouts.admin.app')

@section('content')
    @if($param == 'member')
        <add-member-component deal-count="{{ $dealCount }}" page-title="New {{ ucfirst($param) }}"></add-member-component>
    @endif
    @if($param == 'customer-service')
    <add-customer-service-component page-title="New {{ ucfirst($param) }}"></add-customer-service-component>
    @endif
    @if($param == 'system-user')
    <add-system-user-component page-title="New {{ ucfirst($param) }}"></add-system-user-component>
    @endif
    @if($param == 'deal')
    <div class="row">
        <h3 class="text-center mb-3 text-white">New Deal</h3>
        <div class="col-6 mx-auto bg-dark py-4 rounded">
            <form method="POST" action="/admin/store/deal" enctype="multipart/form-data">
                @csrf
                @if (count($errors) > 0)
                    <div class = "alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="title" required id="" value="{{ old('title') }}"/>
                    <label for="" class="text-black">Deal Title</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control" required id="" rows="3" value="{{ old('description') }}"></textarea>
                    <label for="" class="text-black">Deal Description</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="file" id="" required name="image">
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