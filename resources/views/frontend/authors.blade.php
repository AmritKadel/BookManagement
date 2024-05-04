@php
use Illuminate\Support\Str;
$author = DB::table('authors')->select('*')->where('status',0)->get();
@endphp
@include('frontend.include.header')
<div class="inner-hero">
    <div class="container">
        <h1>Authors</h1>
        
    </div>
</div>


<!--Books-->
<div class="books-page only-featured featured-books pb-5">
    <div class="container px-4 pt-5" id="featured-3">

        <hr>
        <div class="col-sm-12">
            <div class="row g-4 pt-3 pb-5">
                @foreach($author as $item)
                <div class="feature col-md-4">
                    <div class="featured-box">
                        <div class="row">
                            <div class="col-6">
                                @if(!empty($item->profile_picture))
                                <img class="card-img" src="{{$item->profile_picture}}" alt="Card image">
                                @else
                                <img class="card-img" src="{{asset('allied/img/5856.jpg')}}" alt="Default image">
                                @endif
                            </div>
                            <div class="col-6 featured-book-content d-flex align-items-end">
                                <div>
                                    <h5 style="font-size:18px;"><b>{{$item->fullname}}</b></h5>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>
</div>
</div>
<!--Membership-->

<script>
function showLoader() {
    $('.middle-loader-position').addClass('show');
}

function clearInputField() {
    document.getElementById('searchInput').value = '';
}
</script>
@include('frontend.include.footer')