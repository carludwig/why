<?php include "header.php" ?>

<div id="wallContent">
        <div id="underBorder">
            <div class="underBorderItem">
                <input class="underBorderText" type="submit" value="SOUND" name="sort_sound"/>
            </div>
            <div class="underBorderItem">
                <input class="underBorderText" type="submit" value="PHOTO" name="sort_photo"/>
            </div>

            <div class="underBorderItem">
                <input class="underBorderText" type="submit" value="TEXT" name="sort_text"/>
            </div>
        </div>
        <div class="statusContent">
            <?php
            for($post = 0; $post < count($posts); $post++){
                if($posts[$post]["profile_img"] == null){
                    $picture = "../../why/views/img/anonym.png";
                }
                else{
                    $picture = $posts[$post]["profile_img"];
                }
                ?>
                <form method="post" action="../user/other">
                    <div class="aStatus">
                        <div class="statusUser">
                            <img src="<?php echo($picture)?>" class="statusUserImg">
                            <input class="statusUserText" value="<?php echo($posts[$post]["first_name"] . " " . $posts[$post]["last_name"])?>" type="submit" name="other_user_button"/>
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
                                $picture = "../../why/views/img/anonym.png";
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