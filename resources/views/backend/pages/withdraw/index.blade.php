@extends('backend.layouts.master')

@section('title')
   Withdraw cash
@endsection

@section('css')
@endsection

@section('main-content')
    
@section('main-content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('Withdraw ') }}</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">{{ __('Withdraw Requests') }}</a>
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
                        <h3 class="card-label">{{ __('Withdraw Requests') }}
                           
                        </h3>
                    </div>
                  
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="myCustomTable">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('UserName') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdraws as $type)
                            {{--  @dd($type->payment)  --}}
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $type->user ? $type->user->username : 'N/A'  }}</td>
                                    <td>{{ $type->payment->name ?? 'N/A' }}</td>
                                    <td>
                                       {{ $type->amount ?? 0 }}$
                                    </td>
                                    <td>
                                        <select class="form-select" style="width: 100%; margin:0 auto;" aria-label="Default select example" name="status" onchange="changeStatus('{{ $type->id }}', this.value)" >
                                            <option value="" selected disabled> Select Status </option>
                                            <option value="1" {{$type->status == "1" ? 'selected' : ""}}>Approved</option>
                                            <option value="0" {{$type->status == "0" ? 'selected' : ""}}>DisApproved</option>
                                            <option value="2" {{$type->status == "2" ? 'selected' : ""}}>Pending</option>
                                            
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
    
@endsection

@section('script')
    <script>
        function changeStatus(id, value) {
            var route = "{{ route('manage_withdraw_status', ':type_id') }}";
            route = route.replace(":type_id", id);
            $.ajax({
                type: 'GET'
                , url: route
                , data: {
                    status: value
                , }
                , success: function(response) {
                    if (response.success == true) {
                        toastr.success(response.message);
                        window.location = "{{ route('manage-withdraw.index') }}"
                    } else
                        alert(response.message);
                }
            })
        }
        function deleteFunction(id) {
            var route = "{{ route('manage-withdraw.destroy', 'type_id') }}";
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

       
    </script>
@endsection
