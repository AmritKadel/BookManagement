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
            <h1>Accessed Records</h1>
        </div>

    </div>
    <div class="table-heading">
        <div class="search-form">
            <form method="GET" action="{{url('/bookusagerecords')}}">
                @csrf
                <label>User Name</label>
                <input type="text" name="fullname" placeholder="Enter User's  Name">

                <button type="submit">Search</button>
            </form>
        </div>

        <div class="whole-table-slide" style="width: 100%; overflow-x: auto;">
            <table class="responsive-slider" style="width:1200px">

                <tr>

                    <th>Name</th>
                    <th>Book</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>User School</th>
                    <th>User City</th>
                </tr>
                @foreach($usageRecords as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->book_title}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->mobile_number}}</td>
                    <td>{{$item->user_school}}</td>
                    <td>{{$item->user_city}}</td>
                </tr>
                @endforeach

            </table>
        </div>
        <div class="pagination pagination-buttons">
                {!! $usageRecords->links() !!}
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
