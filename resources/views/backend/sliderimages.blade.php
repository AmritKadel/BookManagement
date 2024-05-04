@include('backend.include.header')
@include('backend.include.sidebar')

@if(session('message'))
<div class="sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif

<section class="main">
    <div class="middle-dashboard">

        @if(@$editsliderImages)
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Edit Slider Images</h1>
        </div>
        <form action="{{ url('/updateSliderImages', $editsliderImages->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Name</th>
                        <th> Image</th>
                        <th>Caption</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" value="{{$editsliderImages->name}}"
                                placeholder="Title"></td>

                        <td>

                            <input type="file" placeholder="Enter CitizenShip Photo" id='citzenImg' name="image"
                                value="@if (isset($editsliderImages)) {{ $editsliderImages->image }} @endif"
                                accept="image/*">
                            <img src="{{ $editsliderImages->image }}" alt="" style="width: 100px; height: 100px;">

                        </td>
                        <td><input type="text" name="caption" value="{{$editsliderImages->caption}}"
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
            <h1> Add Slider Images</h1>
        </div>
        <form action="{{ url('/postSliderImages') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Caption</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" placeholder="Title"></td>
                        <td><input type="file" name="image" placeholder="Image"></td>
                        <td><input type="text" name="caption" placeholder="Caption"></input></td>
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
                    <th>Action</th>

                </tr>
                @foreach($sliderImages as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="{{$item->image}}"> <img src="{{$item->image}}"
                                    alt=""></a>
                        </div>
                    </td>
                    <td>{{$item->caption}}</td>
                    <td><a href="{{url('editSliderImages/'.$item->id)}}"><button class="edit-button">Edit <i
                                    class="ri-pencil-line"></i> </button></a>
                        </button><button class="del-button"
                            onclick="confirmDelete('{{ url('/deleteSliderImages/'.$item->id) }}')">Del <i
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