@include('backend.include.header')
@include('backend.include.sidebar')
@php
use Illuminate\Support\Str;

@endphp
@if(session('message'))
<div class="sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif

<section class="main">
    <div class="middle-dashboard">

        @if(@$editfooters)
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Edit Footers</h1>
        </div>
        <form action="{{ url('/updateFooters', $editfooters->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Location</th>
                        <th>Phone Number</th>
                        <th>Mail Address</th>

                    </tr>
                    <tr>
                        <td><input type="text" name="location" value="{{$editfooters->location}}" placeholder="Enter Location"></td>
                        <td><input type="number" name="phone_number" value="{{$editfooters->phone_number}}" placeholder="Enter Phone Number"></td>
                        <td><input type="text" name="mail" value="{{$editfooters->mail}}"  placeholder="Enter Mail Address"></td>

                    </tr>
                    <tr>
                        <th>Website Link</th>
                        <th>Description</th>
                    </tr>
                    <tr>

                        <td><input type="text" name="website_link"  value="{{$editfooters->website_link}}" placeholder="Enter Website Link"></td>
                        <td><textarea style="height:150px;width:450px;" name="description"> {{$editfooters->description}}" </textarea></td>
                        <td><input type="text" name="google_map"  value="{{$editfooters->google_map}}" placeholder="Enter Google Map"></td>
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
            <h1> Add Footer Details</h1>
        </div>
        <form action="{{ url('/postFooters') }}" method="POST">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Location</th>
                        <th>Phone Number</th>
                        <th>Mail Address</th>

                    </tr>
                    <tr>
                        <td><input type="text" name="location" placeholder="Enter Location"></td>
                        <td><input type="number" name="phone_number" placeholder="Enter Phone Number"></td>
                        <td><input type="text" name="mail" placeholder="Enter Mail Address"></td>

                    </tr>
                    <tr>
                        <th>Website Link</th>
                        <th>Description</th>
                        <th>Google Map Link</th>
                    </tr>
                    <tr>

                        <td><input type="text" name="website_link" placeholder="Enter Website Link"></td>
                        <td><textarea style="height:150px;width:450px;" name="description"></textarea></td>
                        <td><input type="text" name="google_map" placeholder="Enter Google Map"></td>
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
                    <th>Location</th>
                    <th>Description</th>
                    <th>Mail</th>
                    <th>Website Link</th>
                    <th>Phone Number</th>
                    <th>Google Map Link</th>
                    <th>Action</th>

                </tr>
                @foreach($footer as $item)
                <tr>
                    <td>{{$item->location}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                        {{$item->mail}}
                    </td>
                    <td>
                        {{$item->website_link}}
                    </td>
                    
                    <td>{{$item->phone_number}}</td>
                    <td>
                    {{ Str::limit($item->google_map, 10) }}
                    </td>
                    <td><a href="{{url('editFooters/'.$item->id)}}"><button class="edit-button">Edit <i
                                    class="ri-pencil-line"></i> </button></a>
                        </button><button class="del-button"
                            onclick="confirmDelete('{{ url('/deleteFooters/'.$item->id) }}')">Del <i
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