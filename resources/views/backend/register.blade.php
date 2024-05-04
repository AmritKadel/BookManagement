<html>

<head>
    <meta charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
</head>
<style>
/* WGUPLOAD login page */
html,
body {
    margin: auto;
    background-color: #2e77d1;
    font-family: 'Montserrat', sans-serif;
}

hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
}

/* logo */
.logo {
    width: 113px;
    height: 97px;
    background-image: url("images/logo.png");
    position: absolute;
    top: 15%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
}

/* login-form */
.login-form {
    border-radius: 8px;
    width: 500px;
    height: 500px;
    margin: 0;
    background: #FFFFFF;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
}

/* username and password input */
.form {
    width: 400px;
    height: 35px;
    background-color: #d3d3d3;
    border: 1px #FFFFFF;
    border-radius: 4px;
    text-align: center;
}

/* button input */
.input-button {
    margin-top:20px;
    width: 300px;
    height: 45px;
    font-size: 25px;
    color: white;
    border: 1px #FFFFFF;
    border-radius: 7px;
    background-color: #2e77d1;
}

/* forgot input */
.forgot {
    margin-top: 25px;
    color: #3e4246;
    text-decoration: none;
}

/*
WGUPLOAD signup page
*/

/* sign-up logo  */
.signup-logo {
    width: 113px;
    height: 97px;
    background-image: url("images/logo.png");
    position: absolute;
    top: 12%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
}

/* sign-up form  */
.singup-form {
    border-radius: 8px;
    width: 500px;
    height: 600px;
    margin: 0;
    background: #FFFFFF;
    position: absolute;
    top: 55%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
}

/* sign-up input's  */
.forms {
    width: 400px;
    height: 40px;
    background-color: #d3d3d3;
    border: 1px #FFFFFF;
    border-radius: 4px;
    text-align: center;
}
</style>

<body>
    <div class="logo"></div>
    <div class="login-form">
        <form action="{{ url('/create-account') }}" method="POST">
            @csrf
            <p style="color:#3e4246;font-size: 37px;" align="center">Admin Register</p>
            <hr>
            <div class="username" align="center">
                <h3 style="color:#707274;">Username</h3>
                <input type="text" class="form" name="name" placeholder="type your username">
            </div>
            <div class="username" align="center">
                <h3 style="color:#707274;">Email</h3>
                <input type="text" class="form" name="email" placeholder="type your email">
            </div>
            <div class="password" align="center">
                <h3 style="color:#707274;">Password</h3>
                <input type="password" class="form" name="password" placeholder="type your password">
            </div>
            <div class="signin-button" align="center">
                <button type="submit" class="input-button">Sign Up</button>
            </div>
            <hr style="margin-top:35px;">
            <a href="#" style="text-decoration:none;">
                <p align="center" class="forgot">Developer By IT Arrow </p>
            </a>
        </form>
    </div>

</body>

</html>