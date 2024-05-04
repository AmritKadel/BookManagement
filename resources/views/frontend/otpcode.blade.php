@include('frontend.include.header')
@if(session('message'))
<div class="frontend-sweetmessage">
    <p>{{ session('message') }}</p>
</div>
@endif
<style>
.otp form {
    text-align: center;
}

.otp input {
    width: 13.5% !important;
    margin-bottom: 20px;
    margin-left: 20px;
    border-radius: 5px;
    text-align: center;
}
.register-form-container form input {
    width: 100%;
    margin-top: 15px;
    padding: 15px;
    font-size: 15px;
    border: 1px solid #a8a8a8;
}
</style>
<div class="inner-hero">
    <div class="container text-center">
        <h1>Enter the OTP Code</h1>
    </div>
</div>
<!--Contact Details-->
<div class="login py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 m-auto contact-form text-center">
                <div class="otp register-form-container " style="margin-top: 10px;">
                    <form action="{{url('addOTPCode')}}" method="POST">
                        @csrf
                        <input type="text" style="margin-left: 0px!important;" name="otp_code_1" placeholder="*"
                            class="otp-next" maxlength="1" />
                        <input type="text" placeholder="*" name="otp_code_2" class="otp-next" maxlength="1" />
                        <input type="text" placeholder="*" name="otp_code_3" class="otp-next" maxlength="1" />
                        <input type="text" placeholder="*" name="otp_code_4" class="otp-next" maxlength="1" />
                        <button type="submit" href="#" class="btn btn-outline-dark">Confirm</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<script>
var elts = document.getElementsByClassName('otp-next')
Array.from(elts).forEach(function(elt) {
    elt.addEventListener("keyup", function(event) {
        if (event.keyCode === 13 || elt.value.length == 1) {
            elt.nextElementSibling.focus()
        }
    });
})
</script>
@include('frontend.include.footer')