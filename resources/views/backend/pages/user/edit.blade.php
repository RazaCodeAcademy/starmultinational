@extends('backend.layouts.master')

@section('title')
    Create Users
@endsection

@section('css')
@endsection

@section('main-content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('Users') }}</h5>
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('createUser') }}" class="text-muted">{{ __('Create User') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Edit User') }}</h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ route('listAdmins') }}" class="btn btn-primary font-weight-bolder"><i
                                        class="la la-eye"></i>{{ __('View Users') }}</a>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('updateUser',$user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('First_name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control" 
                                            placeholder="Enter First Name" value="{{ $user->first_name }}" required>

                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Last_Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter last Name"
                                            name="last_name" value="{{ $user->last_name }}" required />
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Username') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Username"
                                            name="username" value="{{ $user->username }}" required />
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="Enter Email" name="email"
                                            value="{{ $user->email }}" required />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Date of Birth') }} <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date_of_birth"
                                            value="{{ $user->date_of_birth }}" required />
                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Gender') }} <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-control" required>
                                            <option selected="selected" disabled="disabled" value="">
                                                {{ __('Select Gender') }}</option>
                                            <option value='male' {{$user->gender == "male" ? 'selected' : ""}}>Male</option>
                                            <option  value='female' {{$user->gender == "female" ? 'selected' : ""}}>Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Placement') }} <span class="text-danger">*</span></label>
                                        <select name="placement" class="form-control" required>
                                            <option selected="selected" disabled="disabled" value="">
                                                {{ __('Select Placement') }}</option>
                                            <option value='1' {{$user->placement == "1" ? 'selected' : ""}}>Left</option>
                                            <option value='2' {{$user->placement == "2" ? 'selected' : ""}}>Right</option>
                                        </select>
                                        @error('placement')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('City') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter City" name="city"
                                            value="{{ $user->city }}" required />
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                               

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Zip Code') }} <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Enter Zipcode"
                                            name="zip_code" value="{{ $user->zip_code }}" required />
                                        @error('State')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Enter Name"
                                            name="phone_number" value="{{ $user->phone_number }}" required />
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Cnic Number') }} <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Enter Cnic Number" name="cnic"
                                            value="{{ $user->cnic }}" required />
                                        @error('cnic')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
								<div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Payment Process') }} <span class="text-danger">*</span></label>
                                        <select name="payment_process" class="form-control" required>
                                            <option selected="selected" disabled="disabled" value="">
                                                {{ __('Select Payment Process') }}</option>
											@foreach ($payment_methods as $method)
												<option value="{{ $method->id }}" {{$method->id == $user->payment_process ? 'selected' : ""}}>{{ $method->name }}</option>
												
											@endforeach
                                        </select>
                                        @error('payment_process')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
								<div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __("Sponser I'd") }} <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Enter Sponser I'd" name="sponser_id"
                                            value="{{ $user->sponser_id }}" required />
                                        @error('sponser_id')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
								
								
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Password') }}<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" placeholder="Enter Password"
                                            name="password" value="{{ old('password') }}"  />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                              
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: end">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                            <button type="reset" class="btn btn-secondary">{{ __('Reset') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
