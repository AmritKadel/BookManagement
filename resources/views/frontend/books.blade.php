@include('frontend.include.header')
<div class="inner-hero">
    <div class="container">
        <h1>Books</h1>
        <p>Food for your mind</p>
    </div>
</div>
<div class="middle-loader-position">
    <div class="whole-loading">
        <div class="loader-middle"></div>
    </div>
</div>
<style>
.middle-loader-position {
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    padding: 20px;
    width: 130px;
    display: none;
    justify-content: center;
    position: fixed;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    top: 35%;
    z-index: 999999;
    background-color: rgb(32, 32, 32);
    border-radius: 5px;
}

.middle-loader-position.show {
    display: flex;
}

.loader-middle {
    border: 6px solid #f3f3f3;
    border-radius: 50%;
    border-top: 6px solid rgb(218, 10, 34);
    width: 60px;
    height: 60px;
    -webkit-animation: midspin 2s linear infinite;
    animation: midspin 2s linear infinite;
}

@keyframes midspin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>

<!--Books-->
<div class="books-page only-featured featured-books pb-5">
    <div class="container px-4 pt-5" id="featured-3">
        <div class="search-sort-section d-flex justify-content-between mb-4">
            <form class="form-inline my-2 my-lg-0 search">
                <input class="form-control mr-sm-2" type="search" id="search-input" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>

            <select class="form-select" aria-label="Default select example">
                <option selected>Show</option>
                <option value="1">20</option>
                <option value="2">50</option>
                <option value="3">100</option>
            </select>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-2 filter">
                <h1>Type</h1>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefaultAll"
                        value="All">
                    <label class="form-check-label" for="flexRadioDefaultAll">
                        All
                    </label>
                </div>
                @foreach($categories as $item)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                        id="flexRadioDefault{{$item->id}}" value="{{$item->title}}">
                    <label class="form-check-label" for="flexRadioDefault{{$item->id}}">
                        {{$item->title}}
                    </label>
                </div>
                @endforeach


                <h1>Subject</h1>
                <select class="form-select" aria-label="Default select example" name="subject">
                    <option value="">Select Subject</option>
                    @foreach($subCategories as $item)
                    <option value="{{$item->id}}">{{$item->sub_title}}</option>
                    @endforeach
                </select>
                <h1>Class</h1>
                <select class="form-select" aria-label="Default select example" name="class">
                    <option value="">Select Class</option>
                    @foreach($childCategories as $item)
                    <option value="{{$item->id}}">{{$item->child_title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-10">
                <div class="row g-4 pt-3 pb-5" id="books-container">

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--Membership-->

<script>
$(document).ready(function() {
    $('.search').submit(function(event) {
        event.preventDefault(); 
        filterBooks(); 
    });

    $('input[name="flexRadioDefault"], select.form-select').change(function() {
        if ($('#search-input').val() === '') { 
            filterBooks(); 
        }
    });

    filterBooks();
});

function filterBooks() {
    var type = $('input[name="flexRadioDefault"]:checked').val();
    var subject = $('select.form-select[name="subject"]').val();
    var classValue = $('select.form-select[name="class"]').val();
    var searchQuery = $('#search-input').val();

    if (type || subject || classValue || searchQuery) {
        showLoader();
        setTimeout(function() {
            getFilteredBooks(type, subject, classValue, searchQuery);
        }, 2000);
    } else {
        getFilteredBooks(type, subject, classValue, searchQuery);
    }
}

function getFilteredBooks(type, subject, classValue, searchQuery) {
    $.ajax({
        url: '/searchresults',
        type: 'GET',
        data: {
            type: type,
            subject: subject,
            class: classValue,
            search: searchQuery
        },
        success: function(response) {
            $('#books-container').empty();
            $.each(response, function(index, book) {
                createBookElement(book);
            });
            hideLoader();
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            hideLoader();
        }
    });
}

function showLoader() {
    $('.middle-loader-position').addClass('show');
}

function hideLoader() {
    $('.middle-loader-position').removeClass('show');
}

function createBookElement(book) {
    
    var maxDescriptionLength = 100;

   
    var truncatedDescription = book.description.length > maxDescriptionLength ? book.description.substring(0, maxDescriptionLength) + '...' : book.description;

    var bookElement = $('<div class="feature col-md-6">' +
        '<div class="featured-box">' +
        '<div class="row">' +
        '<div class="col-6">' +
        '<img class="" src="' + book.thumbnail + '" alt="image">' +
        '</div>' +
        '<div class="col-6 featured-book-content d-flex align-items-end">' +
        '<div>' +
        '<h5><b>' + book.book_title + '</b></h5>' +
        '<p><i>' + truncatedDescription + '</i></p>' +
        '<h6><b>Author: </b>' + book.fullname + '</h6>' +
        '<h6><b>Published Date: </b>' + book.published_year + '</h6>' +
        '<a href="/bookdescription/' + book.id + '" class="btn btn-outline-dark">Read</a>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>');

    $('#books-container').append(bookElement);
}

</script>
@include('frontend.include.footer')