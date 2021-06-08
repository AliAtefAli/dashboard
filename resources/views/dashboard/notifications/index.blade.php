@extends('dashboard.layouts.app')
@section('title', trans('notifications.notifications'))
@section('content')

    <!--content wrapper -->
    <div class="content-wrapper">
        <!--content header -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h1>{{  trans('notifications.notifications') }}</h1>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">{{ trans('notifications.notifications') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.partials._alert')
        <div class="content-body">

            @foreach($notifications as $notification)
                <a href="{{@handleNotificationRoute($notification)}}">
                    <div class="alert alert-success mb-2">
                        {{ $notification->data[ app()->getLocale() . '_msg'] }}
                    </div>
                </a>
            @endforeach

        </div>
        <!--end of content body -->
    </div>
    <!--end of content wrapper -->


@endsection
