@include('frontend.include.header')
@if(session('message'))
<div class="frontend-sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif
<div class="inner-hero">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Get in Touch</p>
    </div>
</div>
<?php
$footers = DB::table('footers')->select('*')->get();
?>
<!--Contact Details-->
<div class="contacts py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <div class="contact-details">
                    <h2 class="my-4">Allied Publications Pvt. Ltd</h2>
                    <ul class="contacts">
                        <li class=" mb-3"><i class="bi bi-house"></i><a href="#"
                                class=" p-0">{{$footers[0]->location}}</a></li>
                        <li class="mb-3">
                            <i class="bi bi-telephone"></i>
                            <a href="tel:+977-{{$footers[0]->phone_number}}" class="p-0">
                                +977-{{$footers[0]->phone_number}}
                            </a>
                        </li>
                        <li class=" mb-3"><i class="bi bi-envelope"></i><a href="#"
                                class=" p-0">{{$footers[0]->mail}}</a>
                        </li>
                        </li>
                        <li class=" mb-3"><i class="bi bi-globe"></i><a href="{{$footers[0]->website_link}}"
                                class=" p-0">www.alliedpublication.com.np</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 contact-form text-end">
                <h2 class="mb-4">Get In Touch</h2>
                <form action="{{ url('/addContactForm') }}" method="POST">
                    @csrf
                    <div class="container-fluid mb-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="username"
                                        aria-describedby="nameHelp" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email"
                                        aria-describedby="emailHelp" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="contact_number" name="contact_number"
                                        aria-describedby="nameHelp" placeholder="Contact Number" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="school_name" name="school_name"
                                        aria-describedby="emailHelp" placeholder="School Name" required>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="exampleFormControlTextarea1"
                                        rows="1" required> Your Message</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Map-->

<div class="map">
    <iframe src="{{$footers[0]->google_map}}"         width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!--Membership-->

@include('frontend.include.footer')