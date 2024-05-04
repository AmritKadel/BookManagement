@include('backend.include.header')
@include('backend.include.sidebar')

@if(session('message'))
<div class="sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif

<section class="main">
    <div class="middle-dashboard">
        @if(@$editbookCategory)
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Edit Type</h1>
        </div>
        <form action="{{ url('/updateCategory', $editbookCategory->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Title</th>
                        <th> Display Order</th>
                       
                    </tr>
                    <tr>
                        <td><input type="text" name="title" value="{{$editbookCategory->title}}"
                                placeholder="Title"></td>
                        <td><input type="text" name="display_order" value="{{$editbookCategory->display_order}}"
                                placeholder="Image"></td>
                        
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
            <h1> Add Book Type</h1>
        </div>
        <form action="{{ url('/postCatagory') }}" method="POST">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Title</th>
                        <th> Display Order(Optional)</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="title" placeholder="Enter Title" required></td>
                        <td><input type="number" name="display_order" placeholder="Enter Display Order"></td>
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
                    <th>Title</th>
                    <th>Display Order</th>
                    <th>Action</th>

                </tr>
                @foreach($bookCategory as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->display_order}}</td>
                    <td><a href="{{url('editCategory/'.$item->id)}}"><button class="edit-button">Edit <i
                                    class="ri-pencil-line"></i> </button></a>
                        </button><button class="del-button"
                            onclick="confirmDelete('{{ url('/deleteCatagory/'.$item->id) }}')">Del <i
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