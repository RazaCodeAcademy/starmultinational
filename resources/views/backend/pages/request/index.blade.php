@extends('backend.layouts.master')

@section('title')
    Request Menbership
@endsection

@section('css')
@endsection

@section('main-content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('Membership Requests') }}</h5>
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">{{ __('List Requests') }}</a>
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
                            <h3 class="card-label">{{ __('Requests') }}
                               
                            </h3>
                        </div>
                      
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="myCustomTable">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('UserName') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Account Type') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $type)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $type->user ? $type->user->username : 'N/A'  }}</td>
                                        <td>{{ $type->description }}</td>
                                        <td>
											<select class="form-select" style="width: 100%; margin:0 auto;" aria-label="Default select example" name="account_type" onchange="changeStatus('{{ $type->user_id }}', this.value)" >
												<option value="" selected disabled> Select Account Types </option>
												@foreach ($account_types as $account_type)
													<option value="{{ $account_type->id }}" {{ $type->user ? ($type->user->account_type == $account_type->id ? 'selected' : '') : '' }}>{{ $account_type->name }}</option>
												@endforeach
											</select>
										</td>
                                        
                                        <td>
                                           
                                            <a style="cursor: pointer" onclick="deleteFunction('{{ $type->id }}') "><i
                                                    class="la la-trash text-danger mr-5"></i></a>
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
@endsection

@section('script')
    <script>
        function deleteFunction(id) {
            var route = "{{ route('manage-request.destroy', 'type_id') }}";
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
        function changeStatus(id, value) {
			var route = "{{ route('userAccounttype', ':id') }}";
			route = route.replace(":id", id);
			$.ajax({
				type: 'GET'
				, url: route
				, data: {
					account_type: value
				, }
				, success: function(response) {
					if (response.success == true) {
						toastr.success(response.message);
						window.location = "{{ route('manage-request.index') }}"
					} else
						toastr.error(response.message);
				}
			})
		}
      
    </script>
@endsection
