@extends('dashboard.layouts.app')
@section('title', trans('dashboard.main.messages'))
@section('content')
    <div class="content-wrapper">
        <!--content wrapper -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h1 class="content-header-title">{{trans('dashboard.main.messages')}}</h1>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.home')}}">{{trans('dashboard.main.home')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{trans('dashboard.main.messages')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- end of content header -->
        @include('dashboard.partials._alert')
        <!--content body -->
        <div class="content-body">
            <!-- Description -->
            <section id="description" class="card">
                <div class="card-content">
                    <div class="card-body">
                        <!-- HTML5 export buttons table -->
                        <section id="dom">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li>
                                                        <a href="{{ route('dashboard.message.email.form') }}"
                                                           class="btn btn-success btn-sm mr-1">
                                                            <i class="ft-plus-circle"></i>
                                                            {{trans('dashboard.messages.Email send')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('dashboard.message.sms.form') }}"
                                                           class="btn btn-outline-success btn-sm mr-1">
                                                            <i class="ft-plus-circle"></i>
                                                            {{trans('dashboard.messages.SMS send')}}
                                                        </a>
                                                    </li>
                                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                                </ul>

                                            </div>
                                        </div>
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{trans('dashboard.messages.receiver')}}</th>
                                                        <th>{{trans('dashboard.messages.title')}}</th>
                                                        <th>{{trans('dashboard.messages.content')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($messages as $index => $message)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ ($message->receiver) ? $message->receiver->name : '' }}</td>
                                                            <td>
                                                                <span style="font-size:12px;font-family:monospace;width:200px;word-break:break-all;word-wrap:break-word;">{{ $message->title }}</span>
                                                            </td>
                                                            <td>
                                                                <span style="font-size:12px;font-family:monospace;width:200px;word-break:break-all;word-wrap:break-word;">{!!  longText( $message->body ) !!}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--/ HTML5 export buttons table -->
                    </div>
                </div>
            </section>
            <!--/ Description -->
        </div>
        <!--end of content body -->
    </div>
    <!--end of content wrapper -->

@endsection
@section('scripts')
    @include('dashboard.partials.datable')
@endsection
