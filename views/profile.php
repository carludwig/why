
            <?php include "header.php"?>
            <div id="wallContent">
                <?php
                    if($user->profile_img == null){
                        $picture = "../../why/views/img/anonym.png";
                    }
                    else{
                        $picture = $user->profile_img;
                    }
                ?>
                <div class="profileContent">
                    <div class="profileInfo">
                        <img class="profilePic" src="<?php echo($picture)?>" />
                        <div class="profileFollow">
                            <p class="profileName"><?php echo($user->first_name . " " . $user->last_name)?></p>
                            <div class="follows">
                                <div class="followsNrDiv">
                                    <p class="followsNr"><?php echo($follow)?></p>
                                </div>
                                <a href="..//user/followers" class="noStyleLinks"><p class="followsText">Follow</p></a>
                            </div>
                            <div class="follows">
                                <div class="followsNrDiv">
                                    <p class="followsNr"><?php echo($followers)?></p>
                                </div>
                                <a href="..//user/followers" class="noStyleLinks"><p class="followsText">Followers</p></a>
                            </div>
                            <div class="followRequest">
                                <a class="noStyleLinks" href="..//user/followers"><p class="followRequestText">You have ? requests</p></a>
                            </div>
                            <input type="submit" name="follow_button" id="followButton" value="FOLLOW"/>
                            <input type="submit" name="" id="unfollowButton" value="UNFOLLOW"/>
                            <div class="about">
                                <p class="aboutText"><?php echo($user->about)?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post">
                    <form method="post" action="../user/addStatus">
                        <div class="postContent">
                            <textarea class="writePost" name="text" placeholder="Write your status here..."></textarea>
                            <input class="postPhoto" name="photo" placeholder="Choose your photo..." type="text"/>
                            <input class="postSound" name="sound" placeholder="Choose your sound..." type="text"/>
                        </div>
                        <div class="hiddenPostContent">
                            <div class="postBorder">
                                <p class="postBorderText" id="showSound">SOUND</p>
                                <p class="postBorderText" id="showPhoto">PHOTO</p>
                                <p class="postBorderText" id="showText">TEXT</p>
                            </div>
                            <input type="submit" class="postButton" name="post_text_button" value="POST"/>
                            <input type="submit" class="photoButton" name="post_photo_button" value="POST"/>
                            <input type="submit" class="soundButton" name="post_sound_button" value="POST"/>
                        </div>
                    </form>
                </div>
                <div class="statusContent">
                    <?php
                    for($post = 0; $post < count($posts); $post++){
                        if($user->profile_img == null){
                            $picture = "../../myspace kopia/views/img/anonym.png";
                        }
                        else{
                            $picture = $user->profile_img;
                        }
                        ?>
                        <form method="post" action="../user/other">
                            <div class="aStatus">
                                <div class="statusUser">
                                    <img src="<?php echo($picture)?>" class="statusUserImg">
                                    <input class="statusUserText" value="<?php echo($user->first_name . " " . $user->last_name)?>" type="submit" name="other_user_button"/>
                                    <input type="hidden" value="<?php echo($posts[$post]["user_id"])?>" name="hidden_user_id">
                                </div>
                                <div class="statuses">
                                    <div class="statusBorder">
                                        <p class="statusBorderText"><?php echo($posts[$post]['created'])?></p>
                                    </div>
                                    <div class="statusPosts">
                                        <p class="statusPostsText"><?php echo($posts[$post]['text'])?></p>
                                    </div>
                                    <div class="statusPosts">
                                        <img class="statusPostsPhoto" src=""/>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        $comment_count = 0;
                        for($k = 0; $k < count($comments); $k++){
                            if($comments[$k]["post_id"] == $posts[$post]['post_id']){
                                $comment_count += 1;
                            }
                        }
                        ?>
                        <div class="statusUnderBorder">
                            <div class="showLikes">
                                <p class="showLikesText">13,900 L</p>
                                <a href="#" class="noStyleLinks"><p class="showComments"><?php echo($comment_count)?></p><img src="..//views/img/commentpic.png" class="commentPic"/></a>
                            </div>
                            <div class="statusButtons">
                                <input class="likeButton" type="submit" value="LIKE" name=""/>
                                <form class="comment_form commentButton" method="post">
                                    <input class="hidden_post_id" type="hidden" value="<?php echo($posts[$post]['post_id'])?>">
                                    <input class="commentButton" type="button" value="COMMENT" name="show_comments"/>
                                </form>
                            </div>
                        </div>
                        <div class="commentContent">
                            <?php
                            for($j = 0; $j < count($comments); $j++){
                                if($comments[$j]["post_id"] == $posts[$post]['post_id']){
                                    if($comments[$j]["profile_img"] == null){
                                        $picture = "../../myspace kopia/views/img/anonym.png";
                                    }
                                    else{
                                        $picture = $comments[$j]["profile_img"];
                                    }
                                    ?>
                                    <div class="othersComments">
                                        <div class="othersCommentsBorder">
                                            <p class="commentBorderText"><?php echo($comments[$j]['first_name'] . " " . $comments[$j]['last_name'] . " || " . $comments[$j]['created'])?></p>
                                        </div>
                                        <div class="othersCommentContent">
                                            <img class="othersCommentPic" src="<?php echo($picture)?>"/>
                                            <p class="othersCommentText"><?php echo($comments[$j]['content'])?></p>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                            ?>
                            <div class="yourComment">
                                <input class="yourCommentText" name="content" type="text" placeholder="Wright your comment here..."/>
                            </div>
                            <input class="hidden_post_id" name="hidden_post_id" type="hidden" value="<?php echo($posts[$post]['post_id'])?>">
                            <input class="hidden_current_user" type="hidden" value="<?php echo($_SESSION["user"]->user_id)?>">
                            <input class="hidden_profile_pic" type="hidden" value="<?php echo($_SESSION["user"]->profile_img)?>">
                            <input class="hidden_user_name" type="hidden" value="<?php echo($_SESSION["user"]->first_name . " " . $_SESSION["user"]->last_name)?>">
                            <input class="yourCommentButton" type="submit" name="submit_comment" value="COMMENT"/>
                        </div>
                    <?php
                    }?>
                </div>
            </div>
    </body>
</html>