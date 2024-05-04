@include('frontend.include.header')
<div class="inner-hero">
    <div class="container">
        <h1>Dashboard</h1>
        <p> Your Profile</p>
    </div>
</div>
<style>
@media (min-width: 768px) {
    .contact-whole-container {
        flex-direction: row;
    }

    .profile-container {
        flex-grow: 2;
    }

    .basic-information {
        margin: 10px;
        padding: 50px 30px 20px 30px;
    }
}

@media (min-width: 992px) {
    .contact-whole-container {
        gap: 30px;
    }

    .profile-container {
        flex-grow: 3;
    }

    .basic-information {
        margin: 20px;
        padding: 50px 30px 20px 30px;
    }
}
</style>

<?php
if (session()->has('sessionUserId')) {
    $userId = session()->get('sessionUserId');
    $user = \DB::table('public_users')
        ->select('*')
        ->where('id', $userId)
        
      
        ->first();
}
?>


<!--About Content-->
<div class="container">

    <div class="new-arrivals margin-top">
        <div class="contact-whole-container gap">

            @include('frontend.userdashboard.include.sidebar')
            <div class="profile-container">
                <h4>Dashboard</h4>

                <div class="basic-information">
                    <div class="card" style="
    margin: 10px 0;
    padding: 50px 30px 20px 30px;">
                        <div class="row">
                            <div class="col-md-7">
                                <div>
                                    <h5 class="mt-1">{{ $user->name }}</h5>
                                    <div class="school mb-3">
                                        <p class="mb-0" style="font-style: italic;">Student</p>
                                        <p class="mb-0 college" style="font-weight: bold;">
                                            {{ $user->user_school}}
                                        </p>
                                    </div>
                                    <div class="details">
                                        <p class="mb-1"><i class="bi bi-telephone"></i>&nbsp;{{  $user->mobile_number }}
                                        </p>
                                        <p class="mb-1"><i class="bi bi-envelope"></i>&nbsp;{{ $user->email }}
                                        </p>
                                        <p class="mb-1"><i class="bi bi-geo-alt"></i>&nbsp;{{ $user->user_city }}</p>
                                        <p class="mb-1"><i class="bi bi-map"></i>&nbsp;{{ $user->address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="border-left dates">
                                    <p class="mb-2"><b>Join Date:</b> 30th May 2022</p>
                                    <p class="mb-2"><b>Expiry Date:</b> 1st June 2023</p>
                                </div>
                                @if($user->status == 1)
                                <div style=" font-size: 30px;
    color: #216d27;" class="status text-center mt-5">
                                    <i class="bi bi-person-check"></i>
                                    <p style="font-weight: bold;">Active</p>
                                </div>
                                @else
                                <div style=" font-size: 30px;
    color: red;" class="status text-center mt-5">
                                    <i class="bi bi-person-slash"></i>
                                    <p style="font-weight: bold;">Inactive</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>
</div>
<!--Membership-->


@include('frontend.include.footer')