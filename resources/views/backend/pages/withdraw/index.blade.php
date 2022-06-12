@extends('backend.layouts.master')

@section('title')
   Withdraw cash
@endsection

@section('css')
@endsection

@section('main-content')
    {{--  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('Withdraw') }}</h5>
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">{{ __('List Withdraw') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">{{ __('Withdraw Table') }}
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('manage-account-types.create') }}"
                                class="btn btn-primary font-weight-bolder"><i class="la la-plus"></i>
                                {{ __('Add Withdraw') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="myCustomTable">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Left Users') }}</th>
                                    <th>{{ __('Right Users') }}</th>
                                    <th>{{ __('Created By') }}</th>
                                    <th>{{ __('Updated By') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Updated At') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($account_types))
                                @foreach ($account_types as $type)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $type->name }}</td>
                                        <td>{{ $type->price }}</td>
                                        <td>{{ $type->left_users }}</td>
                                        <td>{{ $type->right_users }}</td>
                                        <td>{{ $type->created_by() }}</td>
                                        <td>{{ $type->updated_by() }}</td>
                                        <td>{{ $type->updated_by() }}</td>
                                        <td>{{ $type->updated_by() }}</td>
                                        <td>
                                            <a href="{{ route('manage-account-types.edit', $type->id) }}"><i
                                                    class="la la-pencil-alt text-success mr-5"></i></a>
                                            <a style="cursor: pointer" onclick="deleteFunction('{{ $type->id }}') "><i
                                                    class="la la-trash text-danger mr-5"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <div class="container">
        <div class="main-content">
            
                <div class="section-header">
                    <h1><i class="fa fa-fw fa-hand-holding-usd"></i> Withdrawal Request</h1> </div>
                <div class="section-body">
                    <input type="hidden" name="hal" value="withdrawreq">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>
                            Balance <span class=" text-info">$850.00</span>              </h4> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 float-md-right">
                                    <blockquote>
                                        <p><strong>Pending</strong>: The request has been sent but is not yet processed. <strong>Verified</strong>: The request has passed verification. <strong>Processing</strong>: The request is being processed. Once processed, the funds will be sent to your account.</p>
                                    </blockquote>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">Account</span> </div>
                                            <select name='txpaytype' class="custom-select" id="inputGroupSelect05" required="">
                                                <option value="" disabled="" selected>-</option>
                                                @foreach ($accounts as $account )
                                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">Amount to withdraw</span> </div>
                                            <input type="number" min='0' step="any" id="txamount" name="txamount" class="form-control" onChange="dowithdrawfee('0', '0', '$');" placeholder="0.00" required=""> </div>
                                        <h6 class="text-muted text-small">
                                        <span class="badge badge-info float-right" id="txamountstr2"></span>
                                        <span class="badge badge-info float-right" id="txamountstr1"></span>
                                    </h6> </div>
                                    <div class="float-md-right mt-4"> <a href="index.php?hal=withdrawreq" class="btn btn-danger"><i class="fa fa-fw fa-redo"></i> Clear</a>
                                        <button type="button" class="btn btn-primary" ><i class="fa fa-fw fa-donate"></i> Withdraw Request...</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row">
                                <div class="col-sm-12 text-small text-danger"> You are allowed to submit a withdrawal request once a time! The system will simply ignore the request if it is do not meets the requirements. </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <input type="hidden" name="dosubmit" value="1">
                    
                       
                    
                </div>
            
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="...">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body"> </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteFunction(id) {
            var route = "{{ route('manage-account-types.destroy', 'type_id') }}";
            route = route.replace('type_id', id);
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            method: "DELETE",
                            url: route,
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id
                            },
                            success: function(response) {
                                if (response.status === 1) {
                                    swal("Successfully Deleted", {
                                        icon: "success",
                                    });
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    swal("Error While Deleting", {
                                        icon: "error",
                                    });
                                }
                            }
                        });

                    } else {
                        swal("Your Data is safe!");
                    }
                });
        }

        function deleteFunctionSubAdmin(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            method: "POST",
                            url: "{{ route('subAdminDeleteUser') }}",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id
                            },
                            success: function(response) {
                                if (response.status === 1) {
                                    swal("Successfully Deleted", {
                                        icon: "success",
                                    });
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    swal("Error While Deleting", {
                                        icon: "error",
                                    });
                                }
                            }
                        });

                    } else {
                        swal("Your Data is safe!");
                    }
                });
        }
    </script>
@endsection
