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
include("conn.php");

if(isset($_POST["ok"])){
    if($user_id ==""){ echo "<script>alert('عليك تسجيل الدخول للمتابعة'); </script>";}
    else{
    $cat_id =$_POST["serv"];

    $Coiffure_id = $_POST['Coiffure'];
    echo $cat_id." ".$coiffure_id;
    
    $sql="INSERT INTO appointment(cat_id,coiffure_id,user_id) VALUES ('$cat_id','$Coiffure_id','$user_id')";

    $res = mysqli_query($con , $sql);

  if($res){
    $idsql = "SELECT max(id) As lastid FROM appointment";
    $idres = mysqli_query($con,$idsql);
    $idrow = mysqli_fetch_assoc($idres);
    $lastid = $idrow['lastid'];
    echo "<script>window.open('appointmentTe.php?lastid=$lastid','_self')</script>";
  }else {
    echo "Failed";
  }
}
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width,initial-scale=1,maximum-scale=1" name="viewport">

        <!-- Favicon and Apple Icons -->
        <link rel="shortcut icon" href="images/favico.ico">
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
    </head>

    <body data-anchor="body">
    
            <div class="main-contents gray-bg mini-50">
                <div class="container">
                        <div class="row salon-services-wrapper">

                            <div class="col-md-9">
                                <div class="block-box tabs">
                                    <ul class="box-header" style="background-color: #9027ac;">
                                        <li style="float: none;color: #9027ac;">
                                            <a style="color: #9027ac;opacity: 1.7;">أسماء الكوافيرات</a>
                                        </li>
                                    </ul>
                                <div class="review">
                                    <div class="salon-hr">
                                        <div class="main-info col-md-12">
                                    <?php
                                                include('conn.php');
                                                $sql = "SELECT * FROM users where user_type = 'admin' order by id desc";
                                                $run = mysqli_query($con,$sql);
                                                while ($row = mysqli_fetch_array($run)) {
                                                    $id = $row['id'];
                                                    $name = $row['username'];
                                                    $user_type = $row['user_type'];
                                                    $phone = $row['mobile'];
                                                    $city = $row['city'];
                                                    $rating = $row['rating'];
                                                    ?>
                                        
                                        <div style="float: right;">
                                            <img src="assets/img/new_logo.png" alt="SALON IMAGE">
                                        </div>
                                    <div class="over-contents" style="padding-left:20px;text-align: center; ">
                                        <a href="Coiffuresitems.php?id=<?php echo $id; ?>">
                                                <h3 class="title" style="text-align: center;color:#000;margin-left: 35px" onmouseover="this.style.color='#9027ac'" onmouseout="this.style.color='#000'"><?php echo $name; ?></h3></a>
                                                <br>
                                                <?php if($rating >= 1 && $rating < 1.5){ ?>
                                        <div class="rating" style="float: none;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php }else if ($rating >= 1.5 && $rating < 2.5) { ?>
                                            <div class="rating" style="float: none;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php }else if ($rating >= 2.5 && $rating < 3.5) { ?>
                                            <div class="rating" style="float: none;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php }else if ($rating >= 3.5 && $rating < 4.5) { ?>
                                            <div class="rating" style="float: none;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php }else if ($rating >= 4.5 && $rating <= 5) { ?>
                                            <div class="rating" style="float: none;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                        </div><?php }else{ ?>
                                            <div class="rating" style="float: none;">
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php } ?>
                                                 <span style="float: right;"> المدينة  : <span class="dateofreview"><?php echo $city; ?></span></span><br>
                                                 <span style="float: right;"> للتواصل  : <span class="dateofreview"><?php echo $phone; ?></span></span>
                                                
                                                
                                                </div><hr>
                                            <?php } ?>
                                        
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>                            
                             <div class="col-md-3">
                               
                                <div class="block-box" style= "padding-top: 20px;text-align: center;">
                                    <div><h3>احجز موعدك</h3></div>
                                     <form action="" method = 'post'>

                                        <div>
                                    <select class="widget-title" name="serv" style="background-color: #9027ac;">
                                    <option disabled selected >اختر خدمة</option>
                                    <?php 
                                    $sql = "SELECT * FROM sub_categories order by id desc";
                                    $run = mysqli_query($con,$sql);
                                    while ($row = mysqli_fetch_array($run)) {
                                        $name = $row['name'];
                                        $cat_id = $row['id'];
                                        ?>
                                    <option value= "<?php echo $cat_id; ?>"><?php echo $name; ?></option>
                                    <?php } ?>
                                    </select></div>
                                    <div>
                                    <select class="widget-title" name="Coiffure" style="background-color: #9027ac;" required>
                                    <option disabled selected >اختر كوافير</option>
                                    <?php 
                                    $sql = "SELECT * FROM users where user_type = 'admin' order by id desc";
                                    $run = mysqli_query($con,$sql);
                                    while ($row = mysqli_fetch_array($run)) {
                                        $name = $row['name'];
                                        $userID = $row['id'];
                                        ?>
                                    <option value= "<?php echo $userID; ?>"><?php echo $name; ?></option>
                                    <?php } ?>
                                    </select></div>
                                    <input type="hidden" name="id">
                                    <button class="btn btn-primary" name="ok">الساعات المتاحة</button>
                            </form>    
                                </div><!-- end of cart wrapper -->
                            </div>                                  
                        </div>
                    </div>
            </div><!-- end of main contents -->
        <!-- end of all wrapper -->
        <?php include('footer.php');?>
        <!-- jQuery (necessary for JavaScript plugins) ================================================== -->
        <!-- <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
        

    </body>
</html>