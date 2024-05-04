<?php
$footers = DB::table('footers')->select('*')->get();
?>
<div class="membership">
    <div class="container">
        <div class="row">
            <div class="col-6 py-5">
                <h3>Are you looking for membership ?</h3>
            </div>
            <div class="col-6 py-5 contact-btn">
                <a href="/contactus"><button type="button" class="btn btn-outline-secondary">Contact Us</button></a>
            </div>
        </div>
    </div>
</div>
<div class="text-footer pt-5 pb-4">
    <div class="container">
        <p>{{$footers[0]->description}}</p>
    </div>
</div>
<div class="last-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mt-4">Allied Publications Pvt. Ltd</h3>
                <ul class="contacts">
                    <li class=" mb-2"><i class="bi bi-house"></i><a href="#" class=" p-0">{{$footers[0]->location}}</a>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone"></i>
                        <a href="tel:+977-{{$footers[0]->phone_number}}" class="p-0">
                            +977-{{$footers[0]->phone_number}}
                        </a>
                    </li>
                    <li class=" mb-2"><i class="bi bi-envelope"></i><a href="#" class=" p-0">{{$footers[0]->mail}}</a>
                    </li>
                    <li class=" mb-2"><i class="bi bi-globe"></i><a target="_blank" href="{{$footers[0]->website_link}}"
                            class=" p-0">www.alliedpublication.com.np</a></li>
                </ul>
            </div>
            <div class="col-md-6 sister-concern text-end">
                <h3 class="my-4">Our Sister Companies :</h3>
                <div class="">
                    <img src="{{asset('allied/img/sister.png')}}" />
                    <img src="{{asset('allied/img/sister.png')}}" />
                </div>
            </div>
        </div>

    </div>
</div>
<div class="copyrights">
    <div class="container">
        <div class="d-flex justify-content-between pt-3">
            <p>&copy; <i>2023 Allied Publications, Developed by IT Arrow</i></p>
            <div class="footer icons">
                <i class="bi bi-facebook"></i>
                <i class="bi bi-twitter"></i>
                <i class="bi bi-instagram"></i>
                <i class="bi bi-linkedin"></i>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{asset('allied/js/script.js')}}"></script>


</body>

</html>