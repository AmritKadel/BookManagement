@include('backend.include.header')
@include('backend.include.sidebar')

@if(session('message'))
<div class="sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif

<section class="main">
    <div class="middle-dashboard">

        @if(@$editTeam)
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Edit Team</h1>
        </div>
        <form action="{{ url('/updateTeams', $editTeam->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Name</th>
                        <th> Profile Picture</th>
                        <th>Position</th>
                        <th>Contact Number</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" value="{{$editTeam->name}}" placeholder="Title">
                        </td>

                        <td>

                            <input type="file" placeholder="Enter CitizenShip Photo" id='citzenImg' name="profile_picture"
                                value="@if (isset($editTeam)) {{ $editTeam->profile_picture }} @endif" accept="image/*">
                            <img src="{{ $editTeam->profile_picture }}" alt="" style="width: 100px; height: 100px;">

                        </td>
                        <td><input type="text" name="position" value="{{$editTeam->position}}" placeholder="Position"></td>
                        <td><input type="number" name="contact_number" value="{{$editTeam->contact_number}}"placeholder="Contact Number"></td>
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
            <h1> Add Team Details</h1>
        </div>
        <form action="{{ url('/postTeams') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Name</th>
                        <th> Profile Picture</th>
                        <th>Position</th>
                        <th>Contact Number</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" placeholder="Name"></td>
                        <td><input type="file" name="profile_picture" placeholder="Profile Picture"></td>
                        <td><input type="text" name="position" placeholder="Position"></td>
                        <td><input type="number" name="contact_number" placeholder="Contact Number"></td>
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
                    <th>Profile Picture</th>
                    <th>Position</th>
                    <th>Contact Number</th>
                    <th>Action</th>

                </tr>
                @foreach($teams as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="{{$item->profile_picture}}"> <img src="{{$item->profile_picture}}"
                                    alt=""></a>
                        </div>
                    </td>
                    <td>{{$item->position}}</td>
                    <td>{{$item->contact_number}}</td>
                    <td><a href="{{url('editteam/'.$item->id)}}"><button class="edit-button">Edit <i
                                    class="ri-pencil-line"></i> </button></a>
                        </button><button class="del-button"
                            onclick="confirmDelete('{{ url('/deleteteam/'.$item->id) }}')">Del <i
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