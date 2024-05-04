@include('frontend.include.header')
@if(session('message'))
<div class="frontend-sweetmessage">

    <p>{{ session('message') }}</p>
</div>
@endif
<style>
.login-with-google-btn {
    margin-top: 20px;
    transition: background-color .3s, box-shadow .3s;

    padding: 12px 16px 12px 42px;
    border: none;
    border-radius: 3px;
    box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);

    color: #757575;
    font-size: 14px;
    font-weight: 500;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;

    background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
    background-color: white;
    background-repeat: no-repeat;
    background-position: 12px 11px;

    &:hover {
        box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 2px 4px rgba(0, 0, 0, .25);
    }

    &:active {
        background-color: #eeeeee;
    }

    &:focus {
        outline: none;
        box-shadow:
            0 -1px 0 rgba(0, 0, 0, .04),
            0 2px 4px rgba(0, 0, 0, .25),
            0 0 0 3px #c8dafc;
    }

    &:disabled {
        filter: grayscale(100%);
        background-color: #ebebeb;
        box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);
        cursor: not-allowed;
    }
}
</style>
<!--Inner Page Headings-->
<div class="inner-hero">
    <div class="container text-center">
        <h1>Login</h1>
    </div>
</div>
<!--Contact Details-->
<div class="login py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 m-auto contact-form text-center">
                <form action="{{ url('/user-login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="useremail" class="form-control" id="email" placeholder="Email">
                    </div>
                    @if ($errors->has('useremail'))
                    <p class="error-message">
                        {{ $errors->first('useremail') }}
                    </p><br>
                    @endif
                    <div class="form-group">
                        <input type="password" name="userpassword" class="form-control" id="pw" placeholder="Password">
                    </div>
                    @if ($errors->has('userpassword'))
                    <p class="error-message">
                        {{ $errors->first('userpassword') }}
                    </p><br>
                    @endif
                    <button type="submit" class="btn btn-outline-dark">Login</button><br>
                </form>
                <a href="{{ url('/login/google') }}"><button type="button" class="login-with-google-btn">
                    Sign in with Google
                </button></a>


                <p class="text-center mt-4"><a href="/forgetpassword">Forget Password?</a></p>

            </div>
        </div>
    </div>
</div>

@include('frontend.include.footer')