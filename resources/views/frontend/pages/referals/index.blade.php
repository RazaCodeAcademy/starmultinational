@extends('frontend.pages_layouts.master') 
@section('title') 
Referals
@endsection
  @section('content')
   

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
        <div class="content-body">    
            <div class="section-header">
                <h1><i class="fa fa-fw fa-cash-register"></i> Refferal History</h1> 
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
                            <table class="table table-striped table-bordered dynamic-height">
                                <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('User Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
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