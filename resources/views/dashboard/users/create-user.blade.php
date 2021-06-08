@extends('dashboard.layouts.app')
@section('title', trans('dashboard.main.Create'))
@section('styles')
    <style>
        .img-uploaded img { width: 100px}
    </style>
@stop

@section('content')

    <!--content wrapper -->
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">المستخدمين</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">المستخدمين</a></li>
                            <li class="breadcrumb-item active">اضافة</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">--}}
        {{--            <div class="form-group breadcrum-right">--}}
        {{--                <div class="dropdown">--}}
        {{--                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>--}}
        {{--                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
    <!--end of content wrapper -->
    <div class="content-body">
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافة مستخدم</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="fname-column">
                                                    <label for="first-name-column">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="lname-column">
                                                    <label for="last-name-column">Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="city-column" class="form-control" placeholder="City" name="city-column">
                                                    <label for="city-column">City</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="country-floating" class="form-control" name="country-floating" placeholder="Country">
                                                    <label for="country-floating">Country</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="company-column" class="form-control" name="company-column" placeholder="Company">
                                                    <label for="company-column">Company</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="email" id="email-id-column" class="form-control" name="email-id-column" placeholder="Email">
                                                    <label for="email-id-column">Email</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 ">
                                                <div class="form-label-group">
                                                    <input type="file" id="image" class="form-control" name="email-id-column" placeholder="الصورة">
                                                    <label for="email-id-column">الصورة</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <div class="multi-img-result"></div>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1">اضافة</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic Floating Label Form section end -->
    </div>


@endsection
@section('scripts')
    <script src="{{ asset('assets/js/image-preview-2.js') }}"></script>
@endsection

