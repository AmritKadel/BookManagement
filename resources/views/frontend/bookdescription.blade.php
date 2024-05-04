@include('frontend.include.header')
@if(session('message'))
<div class="frontend-sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif

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
<style>
.whole-container {
    top: 100px;
    width: 100%;
}

p{
    text-align: justify;
}

.whole-padding {
    padding: 25px;
}

.product-title-description {
    text-align: center;
}

.product-title-description h2 {
    text-transform: uppercase;
}

.product-title-description h2 i {
    color: rgb(218, 10, 34);
}

.whole-desc-container {
    width: 100%;
    display: inline-flex;
    margin-top: 20px;
}

.container3 {
    width: 100%;
}

.desc-img {

    height: 50vh;
    margin-bottom: 10px;
}

.desc-img img {
    object-fit: cover;
}

.item-desc {
    margin-left: 0px;
    width: 50%;
}

.item-desc h2 {
    font-size: 22px;
    font-weight: bold;
    color: #535353;
    border-bottom: 1px solid #d4d3d3;
    padding-bottom: 20px;
}

.item-desc h2:before {
    margin-right: 10px;
    width: 30px;
    height: 2px;
    background: rgb(218, 10, 34);
    content: "";
    display: inline-block;
    vertical-align: middle;
    position: relative;
    top: 50%;
    left: 0;
    -webkit-transform: translate(0, -50%);
}

.review-desc {
    margin-top: 60px;
    border-bottom: 1px solid #d4d3d3;
    padding-bottom: 20px;
    display: inline-flex;
    width: 100%;
}

.review-desc {
    display: inline-flex;
    width: 100%;
}

.product-description {
    width: 45%;
}

.product-description h2 {
    margin-bottom: 10px;
    color: #535353;
    font-size: 27px;
    border-bottom: 1px solid #d4d3d3;
    padding-bottom: 15px;
}

.product-description h2::before {
    margin-right: 10px;
    width: 30px;
    height: 2px;
    background: rgb(218, 10, 34);
    content: "";
    display: inline-block;
    vertical-align: middle;
    position: relative;
    top: 50%;
    left: 0;
    -webkit-transform: translate(0, -50%);
}

.product-container {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
}

.desc-lists button {
    background-color: #991416;
    color: white;

    font-weight: bold;
    border-radius: 4px;
    padding: 8px;
}

.productbox {
    width: 23.3%;
    position: relative;
    cursor: pointer;
    margin-top: 20px;
    border: 1px solid rgb(233, 232, 232);
}

.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    max-width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
}

.modal-content h2 {
    margin-top: 0;
}

.otp-next {
    margin: 5px;
    padding: 10px;
    width: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    flex-basis: 25%;
    box-sizing: border-box;
}

.otp-submit {
    margin-top: 15px;
    background-color: #991416;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.otp-submit:hover {
    background-color: #991416;
}

.otp-submit:active {
    background-color: #991416;
}

::placeholder {
    padding: 20px;
}

.recent-books{
    display: flex;
    flex-direction: row;
    width: 100%;
}

.recent-books {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.feature-recent {
    flex: 1 1 calc(25% - 20px); 
    max-width: calc(25% - 20px); 
}

@media (max-width: 991px) {
    .feature-recent {
        flex: 1 1 calc(50% - 20px); 
        max-width: calc(50% - 20px); 
    }
}

</style>
@if(session()->has('sessionUserId'))
<div id="myModal" class="modal">
    <div class="modal-content">
        <h2>Enter OTP</h2>
        <p>Check your mail for the OTP</p>
        <div style="display:inline-flex;">
            <input type="text" id="otpInput1" class="otp-next" placeholder="*" autocomplete="off" required>
            <input type="text" id="otpInput2" class="otp-next" placeholder="*" autocomplete="off" required>
            <input type="text" id="otpInput3" class="otp-next" placeholder="*" autocomplete="off" required>
            <input type="text" id="otpInput4" class="otp-next" placeholder="*" autocomplete="off" required>
        </div>
        <button onclick="saveOTP()" class="otp-submit">Submit</button>
    </div>
</div>
@endif




<div class="inner-hero">
    <div class="container">
        <h1>Book Description</h1>
        <p>Get in Touch</p>
    </div>
</div>
<div style="margin-bottom:25px;" class="container">
    <div class="whole-desc-container">
        <div class="container3">
            <div class="desc-img" style="width: 60%;">

                <img src="{{asset(@$books[0]->thumbnail)}}" style="width: 100%; height: 100%; object-fit: cover;">


            </div>
        </div>
        <div class="item-desc">
            <input type="hidden" id="book_id" value="{{@$books[0]->id }}">
            <input type="hidden" id="anyfliplink" value="{{@$books[0]->anyflip_books_link }}">
            <h2>{{@$books[0]->book_title }}</h2>
            <div class="desc-lists">
                <p class="modelname">Type : {{@$books[0]->title }} </p>
                <p class="stock">Subject : <span>{{@$books[0]->sub_title }}</span></p>
                <p class="location">Class : {{@$books[0]->child_title }}</p>
            </div>
            <div class="desc-lists">
                <p class="soldby">Author : <span>{{@$books[0]->fullname }}</span></p>

            </div>
            <div class="desc-lists">
                <p class="options">Description : {{@$books[0]->description }}</p>
                <p class="desc-para"></p>
            </div>
            @if(@$books[0]->need_user_verification === 0)
            <div class="desc-lists">
                <a target="_blank" href="{{@$books[0]->anyflip_books_link}}"><button> Read Book</button></a>
            </div>
            @else
            <div class="desc-lists">
                <button onclick="submitOTP()">Read Book</button>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="recent">
    <div class="featured-books pb-5 text-center">
        <div class="container px-4 pt-5" id="featured-3">
            <h1 class="display-5 fw-bold lh-1">Related Books</h1>
            <div class="border-img">
                <img src="{{asset('allied/img/border.png')}}" alt="">
            </div>
            <div class="recent-books">
                @foreach($relatedBooks as $item)
                <div class="feature-recent col">
                    <div class="card">
                        <img class="card-img" src="{{asset($item->thumbnail)}}" alt="Card image">
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{$item->book_title}}</h5>
                            <p class="card-text"><a href="/bookdescription/{{$item->id}}"> Read</a></p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <div>
            <a href="/books"><button type="button" class="btn btn-outline-dark">View All</button></a>
        </div>
    </div>
</div>


<script>
const modal = document.getElementById('myModal');
const otpInput = document.getElementsByClassName('otp-next');

function openModal() {

    modal.style.display = 'block';
}

function closeModal() {
    modal.style.display = 'none';
}
window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
};

function submitOTP() {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var bookIdInput = document.getElementById('book_id');

    if (bookIdInput) {
        var bookId = bookIdInput.value;

        // Display the loader
        var loaderDiv = document.createElement('div');
        loaderDiv.className = 'middle-loader-position show';
        var loaderContainer = document.createElement('div');
        loaderContainer.className = 'whole-loading';
        var loader = document.createElement('div');
        loader.className = 'loader-middle';
        loaderContainer.appendChild(loader);
        loaderDiv.appendChild(loaderContainer);
        document.body.appendChild(loaderDiv);

        var request = new XMLHttpRequest();
        request.open("POST", "/send-otp", true);
        request.setRequestHeader("Content-Type", "application/json");
        request.setRequestHeader("X-CSRF-TOKEN", csrfToken);

        request.onreadystatechange = function() {
            if (request.readyState === 4) {
              
                document.body.removeChild(loaderDiv);

                if (request.status === 200) {
                    var response = JSON.parse(request.responseText);
                    if (response.success) {
                        openModal();
                        var errorDiv = document.createElement('div');
                        errorDiv.className = 'frontend-sweetmessage';
                        var errorParagraph = document.createElement('p');
                        errorParagraph.textContent = 'You have received the OTP in your mail';
                        errorDiv.appendChild(errorParagraph);
                        document.body.appendChild(errorDiv);
                    } else {
                        if (response.message) {
                            var errorDiv = document.createElement('div');
                            errorDiv.className = 'frontend-sweetmessage';
                            var errorParagraph = document.createElement('p');
                            errorParagraph.textContent = response.message;
                            errorDiv.appendChild(errorParagraph);
                            document.body.appendChild(errorDiv);
                        }

                        if (response.redirect) {

                            window.location.href = response.redirect;
                        }
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while sending the OTP.',
                    });
                }
            }
        };

        var payload = JSON.stringify({
            bookId: bookId
        });
        request.send(payload);
    }
}

function saveOTP() {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var otpInput1 = document.getElementById("otpInput1").value;
    var otpInput2 = document.getElementById("otpInput2").value;
    var otpInput3 = document.getElementById("otpInput3").value;
    var otpInput4 = document.getElementById("otpInput4").value;
    var anyFlipLink = document.getElementById("anyfliplink").value;

    // Check if any of the OTP input fields are empty
    if (otpInput1 === '' || otpInput2 === '' || otpInput3 === '' || otpInput4 === '') {
        var errorDiv = document.createElement('div');
        errorDiv.className = 'frontend-sweetmessage';
        var errorParagraph = document.createElement('p');
        errorParagraph.textContent = 'Please fill the OTP. You will receive it in your email';
        errorDiv.appendChild(errorParagraph);
        document.body.appendChild(errorDiv);
        return; // Stop the function execution
    }

    var data = {
        otpInput1: otpInput1,
        otpInput2: otpInput2,
        otpInput3: otpInput3,
        otpInput4: otpInput4,
        anyFlipLink: anyFlipLink
    };

    var request = new XMLHttpRequest();
    request.open("POST", "/verify-otp", true);
    request.setRequestHeader("Content-Type", "application/json");
    request.setRequestHeader("X-CSRF-TOKEN", csrfToken);

    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = JSON.parse(request.responseText);
            if (response.success) {
                closeModal();
                window.open(response.link, "_blank");
            } else {
                var errorDiv = document.createElement('div');
                errorDiv.className = 'frontend-sweetmessage';
                var errorParagraph = document.createElement('p');
                errorParagraph.textContent = 'Please enter the valid OTP';
                errorDiv.appendChild(errorParagraph);
                document.body.appendChild(errorDiv);
            }
        }
    };

    request.send(JSON.stringify(data));
}
</script>
<script>
var elts = document.getElementsByClassName('otp-next')
Array.from(elts).forEach(function(elt) {
    elt.addEventListener("keyup", function(event) {
        if (event.keyCode === 13 || elt.value.length == 1) {
            elt.nextElementSibling.focus()
        }
    });
})
</script>
@include('frontend.include.footer')