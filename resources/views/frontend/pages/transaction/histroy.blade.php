@extends('frontend.pages_layouts.master')
@section('title') Transaction History @endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="section-header">
                <h1><i class="fa fa-fw fa-cash-register"></i> Transaction History</h1>
            </div>
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">{{ __('History') }}
                                    <span class="d-block text-muted pt-2 font-size-sm"></span>
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <section id="horizontal">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">

                                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">

                                                    <table class="table table-striped table-bordered dynamic-height">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('ID') }}</th>
                                                                <th>{{ __('Transaction ID') }}</th>
                                                                <th>{{ __('Date') }}</th>
                                                                <th>{{ __('Amount') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($transactions as $type)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $type->id }}</td>
                                                                <td>{{ $type->created_at }}</td>
                                                                <td>{{ $type->amount }}</td>

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

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection
