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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type='text/css'>
    <link href="assets/ass/css/owl.carousel.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/salonatcom/style.css">
            <link href="assets/ass/css/gaia.css" rel="stylesheet"/>

        <!-- If English version include en.css , and if Arabic version include ar.css-->

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/salonatcom/css/en.css">

</head>
<body>
     <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12" style="float: right;">
                    <div class="navigation">
                        <div id="navigation">
                        <ul>
                        <li style="float: right;">
                            <a href="login.php"><i class="icon-user-1" style="float: right;"></i> &nbsp; دخول</a>
                            
                        </li>
                        <li style="float: right;">
                            <a href="register.php"><i class="icon-users" style="float: right;"></i> &nbsp;  التسجيل</a>
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
            <li class="active"><a href="index.php" title="الرئيسية">الرئيسية</a></li>
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
            <li><a href="#" title="حجز موعد">مدونتنا</a>
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
</html>
