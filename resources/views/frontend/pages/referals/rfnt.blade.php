@extends('frontend.pages_layouts.master')
@section('title')
    Referrals Network
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="section-header">
                    <h1><i class="fa fa-fw fa-cash-register"></i> Referral Network</h1>
                </div>
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="card card-custom gutter-b">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">{{ __('Network') }}
                                        <span class="d-block text-muted pt-2 font-size-sm"></span>
                                    </h3>
                                    {{-- <div class="row p-2">
                                    <div class="col-md-4 ">
                                    
                                        <h3>Total Left:{{ $left->count() ?? 0 }}</h3>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Total Right:{{ $right->count() ?? 0 }}</h3>
                                    </div>
                                </div> --}}
                                </div>

                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('User Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone') }}</th>
                                            <th>{{ __('Date') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
