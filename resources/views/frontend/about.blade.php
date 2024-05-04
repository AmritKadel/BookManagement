@include('frontend.include.header')
@php
use Illuminate\Support\Str;
@endphp
<!--Inner Page Headings-->
<div class="inner-hero">
    <div class="container">
        <h1>About Us</h1>
        <p>We will we will rock you</p>
    </div>
</div>

<!--About Content-->
<div class="about-us-texts py-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p><b>{{$aboutus[0]->description}}</b></p>
                <p><i>"{{$aboutus[1]->description}}" </i></p>
            </div>
            <div class="col-md-4">
                <div class="container-fluid">
                    <div class="row text-center">
                        @foreach($achivements as $item)
                        <div class="col-6">
                            <div class="infographic">
                                <h1>{{$item->title}}</h1>
                                <p>{{$item->description}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="company-pillars mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mission">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$aboutus[2]->title}}</h5>
                                        <p class="card-text">{{ Str::limit($aboutus[2]->description, 700) }}..Read More</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="vision">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$aboutus[3]->title}}</h5>
                                        <p class="card-text">{{ Str::limit($aboutus[3]->description, 700) }}..Read More</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="values">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$aboutus[4]->title}}</h5>
                                        <p class="card-text">{{$aboutus[4]->description}}</p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team">
                    @foreach($teams as $item)
                    <div class="team-card text-center">
                        <div class="user-image">
                            <img src="{{asset($item->profile_picture)}}" class="rounded-circle" width="100" height="100">
                        </div>
                        <div class="user-content">
                            <h5 class="mt-4 mb-0">{{$item->name}}</h5>
                            <span>{{$item->position}}</span>
                            <p>{{$item->contact_number}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--Membership-->


@include('frontend.include.footer')