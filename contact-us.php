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
if(!empty($_POST["send"])) {
    $name = $_POST["userName"];
    $email = $_POST["userEmail"];
    $cat_id = $_POST["subject"];
    $content = $_POST["content"];
    $phone = $_POST['phone'];


    $conn = mysqli_connect("localhost", "root", "12345678", "Salonat") or die("Connection Error: " . mysqli_error($conn));
    mysqli_query($conn, "INSERT INTO tblcontact (user_name, user_email,cat_id,content,phone) VALUES ('" . $name. "', '" . $email. "','" . $cat_id. "','" . $content. "', '" . $phone. "')");
    $insert_id = mysqli_insert_id($conn);
    //if(!empty($insert_id)) {
       $message = "Your contact information is saved successfully.";
       $type = "success";
    //}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body style="background: #eee">
    <!-- page-header-start -->
    <div class="section section-small section-get-started" style="z-index: 1;">
        <div class="parallax filter">
            <div class="image" style="background-image: url('assets/img/banner.jpg');text-align: center;"></div>
    <div class="page-header">
        <div class="container" >
            <div class="row">
                <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                    <div class="page-section">
                        <h1 class="page-title" style="font-size: 60px;font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif;">اتصل بنا</h1>
                        <p class="page-text">لا تتردد في الاتصال ، لدينا فريق متحمس لمقابلتك ومعرفة كيف يمكننا مساعدتك.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div><br>
    <!-- page-header-close -->
        <div class="container"style="width: 83%">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="contact-block">
                        <div class="contact-info">
                            <i class="fa fa-map-marker"></i>
                            <h4 class="contact-info-title">العنوان</h4>
                            <p style="font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px;">عنواننا .. هو عنوانك</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="contact-block">
                        <div class="contact-info">
                            <i class="fa fa-phone"></i>
                            <h4 class="contact-info-title">اتصل بنا</h4>
                            <p><strong class="text-primary">+97059-0000-000</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="contact-block">
                        <div class="contact-info">
                            <i class="fa fa-envelope-open"></i>
                            <h4 class="contact-info-title">عبر البريد الالكتروني</h4>
                            <p>info@salonat.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mb30">
                        <div class="contact-form">
                            <h1 style="float: right;font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif;">ابقى على تواصل</h1><br><br>
                            <p class="mb40" style="float: right;font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif;">اترك نموذج رسالة , سنبذل أقصى ما لدينا للرد بأسرع وقت</p>
                            <br><br>
                            <div class="row">
                                <form name="frmContact" id="frmContact" method="post" action="" enctype="multipart/form-data" onsubmit="return validateContactForm()">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only " for="name"></label><span id="userName-info" class="info"></span>
                                            <input name="userName" id="userName" type="text" placeholder="الاسم" class="form-control" style="text-align: right;">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only " for="email"></label><span id="userEmail-info" class="info"></span>
                                            <input name="userEmail" id="userEmail" type="email" placeholder="الايميل" class="form-control" style="text-align:right;">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only " for="phone"></label><span id="phone-info" class="info"></span>
                                            <input id="phone" name="phone" type="text" placeholder="الهاتف" class="form-control" style="text-align: right;">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                <label class="control-label sr-only required" for="Salonat"> </label><span id="subject-info" class="info"></span>
                                <select name="subject" id="subject" placeholder="خدمات الموقع" type="text" class="form-control" style="padding-left: 430px;">
                                    <option value="">خدمات الصالون</option>
                                    <?php

                                    include('conn.php');

                                    $get_categories = "SELECT * FROM categories order by id asc";

                                    $run_categories = mysqli_query($con,$get_categories);

                                    while ($row = mysqli_fetch_array($run_categories)) {

                                        $id = $row['id'];
                                        $name = $row['Ar_name'];
                                    ?>
                                       <option value="<?php echo $id ?>"><?php echo $name ?></option>
                                    
                                <?php } ?>
                                </select>
                            </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="textarea"></label><span id="userMessage-info"class="info"></span>
                                            <textarea class="form-control" name="content" id="content" rows="4" placeholder="الرسالة" style="text-align: right;"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" name="send" value="Send" style="float: right;">أرسل رسالتك</button>
                                    </div>
                                     <div id="statusMessage"> 
                        <?php
                        if (! empty($message)) {
                            ?>
                            <p class='<?php echo $type; ?>Message'><?php echo "<script> alert ('$message'); </script>"; ?></p>
                        <?php
                        }
                        ?>
                    </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
   </div>
   <div class="container-fluid">
        <div class="row">
            <!-- map-start -->
            <div>
                <div id="contact-map"></div>
            </div>
            <!-- map-close -->
        </div>
    </div>
    <div class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 style="font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif;">+هل تملك أي استفسار ؟ اتصل بنا : 000-0000-97059</h1>
                </div>
            </div>
        </div>
    </div>
      <!-- footer start -->
    <?php include('footer.php'); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/navigation.js" type="text/javascript"></script>
    <script src="js/menumaker.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.sticky.js"></script>
    <script type="text/javascript" src="js/sticky-header.js"></script>
     <script>
    function initMap() {
        var uluru = {
            lat: 23.094197,
            lng: 72.558148
        };
        var map = new google.maps.Map(document.getElementById('contact-map'), {
            zoom: 14,
            center: uluru,
            scrollwheel: false
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            icon: 'images/map-marker.png'

        });//AIzaSyBZib4Lvp0g1L8eskVBFJ0SEbnENB6cJ-g&callback=initMap
    }//AIzaSyDL8tr-X4SP_L56roopmFG5_kB8jGjdlMc
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZib4Lvp0g1L8eskVBFJ0SEbnENB6cJ-g&callback=initMap">
    </script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"
        type="text/javascript"></script>
    <script type="text/javascript">
        function validateContactForm() {
            var valid = true;

            $(".info").html("");
            $(".form-control").css('text-align', 'right');
            var userName = $("#userName").val();
            var userEmail = $("#userEmail").val();
            var subject = $("#subject").val();
            var phone = $("#phone").val();
            var content = $("#content").val();
            
            if (userName == "") {
                $("#userName-info").html("Required.");
                $("#userName").css('border', '#9027ac 1px solid');
                valid = false;
            }
            if (userEmail == "") {
                $("#userEmail-info").html("Required.");
                $("#userEmail").css('border', '#9027ac 1px solid');
                valid = false;
            }
            if (!userEmail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
            {
                $("#userEmail-info").html("Invalid Email Address.");
                $("#userEmail").css('border', '#9027ac 1px solid');
                valid = false;
            }

            if (subject == "") {
                $("#subject-info").html("Required.");
                $("#subject").css('border', '#9027ac 1px solid');
                valid = false;
            }
            if (phone == "") {
                $("#phone-info").html("Required.");
                $("#phone").css('border', '#9027ac 1px solid');
                valid = false;
            }
            if (content == "") {
                $("#userMessage-info").html("Required.");
                $("#content").css('border', '#9027ac 1px solid');
                valid = false;
            }
            return valid;
        }
</script>
<?php/*
if(!empty($_POST["send"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $cat_id = $_POST["subject"];
    $content = $_POST["content"];
    $phone = $_POST['phone'];

    $toEmail = "RashaGhazy98@gmail.com";
    $mailHeaders = "From: " . $name . "<". $email .">\r\n";
    if(mail($toEmail, $cat_id, $content, $mailHeaders)) {
        $message = "Your contact information is received successfully.";
        $type = "success";
    }
}*/
?>
</body>

</html>