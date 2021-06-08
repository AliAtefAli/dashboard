@extends('dashboard.layouts.app')
@section('title', trans('dashboard.main.Users'))
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/plugins/file-uploaders/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/pages/data-list-view.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/custom'.appDirection().'.css') }}">

@stop

@section('content')

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


    <!--content wrapper -->
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">المستخدمين</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">المستخدمين</a></li>
                            <li class="breadcrumb-item active">الكل</li>
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

    <!-- Data list view starts -->
    <section id="data-list-view" class="data-list-view-header">
        <div class="action-btns d-none">
            <div class="btn-dropdown mr-1 mb-1">
                <div class="btn-group dropdown actions-dropodown">
                    <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another Action</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable starts -->
        <div class="table-responsive">

            <!-- BTN starts -->
            <div class="dt-buttons btn-group">

                <div class="dropdown mr-1 ">
                    <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        اجراءات
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item delete-all" href="#">حذف</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>

                <a href="{{ route('dashboard.users.create-user') }}" class="btn btn-outline-primary">
                    <span><i class="feather icon-plus"></i> Add New</span>
                </a>
            </div>
            <!-- BTN starts -->
            <table class="table data-list-view">
                <thead>
                <tr>
                    <th></th>
                    <th>NAME</th>
                    <th>CATEGORY</th>
                    <th>POPULARITY</th>
                    <th>ORDER STATUS</th>
                    <th>PRICE</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td class="product-name">Altec Lansing - Mini H2O Bluetooth Speaker</td>
                    <td class="product-category">Fitness</td>
                    <td>
                        <div class="progress progress-bar-success">
                            <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="40" aria-valuemax="100" style="width:87%"></div>
                        </div>
                    </td>
                    <td>
                        <div class="chip chip-success">
                            <div class="chip-body">
                                <div class="chip-text">delivered</div>
                            </div>
                        </div>
                    </td>
                    <td class="product-price">$199.99</td>
                    <td class="product-action">
                        <span data-user-id="1" class="action-edit" data-name="name" data-price="100" data-category="1">
                            <i class="feather icon-edit"></i>
                        </span>
                        <span class="action-delete" data-user-id="1"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- DataTable ends -->

        <!-- add new sidebar starts -->
        <div class="add-new-data-sidebar">
            <div class="overlay-bg"></div>
            <div class="add-new-data">
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">Edit user</h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="data-fields px-2 mt-3">
                        <form id="edit-user-form" action="" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-sm-12 data-field-col">
                                    <label for="data-name">Name</label>
                                    <input type="text" class="form-control" id="data-name">
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="data-category"> Category </label>
                                    <select class="form-control" id="data-category">
                                        <option>Audio</option>
                                        <option>Computers</option>
                                        <option>Fitness</option>
                                        <option>Appliance</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="data-status">Order Status</label>
                                    <select class="form-control" id="data-status">
                                        <option>Pending</option>
                                        <option>Canceled</option>
                                        <option>Delivered</option>
                                        <option>On Hold</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="data-price">Price</label>
                                    <input type="text" class="form-control" id="data-price">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <div class="add-data-btn">
                        <button class="btn btn-primary">Add Data</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button class="btn btn-outline-danger">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add new sidebar ends -->
    </section>
    <!-- Data list view end -->



@endsection
@section('scripts')
    <script src="{{ asset('assets/js/image-preview-2.js') }}"></script>

    <script src="{{ asset('assets/dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <!-- BEGIN: Page Vendor JS-->

    <script src="{{ asset('assets/dashboard/app-assets/js/scripts/ui/data-list-view.js') }}"></script>

    <script>
        var selectedUsers = [];

        // On Edit
        $('.action-edit').on("click",function(e){
            e.stopPropagation();
            var name = $(this).data('name'),
                price = $(this).data('price'),
                category = $(this).data('category'),
                userId = $(this).attr('data-user-id'),
                url = '{{ route("dashboard.users.update", ":id") }}';

            url = url.replace(':id', userId);
            $('#edit-user-form').attr('action', url);

            $('#data-name').val(name);
            $('#data-price').val(price);
            $(".add-new-data").addClass("show");
            $(".overlay-bg").addClass("show");
        });

        // On Delete
        // confirm options
        $('.action-delete').on('click', function () {
            var userId = $(this).data('user-id'),
                url = '{{ route("dashboard.users.destroy", ":id") }}';


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url,
                        _token: "{{ csrf_token() }}",
                        data: {
                            users: selectedUsers
                        },
                        success: function(response) {
                            Swal.fire(
                                {
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    confirmButtonClass: 'btn btn-success',
                                }
                            )
                        }
                    });
                }
            })
        });

        $('.delete-all').click(function () {
            selectedUsers = [];
            $('.dt-checkboxes:checked').each(function() {
                selectedUsers.push( this.value );
            });
            console.log(selectedUsers);
            console.log(selectedUsers.length);
            if(selectedUsers.length < 1)
                toastr.error('no user selected');
            else {
                $.ajax({
                    url: "{{ route('dashboard.users.deleteAll') }}",
                    _token: "{{ csrf_token() }}",
                    data: {
                        users: selectedUsers
                    },
                    success: function(response) {
                        toastr.success('deleted');
                    }
                });
            }

        });

    </script>
@endsection

