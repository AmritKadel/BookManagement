@include('backend.include.header')
@include('backend.include.sidebar')

@if(session('message'))
<div class="sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif

<section class="main">
    <div class="middle-dashboard">
        @if(@$editSchooldata)
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Edit School Data</h1>
        </div>
        <form action="{{ url('/updateSchoolData', $editSchooldata->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Name</th>
                        <th> District</th>
                        <th> Address</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" value="{{$editSchooldata->name}}" placeholder="Enter Name"
                                required></td>
                        <td><input type="text" name="district" value="{{$editSchooldata->district}}"
                                placeholder="Enter District"></td>
                        <td><input type="text" name="address" value="{{$editSchooldata->address}}"
                                placeholder="Enter Address"></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>Contact Number</th>
                        <th> Principal Name</th>

                    </tr>
                    <tr>
                        <td><input type="number" name="contact_number" value="{{$editSchooldata->contact_number}}"
                                placeholder="Enter Contact Number" required></td>
                        <td><input type="text" name="principal_name" value="{{$editSchooldata->principal_name}}"
                                placeholder="Enter Principal Name"></td>
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
            <h1> Add School Data</h1>
        </div>
        <form action="{{ url('/addSchooData') }}" method="POST">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Name</th>
                        <th> District</th>
                        <th> Address</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" placeholder="Enter Name" required></td>
                        <td><input type="text" name="district" placeholder="Enter District"></td>
                        <td><input type="text" name="address" placeholder="Enter Address"></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>Contact Number</th>
                        <th> Principal Name</th>

                    </tr>
                    <tr>
                        <td><input type="number" name="contact_number" placeholder="Enter Contact Number" required></td>
                        <td><input type="text" name="principal_name" placeholder="Enter Principal Name"></td>
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
            <form method="GET" action="{{url('/addschooldata')}}">
                @csrf
                
                <input type="text" name="name" placeholder="Enter School  Name">

                <button type="submit">Search</button>
            </form>
        </div>

        <div class="whole-table-slide" style="width: 100%; overflow-x: auto;">
            <table class="responsive-slider" style="width:1200px">

                <tr>
                    <th>Name</th>
                    <th>District</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Principal Name</th>
                    <th>Action</th>

                </tr>
                <tr>
                    @foreach($data as $item)
                    <td>{{$item->name}}</td>
                    <td>{{$item->district}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->contact_number}}</td>
                    <td>{{$item->principal_name}}</td>
                    <td><a href="{{url('editSchoolData/'.$item->id)}}"><button class="edit-button">Edit <i
                                    class="ri-pencil-line"></i> </button></a>
                        </button><button class="del-button"
                            onclick="confirmDelete('{{ url('/deleteSchool/'.$item->id) }}')">Del <i
                                class="ri-chat-delete-line"></i> </button></td>
                    @endforeach
                </tr>






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