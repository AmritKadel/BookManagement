@include('backend.include.header')
@include('backend.include.sidebar')

@if(session('message'))
<div class="sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif

<section class="main">
    <div class="middle-dashboard">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Pending Users</h1>
        </div>

    </div>
    <div class="table-heading">

        <div class="whole-table-slide" style="width: 100%; overflow-x: auto;">
            <table class="responsive-slider" style="width:1200px">

                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>User School</th>
                    <th>User City</th>
                    <th>User District</th>
                    <th>User Catagory</th>
                    <th>Action</th>

                </tr>
                @foreach($acceptUser as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->mobile_number}}</td>
                    <td>{{$item->user_school}}</td>
                    <td>{{$item->user_city}}</td>
                    <td>{{$item->user_district}}</td>
                    <td>{{$item->user_catagory}}</td>
                    <td>
                        <form method="POST" action="{{ url('/updateUser/'.$item->id) }}"
                            onsubmit="return confirmAccept()">
                            @csrf
                            <button class="edit-button" type="submit">Accept</button>
                        </form>
                        <form method="POST" action="{{ url('/deleteUser/'.$item->id) }}"
                            onsubmit="return confirmDelete()">
                            @csrf
                            <button class="del-button" type="submit">Delete</button>
                        </form>
                    </td>

                </tr>
                @endforeach

            </table>
        </div>

    </div>
    <div class="middle-dashboard">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Accepted Users</h1>
        </div>

    </div>
    <div class="table-heading">

        <div class="whole-table-slide" style="width: 100%; overflow-x: auto;">
            <table class="responsive-slider" style="width:1200px">

                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>User School</th>
                    <th>User City</th>
                    <th>User District</th>
                    <th>User Catagory</th>

                </tr>
                @foreach($acceptUserData as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->mobile_number}}</td>
                    <td>{{$item->user_school}}</td>
                    <td>{{$item->user_city}}</td>
                    <td>{{$item->user_district}}</td>
                    <td>{{$item->user_catagory}}</td>
                    

                </tr>
                @endforeach

            </table>
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

function confirmAccept() {
    if (confirm("Are you sure you want to accept this user?")) {
        return true; 
    } else {
        return false; 
    }
}
</script>

</body>

</html>