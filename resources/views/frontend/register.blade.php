@include('frontend.include.header')
@if(session('message'))
<div class="frontend-sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif
<div class="inner-hero">
    <div class="container text-center">
        <h1>Register Now</h1>
    </div>
</div>
<!--Contact Details-->
<div class="register py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 m-auto contact-form text-end">
                <form action="{{ url('/registerUser') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="mobile_number" id="phone"
                            placeholder="Phone Number">
                    </div>
                    <select class="form-select" name="user_district" aria-label="District">
                        <option selected>District</option>
                        @foreach($userDistrict as $item)
                        <option value="{{$item->title}}">{{$item->title}}</option>

                        @endforeach
                    </select>
                    <div class="form-group">
                        <input type="text" name="user_city" class="form-control" id="city" placeholder="City/VDC">
                    </div>
                    <div class="form-group">
                        <input type="text" name="user_school" class="form-control" id="school"
                            placeholder="School Name">
                    </div>
                    <select class="form-select" name="user_category" naria-label="Select Role">
                        <option selected>Role</option>
                        @foreach($userRoles as $item)
                        <option value="{{$item->title}}">{{$item->title}}</option>

                        @endforeach
                    </select>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" id="school"
                            placeholder="Subject">
                    </div>
                    <button type="submit" class="btn btn-outline-dark">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('frontend.include.footer')