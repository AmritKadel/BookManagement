@include('backend.include.header')
@include('backend.include.sidebar')

@if(session('message'))
<div class="sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif

<section class="main">
    <div class="middle-dashboard">

        @if(@$editTestimonials)
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Edit Testimonails </h1>
        </div>
        <form action="{{ url('/updateReviews', $editTestimonials->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Name</th>
                        <th> Image</th>
                        <th>Designation</th>
                        <th>Description</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" value="{{$editTestimonials->name}}" placeholder="Title"></td>

                        <td>

                            <input type="file" placeholder="Enter CitizenShip Photo" id='citzenImg' name="image"
                                value="@if (isset($editTestimonials)) {{ $editTestimonials->image }} @endif"
                                accept="image/*">
                            <img src="{{ $editTestimonials->image }}" alt="" style="width: 100px; height: 100px;">

                        </td>
                        <td><input type="text" name="designation" value="{{$editTestimonials->designation}}"
                                placeholder="Title"></td>
                        <td><input type="text" name="description" value="{{$editTestimonials->description}}"
                                placeholder="Title"></td>
                    </tr>
                </table>
                <div class="viewmore">
                    <input type="submit" value="Update">
                </div>
            </div>
        </form>
        @else
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Add Reviews</h1>
        </div>
        <form action="{{ url('/postReviews') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Designation</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" placeholder="Name"></td>
                        <td><input type="file" name="image" placeholder="Image"></td>
                        <td><input type="text" name="description" placeholder="Description"></td>
                        <td><input type="text" name="designation" placeholder="Designation"></td>
                    </tr>
                </table>
                <div class="viewmore">
                    <input type="submit" value="Submit">
                </div>
            </div>
        </form>
        @endif

    </div>
    <div class="table-heading">
        <div class="search-form">

        </div>
        <div class="whole-table-slide" style="width: 100%; overflow-x: auto;">
            <table class="responsive-slider" style="width:1200px">

                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Designation</th>
                    <th>Action</th>

                </tr>
                @foreach($testimonials as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="{{$item->image}}"> <img src="{{$item->image}}" alt=""></a>
                        </div>
                    </td>
                    <td>{{$item->designation}}</td>
                    <td><a href="{{url('editReviews/'.$item->id)}}"><button class="edit-button">Edit <i
                                    class="ri-pencil-line"></i> </button></a>
                        </button><button class="del-button"
                            onclick="confirmDelete('{{ url('/deleteReviews/'.$item->id) }}')">Del <i
                                class="ri-chat-delete-line"></i> </button></td>
                </tr>
                @endforeach




            </table>
        </div>
        <div class="viewmore">
            <input type="submit" value="View More">
        </div>
    </div>

</section>

<script type="text/javascript">
$('.sub-btn').click(function() {
    $(this).next('.sub-menu').slideToggle();
    $(this).find('.dropdown').toggleClass('rotate');
});


$('.menu-btn').click(function() {
    $('.side-bar').addClass('active');
    $('.menu-btn').css("visibility", "hidden");

});

$('.close-btn').click(function() {
    $('.side-bar').removeClass('active');
    $('.menu-btn').css("visibility", "visible");
});

function confirmDelete(url) {
    if (confirm("Are you sure you want to delete this item?")) {
        window.location.href = url;
    }
}
</script>

</body>

</html>