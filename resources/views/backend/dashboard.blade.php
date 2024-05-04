@include('backend.include.header')
@include('backend.include.sidebar')
<?php
$totalUsers = DB::table('public_users')->count();
$pendingUser = DB::table('public_users')->where('status',0)->count();
$totalSchools = DB::table('public_users')->distinct('user_school')->count();
$totalBooks = DB::table('books')->count();
$contactusmessge = DB::table('contact_us_forms')->count();
$contactusdata = DB::table('contact_us_forms')->select('*')->where('status',0)->get();
?>
<section class="main">
    <div class="top-heading">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-cloud-line"></i>
            </div>
            <h1> Over View</h1>
        </div>

        <div class="headings">
            <div class="dash-board-container" onclick="redirectToAcceptUser()">
                <h3>Total Users</h3>
                <div class="dashboard-value">
                    <p>{{$totalUsers}}</p>
                    <div class="icon-dash">
                        <i class="ri-dashboard-line"></i>
                    </div>

                </div>

            </div>
            <div class="dash-board-container" onclick="redirectToAcceptUser()">
                <h3>Pending User</h3>
                <div class="dashboard-value">
                    <p>{{$pendingUser}}</p>
                    <div class="icon-dash">
                        <i class="ri-dashboard-line"></i>
                    </div>
                </div>
            </div>


            <div class="dash-board-container" onclick="redirectToSchool()">
                <h3>Total School </h3>
                <div class="dashboard-value">
                    <p>{{$totalSchools}}</p>
                    <div class="icon-dash">
                        <i class="ri-dashboard-line"></i>
                    </div>

                </div>

            </div>
            <div class="dash-board-container" onclick="redirectToBooks()">
                <h3>Total Books</h3>
                <div class="dashboard-value">
                    <p>{{$totalBooks}}</p>
                    <div class="icon-dash">
                        <i class="ri-dashboard-line"></i>
                    </div>

                </div>

            </div>
            <div class="dash-board-container" onclick="redirectToBooks()">
                <h3>Total Message</h3>
                <div class="dashboard-value">
                    <p>{{$contactusmessge}}</p>
                    <div class="icon-dash">
                        <i class="ri-dashboard-line"></i>
                    </div>

                </div>

            </div>

        </div>
        <div class="middle-dashboard">
            <div class="topic-heading" style="display: inline-flex;">
                <div class="topic-icons">
                    <i class="ri-shield-user-line"></i>
                </div>
                <h1>Recent Message</h1>
            </div>
            <div class="table-heading">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>School Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach($contactusdata as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->message}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone_number}}</td>
                        <td>{{$item->school_name}}</td>
                        <td><a href="{{url('updatecontactusdata/'.$item->id)}}"><button class="edit-button">Read <i
                                    class="ri-pencil-line"></i> </button></a>
                    </tr>
                    @endforeach

                </table>
            </div>
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
</script>
<script>
function redirectToAcceptUser() {

    window.location.href = "/acceptuser";
}

function redirectToSchool() {

    window.location.href = "/addschooldata";
}

function redirectToBooks() {

    window.location.href = "/addbooks";
}
</script>