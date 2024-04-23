@include('master_layout/header')

<div class="page-body">

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Setting Account</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Setting Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row date-range-picker">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="updateAccount" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 padd-0 mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Username </label>
                                        <input class="form-control input-air-primary" type="text" name="username" required="" value="{{Auth::user()->email}}" readonly>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Current Password </label>
                                        <input class="form-control input-air-primary" type="text" name="password" required="" value="{{Auth::user()->ori_password}}" readonly>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Change New Password </label>
                                        <input class="form-control input-air-primary" type="text" name="password" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Confirm New Password </label>
                                        <input class="form-control input-air-primary" type="text" name="re_password" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('master_layout/footer')
