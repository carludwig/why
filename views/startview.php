<html>
<head>
    <title></title>
    <link href="views/css/reset.css" rel="stylesheet" type="text/css"/>
    <link href="views/css/registerlogin.css" rel="stylesheet" type="text/css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="..//views/js/main.js"></script>
</head>
<body>
<div id="wallpaper">
    <div id="header">
        <div class="logo"><img class="logoPic" src="..//views/img/bluesounder.png"/></div>
    </div>
    <div id="content">
        <?php
        if(isset($error)){
            ?>
            <p><?php echo($error)?></p>
        <?php
        }
        ?>
        <div class="hideLogin"><p class="loginHeadline">If you´re not a member then <a href="#" class="showRegister">register here</a></p></div>
        <div class="hideRegister"><p class="registerHeadline">Sign up or go back to <a href="#" class="showLogin">log in</a></p></div>
        <form method="post" action="auth/login">
            <div id="login">
                <input name="email" class="loginInput" type="email" placeholder="Email"/>
                <input name="password" class="loginInput" type="password" placeholder="Password"/>
                <input name="login_button" class="loginButton" type="submit" value="Log In"/>
            </div>
        </form>

        <form method="post" action="auth/register">
            <div id="register">
                <input name="first_name" class="inputs" type="text" placeholder="First name">
                <input name="last_name" class="inputs" type="text" placeholder="Last name">
                <input name="email" class="inputs" type="email" placeholder="Email">
                <input name="password" class="inputs" type="password" placeholder="Password">
                <input name="rep_password" class="inputs" type="password" placeholder="Repete password">
                <select name="gender" class="gender">
                    <option class="genderOption" value="1">Male</option>
                    <option class="genderOption" value="2">Female</option>
                </select>
                <input type="submit" value="Sign up" name="register_button" class="registerButton"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>