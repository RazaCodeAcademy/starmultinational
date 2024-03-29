@extends('frontend.new_layouts.master')
@section('title')
    Register
@endsection
@section('content')


    <div class="d-flex flex-column-fluid welcome">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">{{ __('REGISTER HERE ') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                            <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <form method="POST" action="{{ route('user-register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('First_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control"
                                        placeholder="Enter First Name" value="{{ old('first_name') }}">

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Last_Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter last Name"
                                        name="last_name" value="{{ old('last_name') }}" />
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
                                    <input type="text" class="form-control" placeholder="Enter Username" name="username"
                                        value="{{ old('username') }}" />
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
                                        value="{{ old('email') }}" />
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
                                        value="{{ old('date_of_birth') }}" />
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
                                    <select name="gender" class="form-control">
                                        <option disabled="disabled" value="">
                                            {{ __('Select Gender') }}</option>
                                        <option value='male' {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value='female' {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                        </option>
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
                                    <label>{{ __('City') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter City" name="city"
                                        value="{{ old('city') }}" />
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
                                    <input type="number" class="form-control" placeholder="Enter Zipcode" name="zip_code"
                                        value="{{ old('zip_code') }}" />
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
                                        name="phone_number" value="{{ old('phone_number') }}" />
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
                                    <input type="number" class="form-control" placeholder="Enter Cnic Number"
                                        name="cnic" value="{{ old('cnic') }}" />
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
                                    <select name="payment_process" class="form-control">
                                        <option selected="" disabled="disabled" value="">
                                            {{ __('Select Payment Process') }}</option>
                                        @foreach ($payment_methods as $method)
                                            <option value="{{ $method->id }}"
                                                {{ old('payment_process') == $method->id ? 'selected' : '' }}>
                                                {{ $method->name }}</option>
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
                                    @if (current_route() == 'register')
                                        <input type="text" class="form-control" placeholder="Enter Sponser I'd"
                                            name="sponser_id" required />
                                    @elseif(current_route() == 'user-profile')
                                        <input type="text" class="form-control" placeholder="Enter Sponser I'd"
                                            name="sponser_id" value="{{ $username }}" readonly />
                                    @endif
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
                                        name="password" value="{{ old('password') }}" />
                                    <small class="text-danger">Password must contain 8 characters Atleast One Capital &
                                        small letter number or special character </small>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" placeholder="Confirm Password"
                                        name="password_confirmation" value="{{ old('password_confirmation') }}" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Profile Image') }} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image" value="" />


                                </div>
                            </div>
                            <div class="col-md-12">

                                <fieldset class="checkboxsas">
                                    <label style="position: relative">
                                        <input type="checkbox" name="term&condition" value="{{ old('term&condition') }}"
                                            required>
                                        <label style="position: absolute; width: 90px; top: 1px; left: 19px;"
                                            for="">Terms & Conditions</label>
                                    </label><a href="#" style="position: absolute; top: 1px; left: 125px;"
                                        data-toggle="modal" data-target="#exampleModal"><i class="la la-question-circle"
                                            style="color: rgb(0, 217, 255); font "></i></a>
                                </fieldset>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer" style="text-align: start">
                        <p> Already have Account? </p>
                        <a href="{{ route('login') }}" class="btn btn-primary mr-2">{{ __('Login') }}</a>

                    </div>
                    <div class="card-footer" style="text-align: end">
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Register') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('Reset') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>1. Star Multinational Services have its all rights reserved.</li>
                        <li>2. Minimum Deposit amount is 20$.</li>
                        <li>3. Minimum withdraw amount is 5$.</li>
                        <li>4. Star Multinational's take strict action against using of Data & accets.</li>
                        <li>5. You can receive your payment in 24 hours Approximately.</li>
                        <li>6. Activation balance is not refund or transferable.</li>
                        <li>7. in case of not performing well, you will get repay after 3 months of proprietorship (Except S.R.B).</li>
                        <li>8. For complain & suggestions please contact us.</li>
                        <li><a href="mailto:info@starmultinational.com">info@starmultinational.com</a></li>
                        <li><a href="tel:+923257380732">+923257380732</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

@endsection
