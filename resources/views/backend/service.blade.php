@include('backend.include.header')
@include('backend.include.sidebar')

@if(session('message'))
<div class="sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif

<section class="main">
    <div class="middle-dashboard">

        @if(@$editService)
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Edit Services</h1>
        </div>
        <form action="{{ url('/updateservicesData', $editService->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Title</th>
                        <th> Image</th>
                        <th>Description</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="service_title" value="{{$editService->service_title}}"
                                placeholder="Title"></td>

                        <td>

                            <input type="file" placeholder="Enter CitizenShip Photo" id='citzenImg' name="service_image"
                                value="@if (isset($editService)) {{ $editService->service_image }} @endif" accept="image/*">
                            <img src="{{ $editService->service_image }}" alt="" style="width: 100px; height: 100px;">

                        </td>
                        <td><textarea style="height:150px;width:450px;" type="text" name="service_description"
                                placeholder="Description">{{$editService->service_description}}</textarea></td>
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
            <h1> Add Services</h1>
        </div>
        <form action="{{ url('/postServices') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Title</th>
                        <th> Image</th>
                        <th>Description</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="service_title" placeholder="Title" required></td>
                        <td><input type="file" name="service_image" placeholder="Image" required></td>
                        <td><textarea style="height:150px;width:450px;" type="text" name="service_description"
                                placeholder="Description" required></textarea></td>
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
        
        <div class="whole-table-slide" style="width: 100%; overflow-x: auto;">
            <table class="responsive-slider" style="width:1200px">

                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>

                </tr>
                @foreach($service as $item)
                <tr>
                    <td>{{$item->service_title}}</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="{{$item->service_image}}"> <img src="{{$item->service_image}}"
                                    alt=""></a>
                        </div>
                    </td>
                    <td>{{$item->service_description}}</td>
                    <td><a href="{{url('editservicesData/'.$item->id)}}"><button class="edit-button">Edit <i
                                    class="ri-pencil-line"></i> </button></a>
                        </button><button class="del-button"
                            onclick="confirmDelete('{{ url('/deleteServicesData/'.$item->id) }}')">Del <i
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