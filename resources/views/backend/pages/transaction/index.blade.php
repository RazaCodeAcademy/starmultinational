@extends('backend.layouts.master') 
@section('title') Transaction History @endsection 
@section('main-content')
<div class="container" style="margin-bottom: 20%;">
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><i class="fa fa-fw fa-cash-register"></i> Transaction History</h1> </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="myCustomTable">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Transaction ID') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Sender Name') }}</th>
                                <th>{{ __('Amount') }}</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $type)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->created_at }}</td>
                                    <td>{{ $type->user ? $type->user->username : 'N/A' }}</td>
                                    <td>{{ $type->amount }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </section>
    </div> 
</div>
@endsection