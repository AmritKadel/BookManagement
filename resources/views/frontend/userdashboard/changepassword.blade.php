@include('frontend.include.header')

<?php
if (session()->has('sessionUserId')) {
    $userId = session()->get('sessionUserId');
    $user = \DB::table('public_users')
        ->select('*')
        ->where('id', $userId)
        
        
        ->first();
}
?>
<style>
@media (min-width: 768px) {
    .input-div {
        width: 45%;
    }
}

@media (min-width: 992px) {
    .input-div {
        width: 30%;
    }
}
</style>
<div class="inner-hero">
    <div class="container">
        <h1>Dashboard</h1>
        <p> Your Profile</p>
    </div>
</div>

@if(session('message'))
<div class="frontend-sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif



<!--About Content-->
<div class="container">

    <div class="new-arrivals margin-top">
        <div class="contact-whole-container gap">

            @include('frontend.userdashboard.include.sidebar')
            <div class="profile-container">
                <h4>Change Password</h4>
                <form action="{{url('changeUserDashboardPassword/'  . $user->id)}}" method="POST">
                    @csrf
                    <div class="basic-information">

                        <div style="width:40%;" class="input-div">
                            <label>New Password<span>*</span></label><br>
                            <input type="text" name="password" placeholder="********************">
                        </div>
                        <div style="width:40%;" class="input-div">
                            <label>Confirm Password <span>*</span></label><br>
                            <input type="text" name="password" placeholder="*********************">
                        </div>
                    </div>
                    <button type="submit" class="login-button" style="margin-top: 20px; font-size: 18px;">Change
                        Password <i class="fa-solid fa-arrow-right"></i> </button>
                </form>
            </div>

        </div>

    </div>
</div>


<!--Membership-->


@include('frontend.include.footer')