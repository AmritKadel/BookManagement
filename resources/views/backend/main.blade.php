@include('backend.include.header')
@include('backend.include.sidebar')
<section class="main">
    <div class="middle-dashboard">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1>Catagory</h1>
        </div>
        <div class="table-heading">
            <table>
                <tr>
                    <th>S.N</th>
                    <th> Name</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <td><input type="text" placeholder="S.N"></td>
                    <td><input type="text" placeholder="Enter Name"></td>
                    <td><input type="text" placeholder="Description"></td>
                </tr>
            </table>
            <div class="viewmore">
                <input type="submit" value="Submit">
            </div>
        </div>
    </div>
    <div class="middle-dashboard">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Sub Catagory</h1>
        </div>
        <div class="table-heading">
            <table>
                <tr>
                    <th>S.N</th>
                    <th>Sub Cat ID</th>
                    <th>Sub Cat Name</th>
                    <th>Description</th>

                </tr>
                <tr>
                    <td><input type="text" placeholder="S.N"></td>
                    <td><input type="text" placeholder="Enter Sub Cat ID"></td>
                    <td><input type="text" placeholder="Enter Sub Cat Name"></td>
                    <td><input type="text" placeholder="Description"></td>

                </tr>
            </table>
            <div class="viewmore">
                <input type="submit" value="Submit">
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

</body>

</html>