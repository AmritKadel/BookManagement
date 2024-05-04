@include('frontend.include.header')
<div class="inner-hero">
    <div class="container text-center">
        <h1>Reset Password</h1>
    </div>
</div>
<!--Contact Details-->
<div class="login py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 m-auto contact-form text-center">
                <form action="{{url('changeUserPassword')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="confirm password"
                            placeholder="Confirm Password">
                    </div>
                    <button type="submit"  class="btn btn-outline-dark">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('frontend.include.footer')