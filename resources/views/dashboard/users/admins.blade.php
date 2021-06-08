@extends('dashboard.layouts.app')
@section('title', trans('dashboard.user.admins'))
@section('content')

    <!--content wrapper -->
    <div class="content-wrapper">
        <!--content header -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h1>{{  trans('dashboard.user.admins') }}</h1>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.home')}}">{{trans('dashboard.main.home')}}</a></li>
                            <li class="breadcrumb-item active">{{ trans('dashboard.user.admins') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.partials._alert')
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
                                                    <li><a href="{{ route('dashboard.users.create') }}" class="btn btn-success btn-sm mr-1"><i
                                                                class="ft-plus-circle"></i> {{trans('dashboard.main.Create')}} </a>
                                                    </li>
                                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                                </ul>

                                            </div>
                                        </div>
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{trans('dashboard.user.Name')}}</th>
                                                        <th>{{trans('dashboard.user.Email')}}</th>
                                                        <th>{{trans('dashboard.user.phone')}}</th>
                                                        <th>{{trans('dashboard.user.Status')}}</th>
                                                        <th>{{trans('dashboard.main.Actions')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td>{{ trans('dashboard.user.' . $user->status) }}</td>
                                                            <td>
                                                                <a href="{{ route('dashboard.users.edit', $user) }}">
                                                                    <button class="btn btn-info btn-sm" title=""><i
                                                                            class="ft-edit"></i></button>
                                                                </a>
                                                                @if($user->status == 'block')
                                                                    <a href="{{ route('dashboard.users.unblock', $user) }}"
                                                                       class="btn btn-outline-success btn-sm" title="">
                                                                        <i class="ft-unlock"  aria-hidden="true"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('dashboard.users.block', $user) }}"
                                                                       class="btn btn-outline-danger btn-sm" title="">
                                                                        <i class="ft-lock"  aria-hidden="true"></i>
                                                                    </a>
                                                                @endif
                                                                <form
                                                                    action="{{ route('dashboard.users.destroy', $user) }}"
                                                                    id="delete-confirm" method="post"
                                                                    style="display: inline-block">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a href="#" data-toggle="modal"
                                                                       data-target="#delete-user"
                                                                       class="btn btn-danger btn-sm deleteUserBtn" title=""
                                                                       data-user-id="{{ $user->id }}">
                                                                        <i class="ft-trash-2"></i>
                                                                    </a>
                                                                </form><!-- end of form -->
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
            <!--/ Description -->
        </div>
        <!--end of content body -->
    </div>
    <!--end of content wrapper -->

    <!--Delete User Modal -->
    <div id="delete-user" class="modal fade  custom-imodal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('dashboard.user.Delete user') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body custom-addpro">
                    <div class="contact-page">
                        <form id="delete-user-form" action="" method="post">
                            @csrf
                            @method('DELETE')
                            <h2>  {{ trans('dashboard.user.Do you want to delete this user') }} </h2>

                            <div class="form-actions right">
                                <button type="submit" class="btn btn-danger">
                                    {{trans('dashboard.main.delete')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('dashboard.partials.datable')
    <script>
        $('.deleteUserBtn').click(function () {
            var userId = $(this).attr('data-user-id'),
                url = '{{ route("dashboard.users.destroy", ":id") }}';
            url = url.replace(':id', userId);
            $('#delete-user-form').attr('action', url);
        });
    </script>
@endsection
