@extends('frontend.pages_layouts.master')
@section('title') Earning History @endsection

<style>
    .dataTables_wrapper table {
        display: block;
        width: 100%;
        min-height: .01%;
        overflow-x: inherit;
    }

    .dataTables_scrollHead {
        width: 100% !important;
    }
</style>

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
       
        <div class="content-body">
            <div class="section-header">
                <h1><i class="fa fa-fw fa-cash-register"></i> Earning History</h1>
            </div>
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap border-0 pt-2 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">{{ __('Earning History') }}
                                    <span class="d-block text-muted pt-2 font-size-sm"></span>
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <section id="horizontal">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header">

                                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">

                                                    <table style="width: 100%;" class="table table-striped table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('ID') }}</th>
                                                                <th>{{ __('Earning ID') }}</th>
                                                                <th>{{ __('Date&Time') }}</th>
                                                                <th>{{ __('Amount') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($earning_history as $history)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $history->id }}</td>
                                                                    <td>{{ $history->created_at }}</td>
                                                                    <td>{{ $history->amount }}$</td>
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
