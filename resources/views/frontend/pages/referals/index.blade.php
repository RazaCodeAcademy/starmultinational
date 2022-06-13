@extends('frontend.pages_layouts.master') 
@section('title') 
Referals
@endsection
  @section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1><i class="fa fa-fw fa-users"></i> Referral List</h1> </div>
                <div class="section-body">
                    <form method="get">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4><i class="fa fa-fw fa-search"></i> Find Referral</h4>
                                <div class="card-header-action"> </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="" placeholder="Enter referral name"> </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" id="username" class="form-control" value="" placeholder="Enter referral username"> </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" id="useremail" class="form-control" value="" placeholder="Enter referral email"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-whitesmoke">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="float-md-right"> <a href="index.php?hal=userlist&dohal=clear" class="btn btn-warning"><i class="fa fa-fw fa-redo"></i> Clear</a>
                                                <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
                                            </div>
                                            <div class="d-block d-sm-none"> &nbsp; </div>
                                            <div> <a href="javascript:;" data-href="adduser.php?redir=userlist&addref=umar751" data-poptitle="<i class='fa fa-fw fa-plus-circle'></i> Add Referral" class="openPopup btn btn-dark"><i class="fa fa-fw fa-user-plus"></i> Add Referral</a> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            </form>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="row marginTop">
                        <div class="col-sm-12 paddingLeft pagerfwt"> </div>
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
                                    <th scope="col" nowrap><a href='/member/index.php?hal=userlist&_stbel=in_date&_stype=down'><i class='fa fa-fw fa-arrows-alt-v'></i></a>Date</th>
                                    <th scope="col" nowrap><a href='/member/index.php?hal=userlist&_stbel=username&_stype=down'><i class='fa fa-fw fa-arrows-alt-v'></i></a>Username</th>
                                    <th scope="col" nowrap><a href='/member/index.php?hal=userlist&_stbel=email&_stype=down'><i class='fa fa-fw fa-arrows-alt-v'></i></a>Email</th>
                                    <th scope="col" class="text-center"></th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center mt-4 text-muted">
                                            <div> <i class="fa fa-3x fa-question-circle"></i> </div>
                                            <div>No Record Found</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row marginTop">
                        <div class="col-sm-12 paddingLeft pagerfwt"> </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
        </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="...">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body"> </div>
            </div>
        </div>
    </div> 
@endsection