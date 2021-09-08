<?php
include('functions.php');

    if (!isLoggedIn()) {
        include('header.php');
    }else {
        include('header1.php');
    }
    $user_id = $_SESSION['UserId'];
?>
<?php 
require_once("Rate.php");
$rate = new Rate();
$result = $rate->getAllPost();
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width,initial-scale=1,maximum-scale=1" name="viewport">
        <!-- The above 5 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- css => style sheet -->
        <link rel="stylesheet" type="text/css" href="assets/salonatcom/style.css">

        <!-- If English version include en.css , and if Arabic version include ar.css -->
        <link rel="stylesheet" type="text/css" href="assets/salonatcom/css/en.css">
        <!-- <link rel="stylesheet" type="text/css" href="css/ar.css"> -->

        <style>
            .demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333}
            .demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
            .demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
            .demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
            .demo-table ul{margin:0;padding:0;}
            .demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
            .demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
        </style>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script>function highlightStar(obj,id) {
            removeHighlight(id);
            $('.demo-table #tutorial-'+id+' li').each(function(index) {
                $(this).addClass('highlight');
                if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
                    return false;
                }
            });
        }

        function removeHighlight(id) {
            $('.demo-table #tutorial-'+id+' li').removeClass('selected');
            $('.demo-table #tutorial-'+id+' li').removeClass('highlight');
        }

        function addRating(obj,id) {
            $('.demo-table #tutorial-'+id+' li').each(function(index) {
            $(this).addClass('selected');
            $('#tutorial-'+id+' #rating').val((index+1));
            if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
               return false;
           }
       });
            $.ajax({
                url: "add_rating.php",
                data:'id='+id+'&rating='+$('#tutorial-'+id+' #rating').val(),
                type: "POST"
            });
        }

        function resetRating(id) {
            if($('#tutorial-'+id+' #rating').val() != 0) {
                $('.demo-table #tutorial-'+id+' li').each(function(index) {
                    $(this).addClass('selected');
                    if((index+1) == $('#tutorial-'+id+' #rating').val()) {
                        return false;
                    }
                });
            }
        } 
    </script>
    </head>
    <body data-anchor="body">
            <div class="main-contents gray-bg mini-50">
                <div class="container">
                    <div class="row grid salons-filter">
                        <div class="col-md-9 grid-item mix">
                            <div class="salon-hr">
                                <div class="main-info col-md-12">
                                    <?php
                                        include('conn.php');

                                        if(isset($_GET['id']))
                                        {
                                            $id = $_GET['id'];

                                            $get_item = "SELECT *,(SELECT name FROM users WHERE users.id = user_id) AS CoiffureName FROM menus_items WHERE id = '$id'";

                                            $run_item = mysqli_query($con, $get_item);

                                            $row = mysqli_fetch_assoc($run_item);

                                            $item_id = $row['id'];
                                            $item_name = $row['item_name'];
                                            $item_price = $row['item_price'];
                                            $item_image = $row['item_image'];
                                            $item_description = $row['item_description'];
                                            $coiffure_name = $row['CoiffureName'];
                                            $coiffure_id = $row['user_id'];

                                            if(isset($_POST['love'])){
                                                if($user_id=="") echo "<script>alert('يجب تسجيل الدخول أولا');</script>";
                                                else{
                                                    $itemuser = $user_id.$item_id;
                                                $sqlLove = "INSERT INTO favourite(user_id,favorite_status,item_id,itemuser)VALUES('$user_id','1','$item_id')";
                                                $resLove = mysqli_query($con,$sqlLove);
                                                if($resLove){
                                                    echo "<script>alert('تم إضافة العنصر إلى المفضلة');</script>";
                                                    echo "<script>window.open('favourite.php?id=$item_id');";
                                                }else{
                                                    echo "<script>alert('تم إضافته مسبقا');</script>";
                                                }
                                            }
                                            }

                                        }

                                         ?>
                                    <div class="media-holder">
                                        <a href="detailsitem.php?id=<?php echo $item_id; ?>" title="<?php echo $item_name; ?>" class="focuspoint">
                                            <img src="images/<?php echo $item_image; ?>" alt="<?php echo $item_name; ?>">
                                        </a>
                                    </div>
                                    <div class="over-contents" style="text-align: right; margin-top: 20px;">
                                        <h3 class="title"><a href="Coiffuresitem.php?id=<?php echo $coiffure_id; ?>" style="color: ##da92ed"><?php echo $coiffure_name; ?></a></h3>
                                        <table class="demo-table" style="text-align: center; margin-top: -25px;">
                                            <tbody>
                                                <?php
                                                if(!empty($result)) {
                                                    $i=0;
                                                    foreach ($result as $menus_items) {
                                                        if($menus_items["id"] == $id){
                                                ?>
                                                <tr>
                                                    <td valign="top">
                                                        <div id="tutorial-<?php echo $menus_items["id"]; ?>">
                                                            <input type="hidden" name="rating" id="rating" value="<?php echo $menus_items["rating"]; ?>"
                                                            />
                                                            <ul onMouseOut="resetRating(<?php echo $menus_items["id"]; ?>);">
                                                                <?php
                                                                for($i=1;$i<=5;$i++) {
                                                                    $selected = "";
                                                                    if(!empty($menus_items["rating"]) && $i<=$menus_items["rating"]) {
                                                                        $selected = "selected";
                                                                    }
                                                                    ?>
                                                                    <li class='<?php echo $selected; ?>' onmouseover="highlightStar(this,<?php echo $menus_items["id"]; ?>);" onmouseout="removeHighlight(<?php echo $menus_items["id"]; ?>);" onClick="addRating(this,<?php echo $menus_items["id"]; ?>);">&#9733;</li> <?php }  ?>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        </tr>
                                                        <?php } } } ?>
                                                    </tbody>
                                                </table>
                                        <p><?php echo $item_description; ?></p>
                                        <span class="address"><span>السعر : </span><?php echo $item_price; ?></span>
                                    </div>
                                    <form method="post" action="detailsitem.php?id=<?php echo $item_id; ?>">
                                    <button class="btn btn-danger" name="love" value="love" style="float: right;margin-right: 140px;">أضف إلى المفضلة</button></form>
                                </div>
                            </div><br>
                            <!--comments start-->
                            <div class="salon-hr">
                                <div class="main-info col-md-12">
                                    <div class="comment-area" style="margin-top: 0px;">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="comment-title">
                                                    <h3 class="mb30" style="float: right;"> التعليقات </h3><br><br>
                                                        <?php
                                                        include('conn.php');
                                                        if(isset($_POST['submit'])){

                                                            $comment = $_POST['comment'];
                                                            $name = $_POST['name'];
                                                            $email = $_POST['email'];
                                                            $time = date_default_timezone_set('Y-d-m H:i:s');

                                                            $sql="INSERT INTO `comments`(`item_id`, `name`, `email`, `time`, `comment`) VALUES ('$item_id','$name','$email','$time','$comment')";
                                                            $query = mysqli_query($con,$sql);

                                                            if($query){
                                                                echo "<script>alert('تم لإضافة العنصر بنجاح')</script>";
                                                                echo "<script>window.open('details.php?id ='.$item_id,'_self')</script>";
                                                            }

                                                            $get = "SELECT * FROM comments WHERE item_id = '$item_id'";

                                                            $run = mysqli_query($con,$get);

                                                            while ($row = mysqli_fetch_array($run)) {

                                                                $name = $row['name'];
                                                                $time = $row['time'];
                                                                $comment = $row['comment'];

                                                         ?>
                                                         <ul class="comment-list">
                                                        <li>
                                                            <div class="comment-author"><img src="images/user-pic-1.jpg" alt="" class="img-circle"> </div>
                                                            <div class="comment-info">
                                                                <div class="comment-header">
                                                                    <h4 style="text-align: right;" ><?php echo $name; ?></h4>
                                                                    <!--<span style="text-align: right;" class="comment-meta-date"><?php echo $time; ?></span>-->
                                                                </div>
                                                                <div class="comment-content">
                                                                    <p style="text-align: right;margin-right: 30px;margin-top: 5px;"><?php echo $comment ?></p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul><?php } } ?>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <!--comments close-->
                         <div class="salon-hr">
                                <div class="main-info col-md-12">
                     <div class="leave-comments">
                                        <h3 class="mb30" style="float: right;"> : أضف تعليق</h3><br><br>
                                        <form method="post" action="<?php echo 'detailsitem.php?id='.$item_id;?>">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-md-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label sr-only" for="textarea"></label>
                                                        <textarea class="form-control" id="textarea" name="comment" style="text-align: right;" rows="6" placeholder="التعليق"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-md-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label sr-only required" for="name"></label>
                                                        <input style="text-align: right;" id="name" name="name" type="text" class="form-control" placeholder="الاسم">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-md-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label sr-only required" for="email"></label>
                                                        <input style="text-align: right;" id="email" name="email" type="email" class="form-control" placeholder="الايميل">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-md-6 col-xs-12">
                                                    <div class="form-group">
                                                        <button id="singlebutton" name="submit" class="btn btn-primary btn-sm">أضف تعليق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 grid-item" style="float: right;">
                            <!-- widget-archievs-start -->
                    <div class=" widget">
                        <h2 class="widget-title" style="text-align: center;font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif;">جميع التصنيفات</h2>
                        <ul>
                            <?php

                            $result = mysqli_query($con,"SELECT id,name FROM sub_categories order by id asc");
                            while ($row = mysqli_fetch_array($result)) {

                                $sub_category_id = $row['id'];
                                $name = $row['name'];

                            ?>
                            <li style="text-align: center;font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif;"><a href="subCoiffureView.php?id=<?php echo $sub_category_id; ?>"><?php echo $name ?></a></li>
                            <?php } ?>
                        </ul> 
                    </div>
                </div>
                    </div>
                    
                        
            
        
                    <!-- widget-archievs-close -->
                </div>

            </div><!-- end of main contents -->
        <!-- end of all wrapper -->
        <?php include('footer.php'); ?>
        <!-- jQuery (necessary for JavaScript plugins) ================================================== -->
        <!-- <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
        <script src="assets/salonatcom/js/min/jquery.min.js" type="text/javascript"></script>
        <!-- Custom JavaScript Files ================================================== -->
        <script src="assets/salonatcom/js/min/compiler.min.js" type="text/javascript"></script>
        <script src="assets/salonatcom/js/min/scripts.min.js" type="text/javascript"></script>
        <script src="assets/salonatcom/js/dev.js" type="text/javascript"></script>

    </body>
</html>