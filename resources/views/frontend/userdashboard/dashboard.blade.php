@include('frontend.include.header')
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
@php
$districts = DB::table('user_districts')->select('*')->get();
$roles = DB::table('user_roles')->select('*')->get();
@endphp


<!--About Content-->
<div class="container">

    <div class="new-arrivals margin-top">
        <div class="contact-whole-container gap">

            @include('frontend.userdashboard.include.sidebar')
            <div class="profile-container">
                <h4>Basic Information</h4>
                <form action="{{ url('updateBasicInformation', ['id' => $publicUsersDetails->id]) }}" method="POST">
                    @csrf
                    <div class="basic-information">

                        <div class="input-div">
                            <label>Name <span>*</span></label><br>
                            <input type="text" name="name" value="{{ $publicUsersDetails->name }}">
                        </div>
                        <div class="input-div">
                            <label>Email <span>*</span></label><br>
                            <input type="text" name="email" value="{{ $publicUsersDetails->email }}">
                        </div>
                        <div class="input-div">
                            <label>Phone No. <span>*</span></label><br>
                            <input type="text" name="mobile_number" value="{{ $publicUsersDetails->mobile_number }}">
                        </div>
                        <div class="input-div">
                            <label>Address <span>*</span></label><br>
                            <input type="text" name="address" value="{{ $publicUsersDetails->address }}">
                        </div>
                        <div class="input-div">
                            <label>School <span>*</span></label><br>
                            <input type="text" name="user_school" value="{{ $publicUsersDetails->user_school }}">
                        </div>
                        <div class="input-div">
                            <label>City <span>*</span></label><br>
                            <input type="text" name="user_city" value="{{ $publicUsersDetails->user_city }}">
                        </div>
                        <div class="input-div">
                            <label>District <span>*</span></label><br>
                            <select name="district">
                                <option value="{{ $publicUsersDetails->user_district }}" selected>
                                    {{ $publicUsersDetails->user_district }}</option>
                                @foreach($districts as $district)
                                @if ($district->title !== $publicUsersDetails->user_district)
                                <option value="{{ $district->title }}">{{ $district->title }}</option>
                                @endif
                                @endforeach
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="input-div">
                            <label>Role <span>*</span></label><br>
                            <select name="role">
                                <option value="{{ $publicUsersDetails->user_catagory }}" selected>
                                    {{ $publicUsersDetails->user_catagory }}</option>
                                @foreach($roles as $role)
                                @if ($role->title !== $publicUsersDetails->user_catagory)
                                <option value="{{ $role->title }}">{{ $role->title }}</option>
                                @endif
                                @endforeach
                                <option value="other">Other</option>
                            </select>
                        </div>




                    </div>
                    <button type="submit" class="login-button" style="margin-top: 20px; font-size: 18px;">Update
                        Information <i class="fa-solid fa-arrow-right"></i> </button>
                </form>
            </div>

        </div>

    </div>
</div>


<!--Membership-->


@include('frontend.include.footer')