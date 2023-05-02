@extends('layouts.member.app')

@section('content')
<div class="row ">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Task {{ $task->id }} Completition</h4>
                <task-completition-component task-id="{{ $task->id }}"></task-completition-component>
                <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel owl-loaded owl-drag"
                    id="owl-carousel-basic">
                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                            style="transform: translate3d(-872px, 0px, 0px); transition: all 0.25s ease 0s; width: 2037px;">
                            <div class="owl-item cloned" style="width: 280.984px; margin-right: 10px;">
                                <div class="item">
                                    <img src="{{ asset('storage'.$task->deal->image_path) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-dots disabled"></div>
                </div>
                <div class="d-flex py-4">
                    <div class="preview-list w-100">
                        <div class="preview-item p-0">
                            <div class="preview-thumbnail">
                                <i class="mdi mdi-rocket fs-3 text-info"></i>
                            </div>
                            <div class="preview-item-content d-flex flex-grow">
                                <div class="flex-grow">
                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                        <h2 class="preview-subject">{{ $task->deal->title }}</h2>
                                    </div>
                                    {{-- <p class="text-muted">Well, it seems to be working now.</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-muted">{{ $task->deal->description }} </p>
            </div>
        </div>
    </div>
</div>
@endsection