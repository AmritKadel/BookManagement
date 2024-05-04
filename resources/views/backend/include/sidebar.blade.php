<?php
if (session()->get('sessionAdminPassword') != "") {
    $user = \DB::table('admin_users')
        ->select('id','name')
        ->where('password', session()->get('sessionAdminPassword'))
        ->get();
    $id = $user[0]->id;
    $count = \DB::select("select count('id')  from admin_users where id='" . $id . "'");
}
?>

<body>
    <div id="myModal" class="modal">


        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Do You Want To Log Out?</h2>
            </div>
            <div class="modal-body">
                <div class="cancle-div cancle-log">
                    <button class="cancle-logout"> Cancel</button>
                </div>
                <div class="log-out-div">
                    <a href="/logout-adminuser">
                        <button class="log-out">Log Out</button>
                    </a>
                </div>

            </div>

        </div>

    </div>
    <div class="menu-height">
        <div class="menu-btn">
            <i class="fas fa-bars"></i>
        </div>
    </div>


    <div class="side-bar">

        <header>

            <div class="close-btn">

                <i class="fas fa-times"></i>
            </div>

            @if(session()->get('sessionAdminPassword') != "")
            <div class="logo-images">
                <img src="{{asset('allied/img/logo-white.png')}}">
            </div>
            <div class="welcome-user"
                style="color: white; margin-top: 40px; padding-top: 10px;padding-bottom: 10px; padding-left: 30px; font-weight: bolder; border-bottom: 1px solid white; border-top: 1px solid white; position: relative;">
                <p> Welcome {{@$user[0]->name}}! <i class="ri-logout-box-r-line" id="open-modal"
                        style="font-size: 20px; position: absolute; right: 20px; cursor :pointer;"></i> </p>
            </div>
            @else
            <?php
        // Redirect to the login page
        header('Location: /');
        exit();
        ?>
            @endif
        </header>
        <div class="menu">
            <div class="item"><a href="/admin-dashboard"><i class="fas fa-desktop"></i>Dashboard</a></div>
            <div class="item">
                <a href="/admin-services" class="sub-btn"><i class="fas fa-table"></i>Services</a>
            </div>
            <div class="item">
                <a class="sub-btn"><i class="fas fa-table"></i>Books<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="/catagory" class="sub-item">Type</a>
                    <a href="/subCatagory" class="sub-item">Subject</a>
                    <a href="/childCatagory" class="sub-item">Class</a>
                    <a href="/addbooks" class="sub-item">Add Books</a>
                </div>

            </div>
            <div class="item"><a href="/aboutusdashboard"><i class="fas fa-table"></i>About Us</a></div>
            <div class="item"><a href="/author"><i class="fas fa-table"></i>Author</a></div>
            <div class="item"><a href="/achievement"><i class="fas fa-table"></i>Achievement</a></div>
            <div class="item">
                <a class="sub-btn"><i class="fas fa-table"></i>Users<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="/userrole" class="sub-item">Role</a>
                    <a href="/userdistrict" class="sub-item">District</a>
                </div>
            </div>
            <div class="item"><a href="/acceptuser"><i class="fas fa-table"></i>Accept User</a></div>
            <div class="item"><a href="/sliderimages"><i class="fas fa-table"></i>Slider Images</a></div>
            <div class="item"><a href="/reviews"><i class="fas fa-table"></i>Reviews</a></div>
            <div class="item"><a href="/footers"><i class="fas fa-table"></i>Footers</a></div>
            <div class="item"><a href="/team"><i class="fas fa-table"></i>Teams</a></div>
            <div class="item"><a href="/contactusdata"><i class="fas fa-table"></i>Contact Us Data</a></div>
            <div class="item"><a href="/bookusagerecords"><i class="fas fa-table"></i>Book Access Records</a></div>
            <div class="item"><a href="/popup"><i class="fas fa-table"></i>Popup Message</a></div>
            <div class="item">
                <a class="sub-btn"><i class="fas fa-table"></i>Settings<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="/adminchangepassword" class="sub-item">Change Password</a>

                </div>

            </div>
        </div>
    </div>
    <script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("open-modal");


    var span = document.getElementsByClassName("close")[0];
    var closelog = document.getElementsByClassName("cancle-log")[0];


    btn.onclick = function() {
        modal.style.display = "block";
    }


    span.onclick = function() {
        modal.style.display = "none";
    }

    closelog.onclick = function() {
        modal.style.display = "none";

    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";

        }
    }
    </script>