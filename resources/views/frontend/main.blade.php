@include('frontend.include.header')
@php
use Illuminate\Support\Str;

@endphp
<style>
.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: white;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 100%;
    /* Updated width value */
    position: relative;
    /* Added positioning */
}

.close {
    color: #aaa;
    position: absolute;
    top: -10px;
    right: 10px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.modal-content img {
    width: 100%;
    height: auto;
    margin-bottom: 10px;
}

/* Mobile Responsive Styles */
@media (max-width: 600px) {
    .modal-content {
        margin: 10px;
        padding: 10px;
    }
}
</style>



@foreach($popupimage as $item)
<div id="myModal{{$loop->iteration}}" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('myModal{{$loop->iteration}}')">&times;</span>

        <a href="{{$item->url}}" target="_blank">
            <img src="{{asset($item->image)}}" class="d-block w-100" alt="...">
        </a>

    </div>
</div>
@endforeach



<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        @foreach($sliderimages as $index => $item)
            <button type="button"  data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$index}}"
                class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                aria-label="Slide {{$index + 1}}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach($sliderimages as $index => $item)
            <div style="object-fit: cover;" class="carousel-item{{ $index === 0 ? ' active' : '' }}">
                <img src="{{$item->image}}" class="d-block w-100" alt="...">
            </div>
        @endforeach
    </div>
</div>


<!--About Us-->
<div class="col-xxl-8 px-4 py-5 know-us">
    <div class="container">
        <div class="row know-us-main align-items-end g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{$aboutus[0]->image}}" class="d-block img-fluid" alt="About Allied Publications"
                    loading="lazy">
            </div>

            <div class="col-lg-6 knowus-text">
                <h1 class="display-5 fw-bold lh-1">About Allied Publications</h1>
                <div class="title-bar"></div>
                <div class="about-content">
                    <p>{{$aboutus[0]->title}}</p>
                    <p>{{ Str::limit($aboutus[0]->description, 600) }}..</p>
                    <a href="/aboutus"><button type="button" class="btn btn-outline-dark">Know More</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Featured-->
<div class="recent">
    <div class="featured-books pb-5 text-center">
        <div class="container px-4 pt-5" id="featured-3">
            <h1 class="display-5 fw-bold lh-1">Recent Books</h1>
            <div class="border-img">
                <img src="{{asset('allied/img/border.png')}}" alt="">
            </div>
            <div class="recent-books">
                @foreach($recentbooks as $item)
                <div class="feature-recent col">
                    <div class="card">
                        <img class="card-img" src="{{$item->thumbnail}}" alt="Card image">
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{$item->book_title}}</h5>
                            <p class="card-text"><a href="/bookdescription/{{$item->id}}"> More</a></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div>
            <a href="/books"><button type="button" class="btn btn-outline-dark">View All</button></a>
        </div>
    </div>
</div>

<div class="only-featured featured-books pb-5">
    <div class="container px-4 pt-5" id="featured-3">
        <div class="d-flex justify-content-between">
            <h1 class="display-6 fw-bold lh-1">Featured Books</h1>
            <a href="/books"><button type="button" class="btn">View All</button></a>
        </div>
        <div class="title-bar mb-4"></div>
        <div class="row g-4 pt-3 pb-5 row-cols-1 row-cols-lg-2">
            @foreach($featurebook as $item)
            <div class="feature col">
                <div class="featured-box">
                    <div class="row">
                        <div class="col-6">
                            <img class="" src="{{$item->thumbnail}}" alt=" image">
                        </div>
                        <div class="col-6 featured-book-content d-flex align-items-end">
                            <div>
                                <h5><b>{{$item->book_title}}</b></h5>
                                <p><i>{{ Str::limit($item->description, 100) }}</i></p>
                                <!-- Set a limit of 100 characters -->
                                <h6><b>Author: </b> {{$item->fullname}}</h6>
                                <h6><b>Published Year: </b> {{$item->published_year}}</h6>
                                <a href="/bookdescription/{{$item->id}}" class="my-2 btn btn-outline-dark">Read</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

<!--Modal Questions-->

<div class="modal-question pb-5">
    <div class="container px-4 pt-5 text-center" id="featured-3">
        <h1 class="display-6 fw-bold lh-1">Model Questions</h1>
        <div class="border-img">
            <img src="{{asset('allied/img/border.png')}}" alt="">
        </div>
        <div class="row g-4 pt-3 pb-5 row-cols-1 row-cols-lg-6 text-center">
            @foreach($modelquestions as $item)
            <div class="feature col">
                <div class="card bg-dark text-white">
                    <img class="card-img" src="{{asset($item->thumbnail)}}" alt="Card image">
                    <div class="card-img-overlay">
                        <div class="modal-overlay">
                            <img src="{{asset('allied/img/pdf.png')}}" width="50px" height="50px" />
                            <p class="card-text"><a href="/bookdescription/{{$item->id}}"> Read</a></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <div class="text-center">
        <a href="/books"><button type="button" class="btn btn-outline-dark">View All</button></a>
    </div>

</div>
<div class="authors">
    <div class="container px-4 pt-5" id="featured-3">
        <div class="d-flex justify-content-between">
            <h1 class="display-6 fw-bold lh-1">Authors</h1>
            <button onclick="allauthors()" type="button" class="btn">View All</button>
        </div>
        <div class="title-bar mb-4"></div>
        <div class="row g-4 pt-3 pb-5 row-cols-1 row-cols-lg-4 text-center">
            @foreach($author as $item)
            <div class="col">
                <div class="card">
                    @if(!empty($item->profile_picture))
                    <img class="card-img" src="{{$item->profile_picture}}" alt="Card image">
                    @else
                    <img class="card-img" src="{{asset('allied/img/5856.jpg')}}" alt="Default image">
                    @endif
                    <div class="card-img-overlay">
                        <div class="author-overlay">
                            <h3>{{$item->fullname}}</h3>
                            <p><i>{{$item->description}}</i></p>
                            <p class="card-text"><a href="#"> Know More</a></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
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
<!--Reviews-->
<div class="reviews">
    <div class="text-center mt-5">
        <h1 class="display-6 fw-bold lh-1">Reviews</h1>
        <div class="border-img">
            <img src="img/border.png" alt="">
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row g-2">
            @foreach($reviews as $item)
            <div class="col-md-4">
                <div class="card p-3 text-center px-4">
                    <div class="user-image mb-4">
                        <img src="{{asset($item->image)}}" class="rounded-circle" width="80" height="80">
                    </div>
                    <div class="user-content">
                        <h5 class="mb-0">{{$item->name}}</h5>
                        <span>{{$item->designation}}</span>
                        <p>{{$item->description}} </p>
                    </div>
                    <div class="ratings">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!--Membership-->

<script>
window.onload = function() {
    var modals = document.querySelectorAll('.modal');

    modals.forEach(function(modal) {
        modal.style.display = 'block';
    });
}

function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = 'none';
}
function allauthors(){
    window.location.href = "/allauthors";
}
</script>


@include('frontend.include.footer')