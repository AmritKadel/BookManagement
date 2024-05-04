@include('backend.include.header')
@include('backend.include.sidebar')
@php
$contactusdata = DB::table('contact_us_forms')->select('*')->get();
@endphp
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
            <h1>Contact Us Message</h1>
        </div>

    </div>
    <div class="table-heading">
       

        <div class="whole-table-slide" style="width: 100%; overflow-x: auto;">
            <table class="responsive-slider" style="width:1200px">

                <tr>

                    <th>Name</th>
                    <th>Message</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>User School</th>
                    
                </tr>
                @foreach($contactusdata as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->message}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone_number}}</td>
                    <td>{{$item->school_name}}</td>
                   
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
