@include('frontend.include.header')
@if(session('message'))
<div class="frontend-sweetmessage">
    <p>{{ session('message') }}</p>
</div>
@endif
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
                <form action="{{ url('/user-forgetpassword') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <button type="submit" href="#" class="btn btn-outline-dark">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('frontend.include.footer')