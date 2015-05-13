
<html>
    <head>
        <title>WHY</title>
        <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href="../views/css/main.css" rel="stylesheet" type="text/css"/>
        <link href="../views/css/reset.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="..//views/js/main.js"></script>
    </head>

    <body id="body">
        <div id="page-cover">
        </div>
        <div id="editContent">
            <div id="edit">
                <form method="post" action="../user/update">
                    <p class="editHeadline">Edit Profile</p>
                    <input type="text" class="editInputs" placeholder="First Name" name="first_name" value="<?php echo($_SESSION["user"]->first_name)?>"/>
                    <input type="text" class="editInputs" placeholder="Last Name" name="last_name" value="<?php echo($_SESSION["user"]->last_name)?>"/>
                    <input type="text" class="editInputs" placeholder="Change Profile Picture" name="profile_img" value="<?php echo($_SESSION["user"]->profile_img)?>"/>
            <!--        <input type="text" class="editInputs" placeholder="Old Password" name="password" />-->
            <!--        <input type="text" class="editInputs" placeholder="New Password" name="password"/>-->
                    <textarea type="text" class="editAbout" placeholder="Write something about yourself" name="about"><?php echo($_SESSION["user"]->about)?></textarea>
                    <div class="editButtons">
                        <input type="button" value="CANCEL" id="cancelButton" name=""/>
                        <input type="submit" value="SAVE" id="saveButton" name="save_button"/>
                    </div>
                </form>
            </div>
        </div>
        <div id="wallpaper">
                <div id="header">
                    <img class="logoPic" src="..//views/img/greysounder.png"/>
                </div>
            <div id="menu">
                <div id="menuBorder">
                    <a href="../wall/show" class="noStyleLinks"><div class="menuItems">
                        <p class="menuItemText">Wall</p>
                    </div></a>
                    <a href="../user/show" class="noStyleLinks"><div class="menuItems">
                        <p class="menuItemText">Profile</p>
                    </div></a>
                    <div class="menuItemsSearch">
                        <input type="search" name="search" placeholder="Search" class="search" />
                    </div>
                    <div id="rightMenuItem">
                        <a href="#" class="noStyleLinks"><p class="menuItemText"><?php echo($_SESSION['user']->first_name ." " . $_SESSION['user']->last_name)?></p></a>
                    </div>
                    <div id="hiddenMenu">
                        <a href="#" class="noStyleLinks"><p id="showEdit" class="hiddenMenuText">Edit Profile</p></a>
                        <a href="../auth/logout" class="noStyleLinks"><p class="hiddenMenuText">Log Out</p></a>
                    </div>
                </div>
                <div class="searchContent">
                    <?php
                        for($i = 0; $i < count($allUsers); $i++){
                            if($allUsers[$i]["profile_img"] == null){
                                $picture = "../../myspace kopia/views/img/anonym.png";
                            }
                            else{
                                $picture = $allUsers[$i]["profile_img"];
                            }
                    ?>
                    <div class="searchRow">
                        <img class="searchRowPic" src="<?php echo($picture)?>">
                        <p class="searchRowName"><?php echo($allUsers[$i]["first_name"] . " " . $allUsers[$i]["last_name"])?></p>
                    </div>
                    <?php
                         }
                    ?>
                </div>
            </div>

