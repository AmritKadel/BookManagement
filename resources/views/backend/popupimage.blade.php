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
            <h1> Add Popup Image</h1>
        </div>
        <form action="{{ url('/postpopupimage') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-heading">

                <table>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>URL</th>

                    </tr>
                    <tr>
                        <td><input type="text" name="name" placeholder="Enter Name"></td>
                        <td><input type="file" name="image" placeholder=""></td>
                        <td><input type="text" name="url" placeholder="Enter URL"></td>
                    </tr>
                </table>
                <div class="viewmore">
                    <input type="submit" value="Submit">
                </div>
            </div>
        </form>
       

    </div>
    <div class="table-heading">

        <div class="whole-table-slide" style="width: 100%; overflow-x: auto;">
            <table class="responsive-slider" style="width:1200px">

                <tr>
                    <th>URL</th>
                    <th>Image</th>
                    <th>Enable</th>
                    <th>Action</th>

                </tr>
                @foreach($popupImage as $item)
                <tr>
                    <td>{{$item->url}}</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="{{$item->image}}"> <img src="{{$item->image}}" alt=""></a>
                        </div>
                    </td>
                    <td>
                        <input type="checkbox" class="enableCheckbox" data-image-id="{{$item->id}}" @if($item->enable)
                        checked @endif>
                    </td>
                    <td>
                        <button class="del-button"
                            onclick="confirmDelete('{{ url('/deletepopupimage/'.$item->id) }}')">Del <i
                                class="ri-chat-delete-line"></i> </button>
                    </td>
                </tr>
                @endforeach




            </table>
        </div>
        <div class="viewmore">
            <input type="submit" value="View More">
        </div>
    </div>

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

$(document).ready(function() {
    // Attach a change event listener to all elements with the class 'enableCheckbox'
    $('.enableCheckbox').on('change', function() {
        var imageId = $(this).data('image-id');
        var enableValue = this.checked ? 1 : 0;

        // Send an AJAX request to update the 'enable' value for the respective ID
        $.ajax({
            url: "{{ url('/enablepopup') }}", // Replace with the actual route for updating the 'enable' value
            method: 'POST',
            data: {
                '_token': "{{ csrf_token() }}", // Include the CSRF token for security
                'imageId': imageId,
                'enable': enableValue
            },
            success: function(response) {
                console.log('Server update successful');
                // Handle any additional actions or UI updates if needed
            },
            error: function(error) {
                console.error('Server update failed');
                // Handle errors or show error messages if necessary
            }
        });
    });
});
</script>


</body>

</html>