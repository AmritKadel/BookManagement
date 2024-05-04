@include('frontend.include.header')
<!--Inner Page Headings-->
<div class="inner-hero">
    <div class="container">
        <h1>Our Services</h1>
        <p>Reach us for</p>
    </div>
</div>

<!--Services Content-->
<div class="py-5 service-page">
    <div class="container">
        <div class="row">
            @foreach($service as $item)
            <div class="col-md-4">
                <div class="card">
                    <img height="300px;" width="100px;" class="card-img-top" src="{{$item->service_image}}"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->service_title}}</h5>
                        <p class="card-text">{{$item->service_description}}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- <div class="col-md-4">
    <div class="card">
        <img height="300px;" width="100px;" class="card-img-top" src="{{$service[0]->service_image}}"
            alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{$service[0]->service_title}}</h5>
            <p class="card-text">{{$service[0]->service_description}}</p>
        </div>
    </div>
</div> -->

<!--Why Us-->
<div class="why-us">
    <div class="container px-4 py-5" id="featured-3">
        <h2 class="pb-2">Why Allied Publications?</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="feature col">
                <div class="card py-5">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                        <i class="bi bi-hand-thumbs-up"></i>
                    </div>
                    <h3 class="fs-5">Trusted by Authors </h3>
                </div>
            </div>
            <div class="feature col">
                <div class="card py-5">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                        <i class="bi bi-patch-check"></i>
                    </div>
                    <h3 class="fs-5">Verified Curiculam </h3>
                </div>
            </div>
            <div class="feature col">
                <div class="card py-5">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                        <i class="bi bi-person-workspace"></i>
                    </div>
                    <h3 class="fs-5">Excellent Team</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Membership-->


@include('frontend.include.footer')