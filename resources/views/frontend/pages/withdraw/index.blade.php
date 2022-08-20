@extends('frontend.pages_layouts.master')
@section('title')
    Withdraw
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="section-header">
                    <h1><i class="fa fa-fw fa-hand-holding-usd"></i> Withdrawal Request</h1>
                </div>
                <div class="section-body">
                    <input type="hidden" name="hal" value="withdrawreq">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>
                                Balance <span
                                    class=" text-info">{{ $total_earning ? $total_earning->amount - $withdraw_amount : 0 }}$</span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 float-md-right">
                                    <blockquote>
                                        <p>Your amount withdraw request has been sent successfuly and is under processing.
                                            Your amount will be send to your account after approval.
                                        </p>
                                    </blockquote>
                                </div>
                                <div class="col-md-6">
                                    <form method="POST" action="{{ route('withdraw.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span
                                                        class="input-group-text">Account</span> </div>
                                                <select name='payment_method' class="custom-select" id="inputGroupSelect05"
                                                    required="">
                                                    <option value="" disabled="" selected>Select Payment Methods
                                                    </option>
                                                    @foreach ($payment_methods as $payment_method)
                                                        <option value="{{ $payment_method->id }}"
                                                            {{ $user->payment_method == $payment_method->id ? 'selected' : '' }}>
                                                            {{ $payment_method->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">Amount to
                                                        withdraw</span> </div>
                                                @if (!empty($withdraw))
                                                    <input type="number" min='5'
                                                        max="{{ $total_earning ? $total_earning->amount - $withdraw_amount : 0 }}"
                                                        step="any" id="txamount" name="amount" class="form-control"
                                                        placeholder="0.00" required=""
                                                        oninput="amount_to_receive(this.value)">
                                                @else
                                                    <input type="number" min='5'
                                                        max="{{ $total_earning ? $total_earning->amount - $withdraw_amount : 0 }}"
                                                        step="any" id="txamount" name="amount" class="form-control"
                                                        placeholder="0.00" required=""
                                                        oninput="amount_to_receive(this.value)">
                                                @endif
                                            </div>
                                            <div class="float-right">
                                                <p class="badge badge-info">Amount to receive: $<span
                                                        id="amount_to_receive">0.00</span></p>
                                                <br>
                                                <p class="badge badge-info"> Withdraw Fee: $0.00</p>

                                            </div>
                                        </div>
                                        <div class="float-md-right mt-4"> <a href="" class="btn btn-danger"><i
                                                    class="fa fa-fw fa-redo"></i> Clear</a>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-fw fa-donate"></i> Withdraw Request...</button>
                                        </div>

                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row">
                                <div class="col-sm-12 text-small text-danger"> The system will simply ignore the amount
                                    withdraw request if it doesn't meet our requirements. </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <input type="hidden" name="dosubmit" value="1">
                </div>
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
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body"> </div>
            </div>
        </div>
    </div>
    <script>
        const amount_to_receive = (amount) => {
            document.getElementById('amount_to_receive').innerText = amount != '' ? amount : '0.00';
        }
    </script>
@endsection
