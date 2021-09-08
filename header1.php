<?php
include('conn.php'); 
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Salonat</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <link href="assets/ass/css/bootstrap.css" rel="stylesheet"/>
    <!--     Fonts and icons     -->

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/ass/css/fonts/pe-icon-7-stroke.css" rel="stylesheet">

    <link href="assets/ass/css/bootstrap.min.css" rel="stylesheet">
    <!-- Style CSS -->
    <link href="assets/ass/css/style.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="assets/ass/css/owl.carousel.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/salonatcom/style.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

        <!-- If English version include en.css , and if Arabic version include ar.css -->
    <link href="assets/ass/css/gaia.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="assets/salonatcom/css/en.css">
   <style type="text/css">
       @import url(http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
       @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
       {
        navigate{
            direction: rtl;
        }
       }
   </style>

   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
     <div class="top-bar">
        <div class="container">
            <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
                
                    <?php 
                    $success = $_SESSION['success'];
                        echo "<script> alert('$success'); </script>"; 
                        $user_type = $_SESSION['user_type'];
                        unset($_SESSION['success']);
                    ?>
                
        <?php endif ?>
            <div class="row">
                <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12" style="float: right;">
                    <div class="navigate" style="background-color: #F5F5F5; ">
                        <div id="navigate">
                        <ul style="margin-right: 25px;">
                        <li style="float: right;">
                            <div style="height: 40px;width: 40px;">
                                <?php
                                $user_id = $_SESSION['UserId']; 
                                $sql = "SELECT user_type FROM users where id ='$user_id'";
                                $res = mysqli_query($db,$sql);
                                $row = mysqli_fetch_assoc($res);
                                $user_type = $row['user_type']; 
                                ?>
                               <a href="<?php if($user_type == 'admin') echo 'admin/menus.php'; else echo '#'?>"> <img src="images/admin_profile.png" /></a>
                                <div style="text-align: center;">
                                    <?php  if (isset($_SESSION['user'])) : ?>
                                        <strong><?php echo $_SESSION['user']['username']; ?></strong>
                                    <?php endif ?>
                                </div>
                            </div>
                        </li>
                        <li style="float: right; direction: rtl;">
                                    <i class="fa fa-angle-down" style="color: #9027ac;margin-top: 15px; margin-right: 20px; margin-bottom: 15px;font-size: 25px;"></i>
                                <ul style="text-align: right;">
                                    <li><a href="user.php" style="width: 125px;"><i class="icon-user-1"></i> &nbsp; الصفحة الشخصية</a></li>
                                    <li><a href = 'logout.php' style="width:125px;"><i class="icon-logout"></i> &nbsp; خروج</a></li>
                                </ul>
                        </li>
                        <li style="float: right;"><a href="favourite.php"><i class="fa fa-heart" style="font-size: 20px;color:red;margin-top: 10px; margin-right: 15px;"></i></a></li>
                        <li style="float: right; direction: rtl;">
                            <i class="material-icons" style="margin-top: 17px; margin-right: 5px;color:#9027ac;">notifications</i>
                            <a class="nav-link" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="left: -30px;margin-top: -30PX;background-color: transparent;">
                                <?php

                                $query = "SELECT * from `notifications` where `status` = 'unread' and user_id=$user_id order by `date` ASC";
                                if(count(fetchAll($query))>0){
                                ?>
                                <span class="badge badge-light-left" style="background-color: #9027ac"><?php echo count(fetchAll($query)); ?></span>
                                <?php } ?>
                            </a>
                            <ul class="dropdown" aria-labelledby="dropdown01" style="color: white;">
                <?php
                $query = "SELECT * from `notifications` WHERE user_id ='$user_id' order by `date` DESC LIMIT 5";
                 if(count(fetchAll($query))>0){
                     foreach(fetchAll($query) as $i){
                ?>
                <li>
              <a style ="width:270px;padding:4px;
                         <?php
                            if($i['status']=='unread'){
                                echo "font-weight:bold;";
                            }
                         ?>

                         " class="dropdown-item" href="notifications.php?id=<?php echo $i['id'] ?>">
                <small><i><?php
                 date_default_timezone_set("Asia/Gaza");
                 echo date('F j, Y, g:i a',strtotime($i['date'])) ?></i></small><br/>
                  <?php 
                  
                if($i['type']=='comment'){
                    echo "تم تعديل موعدك من قبل الكوافير";
                }else if($i['type']=='like'){
                    echo "تم حذف موعدك";
                }
                  
                  ?>
                </a></li>
              <div class="dropdown-divider" style="width: 200px;"></div>
                <?php
                     }
                 }else{
                     echo "No Records yet.";
                 }
                     ?>
            </ul>
                        </li>
                        <li style="float: left;margin-left: 30px;margin-top: 10px;">                    
                        <form method="get" action="results_Search.php" enctype="multipart/form-data">
                            
                                    <input type="text" style = "color: #141313;font-size: 15px;font-weight: 500;margin-bottom: 10px;border-radius: 10px;text-align: right;background-color: transparent; border: none;" placeholder="... ابحث هنا" name="user_search">
                                <button name="search" class="call-text" style="background-color: transparent; border: none;float: left;margin-top: 7px;">
                                    <i class="fa fa-search"></i>
                                </button>
                            
                        </form>
                    
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="float: left;">
                    <div class="social">
                        <ul style="margin-top: 10px;">
                            <li><a href="#"><i class="fa fa-facebook" style="color: #9027ac"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" style="color: #9027ac"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" style="color: #9027ac"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest" style="color: #9027ac"></i></a></li>
                        </ul>
                    </div>
        </div>
    </div>
</div></div>
    <div class="header-wrapper" style="background-color: whitesmoke; padding-top: 0px; padding-bottom: 0px;">
        <div class="container" >
            <div class="row">
                
                <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12" style="float: right;">
                    <div class="navigation">
                        <div id="navigation">
                            <ul style="text-align: center;">
            <li><a href="index.php" title="الرئيسية">الرئيسية</a></li>
            <li><a href="service-salons.php" title="الخدمات" >الخدمات</a>
              <ul>
                <?php 

                include('conn.php');

                $get_categories = "SELECT * FROM categories order by id asc";

                $run_categories = mysqli_query($con,$get_categories);

                while ($row = mysqli_fetch_array($run_categories)) {

                    $id = $row['id'];
                    $name = $row['Ar_name'];
                ?>
                <li><a href="CoiffureView.php?id=<?php echo $id; ?>" title="<?php echo $name; ?>" ><?php echo $name; ?></a></li>
<?php } ?>
              </ul>
            </li>
            <li><a href="appointmentss.php" title="حجز موعد">حجز موعد</a>
            </li>
            <li><a href="contact-us.php" title="تواصل معنا">تواصل معنا</a> </li>
        
        </ul>

                        </div>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-top: 15px;">
                    <a href="index.php"><b style="letter-spacing: -6px; font-size: 34px; font-style: oblique;  font-family: cursive;">SALONAT</b></a>
                 </div>
            </div>
        </div>
    </div>
    </body>
    <script src="assets/ass/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/ass/js/bootstrap.js" type="text/javascript"></script>

<!--  js library for devices recognition -->
<script type="text/javascript" src="assets/ass/js/modernizr.js"></script>

<!--  script for google maps   -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!--   file where we handle all the script from the Gaia - Bootstrap Template   -->
<script type="text/javascript" src="assets/ass/js/gaia.js"></script>
<!-- SHINE PROJECT-->
<script src="assets/ass/js/jquery.min.js" type="text/javascript"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/ass/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/ass/js/navigation.js" type="text/javascript"></script>
    <script src="assets/ass/js/menumaker.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/ass/js/jquery.sticky.js"></script>
    <script type="text/javascript" src="assets/ass/js/slider/sticky-header.js"></script>
    <script type="text/javascript" src="assets/ass/js/slider/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/ass/js/slider/slider.js"></script>
    <script type="text/javascript" src="assets/ass/js/slider/testimonial-slider.js"></script>
    <script src="assets/salonatcom/js/min/jquery.min.js" type="text/javascript"></script>
        <!-- Custom JavaScript Files ================================================== -->
        <script src="assets/salonatcom/js/min/compiler.min.js" type="text/javascript"></script>
        <script src="assets/salonatcom/js/min/scripts.min.js" type="text/javascript"></script>
        <script src="assets/salonatcom/js/dev.js" type="text/javascript"></script>
    <?php /*
    <script src="assets/ass/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/ass/js/bootstrap.js" type="text/javascript"></script>

<!--  js library for devices recognition -->
<script type="text/javascript" src="assets/ass/js/modernizr.js"></script>

<!--  script for google maps   -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!--   file where we handle all the script from the Gaia - Bootstrap Template   -->
<script type="text/javascript" src="assets/ass/js/gaia.js"></script>
<!-- SHINE PROJECT-->
<script src="assets/ass/js/jquery.min.js" type="text/javascript"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/ass/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/ass/js/navigation.js" type="text/javascript"></script>
    <script src="assets/ass/js/menumaker.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/ass/js/jquery.sticky.js"></script>
    <script type="text/javascript" src="assets/ass/js/slider/sticky-header.js"></script>
    <script type="text/javascript" src="assets/ass/js/slider/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/ass/js/slider/slider.js"></script>
    <script type="text/javascript" src="assets/ass/js/slider/testimonial-slider.js"></script>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/jquery.sticky.js"></script>
    <script type="text/javascript" src="js/sticky-header.js"></script>
    */ ?>
</html>
