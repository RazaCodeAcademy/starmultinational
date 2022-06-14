@extends('backend.layouts.master') 
@section('title') Transaction History @endsection 
@section('main-content')
<div class="container">
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><i class="fa fa-fw fa-cash-register"></i> Transaction History</h1> </div>
            <div class="section-body">
                <form method="get">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4><i class="fa fa-fw fa-search"></i> Find History</h4> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Transaction ID</label>
                                        <input type="text" name="txbatch" id="txbatch" class="form-control" value="" placeholder="Transaction ID"> </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" name="txmemo" id="txmemo" class="form-control" value="" placeholder="Transaction description"> </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Keyword</label>
                                        <input type="txadminfo" name="txadminfo" id="txadminfo" class="form-control" value="" placeholder="Enter transaction keyword"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="float-md-right"> <a href="index.php?hal=historylist&dohal=clear" class="btn btn-warning"><i class="fa fa-fw fa-redo"></i> Clear</a>
                                        <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
                                    </div>
                                    <div class="d-block d-sm-none"> &nbsp; </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <input type="hidden" name="hal" value="historylist"> </form>
                <hr>
                <div class="clearfix"></div>
                <div class="row marginTop">
                    <div class="col-sm-12 paddingLeft pagerfwt">
                        <div class="row">
                            <div class="col-md-7">
                                <ul class='pagination pagination-sm'>
                                    <li class='page-item active'><a class="page-link" href="#">1</a></li>
                                    <li class='page-item'><a class="page-link" href="/member/index.php?page=1&ipp=All&hal=historylist">All</a></li>
                                </ul>
                            </div>
                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" nowrap><a href='/member/index.php?hal=historylist&_stbel=txdatetm&_stype=down'><i class='fa fa-fw fa-arrows-alt-v'></i></a>Date</th>
                                <th scope="col" nowrap><a href='/member/index.php?hal=historylist&_stbel=txbatch&_stype=down'><i class='fa fa-fw fa-arrows-alt-v'></i></a>Transaction ID</th>
                                <th scope="col" nowrap><a href='/member/index.php?hal=historylist&_stbel=txmemo&_stype=down'><i class='fa fa-fw fa-arrows-alt-v'></i></a>Description</th>
                                <th scope="col" nowrap><a href='/member/index.php?hal=historylist&_stbel=txamount&_stype=down'><i class='fa fa-fw fa-arrows-alt-v'></i></a>Amount</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
                <div class="row marginTop">
                    <div class="col-sm-12 paddingLeft pagerfwt">
                        <div class="row">
                            <div class="col-md-7">
                                <ul class='pagination pagination-sm'>
                                    <li class='page-item active'><a class="page-link" href="#">1</a></li>
                                    <li class='page-item'><a class="page-link" href="/member/index.php?page=1&ipp=All&hal=historylist">All</a></li>
                                </ul>
                            </div>
                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
    </div> 
</div>
@endsection