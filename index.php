<?php
include('functions.php');

    if (!isLoggedIn()) {
        include('header.php');
    }else {
        include('header1.php');
    }
    $user_id = $_SESSION['UserId'];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
</head>
<body>
    <div class="slider">
        <div class="owl-carousel slider">
            <div class="item">
                <div class="slider-img"> <img src="assets\ass\img\slider-1.jpg" alt="" style="width: 100%;"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="slider-captions">
                                <h1 class="slider-title" style="font-family: 'Droid Arabic Kufi'; size: 20px;">هل تبحثين عن صالون تجميل ... أو مهنة ؟</h1>
                                <p class="slider-text hidden-xs" style="font-family: 'Droid Arabic Kufi';">نوفر لك مجموعة من خدمات التجميل مثل الوجه, تصفيف الشعر,إزالة الشعر بالشمع, المكياج ,ونحن متحمسون لتقديم خدمة أو مهنة مرنة لك</p>
                                <a href="about.php" class="btn btn-lg hidden-sm hidden-xs" style="background-color: #9c27b0; color: white; font-family: 'Droid Arabic Kufi';size: 16px;">اضغط هنا للتعرف علينا</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="slider-img"><img src="assets\ass\img\slider-3.jpg" alt="" style="width: 100%;"></div>
                <div class="container">
                    <div class="row" >
                        <div class="col-lg-5 col-md-5 col-sm-12  col-xs-12" style="float: right;">
                            <div class="slider-captions">
                                <h1 class="slider-title" style="font-family: 'Droid Arabic Kufi'; size: 20px;">عمل جيد وأسعار معقولة</h1>
                                <p class="slider-text hidden-xs" style="font-family: 'Droid Arabic Kufi';">نجلب خدمات التجميل الاحترافية إلى منزلك مباشرة</p>
                                <a href="service-salons.php" class="btn btn-default btn-lg hidden-sm hidden-xs" style="background-color: #9c27b0; color: white; font-family: 'Droid Arabic Kufi';size: 16px;">خدماتنا</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="slider-img"><img src="assets\ass\img\slider-2.jpg" alt="" style="width: 100%;"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12  col-xs-12">
                            <div class="slider-captions">
                                <h1 class="slider-title" style="font-family: 'Droid Arabic Kufi'; size: 20px;">نحن نساعد في حصولك على عمل أو خدمة ممتازة</h1>
                                <p class="slider-text hidden-xs" style="font-family: 'Droid Arabic Kufi';">عن طريق أدواتك الخاصة التي تحتاجين إليها</p>
                                <a href="contact-us.php" class="btn btn-default btn-lg hidden-sm hidden-xs" style="background-color: #9c27b0; color: white; font-family: 'Droid Arabic Kufi';size: 16px;">تواصل معنا</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="title-area">
                    <h2 style="font-family: 'Droid Arabic Kufi';">خدماتنا</h2>
                    <div class="separator separator-danger">✻</div>
                    <p class="description">نعدكم بمظهر جديد والأهم جمال فريد , وذلك بالتعرف عليك وعلى احتياجاتك لجعلك بمظهر لائق حسب الأفضل لك.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <a href="CoiffureView.php?id=13">
                        <img src="assets\ass\img\user-pic-1.jpg" alt="" class="img-circle" style="height: 160px; width: 160px; border: 2px double #9027ac;"></a>
                        </div>
                        <h3 style="font-family: 'Droid Arabic Kufi';">تجميل أظافر</h3>
                        <p class="description" style="font-family: 'Droid Arabic Kufi';">نجعل التصاميم مثالية لك , وبما يتناسب مع بشرتك وملابسك</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <a href="CoiffureView.php?id=12">
                            <img src="assets\ass\img\user-pic-3.jpg" alt="" class="img-circle" style="border: 2px double #9027ac;height: 160px; width: 160px;">
                        </a>
                        </div>
                        <h3 style="font-family: 'Droid Arabic Kufi';">مكياج</h3>
                        <p class="description" style="font-family: 'Droid Arabic Kufi';">نخلق بك شخصية تلائم مناسباتك</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <a href="CoiffureView.php?id=8">
                            <img src="assets\ass\img\user-pic-2.jpg" alt="" class="img-circle" style="border: 2px double #9027ac;height: 160px; width: 160px;">
                        </a>
                        </div>
                        <h3 style="font-family: 'Droid Arabic Kufi';">تساريح شعر</h3>
                        <p class="description" style="font-family: 'Droid Arabic Kufi';">نود أن نقدم للعالم أعمالنا وأعمالكم لذلك نسعى نحو الأفصل</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-our-team-freebie">
        <div class="parallax filter filter-color-black">
            <div class="image" style="background-image:url('assets/ass/img/header-2.jpeg');"></div>
            <div class="container">
                    <div class="row">
                        <div class="title-area">
                            <h2 style="font-family: 'Droid Arabic Kufi'; color: white;">أفضل كوافيراتنا</h2>
                            <div class="separator separator-danger">✻</div>
                            <p class="description">نعدكم بمظهر جديد والأهم جمال فريد , وذلك بالتعرف عليك وعلى احتياجاتك لجعلك بمظهر لائق حسب الأفضل لك.</p>
                        </div>
                    </div>
                    <?php
                    $sql =  "SELECT * FROM users WHERE user_type = 'admin' order by rating LIMIT 3";
                    $res = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($res)) {
                        $username = $row['username'];
                        $coiffureid = $row['id'];

                    ?>
                <!-- member-1-start -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="team-block" style="text-align: -webkit-center;">
                        <div class="image-clients">
                            <a href="Coiffuresitem.php?id=<?php echo $coiffureid; ?>">
                            <img src= "images/admin_profile.png" alt="<?php echo $username; ?>" class="img-circle">
                        </a>
                        </div>
                        <div class="team-content mt20">
                            <a href="Coiffuresitem.php?id=<?php echo $coiffureid; ?>">
                            <h3 class="team-title"><?php echo $username; ?></h3>
                        </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
      <div class="section">
        <div class="container">
            <div class="row">
                <div class="title-area">
                    <h2 style="font-family: 'Droid Arabic Kufi';">أفضل أعمال الكوافيرات</h2>
                    <div class="separator separator-danger">✻</div>
                    <p class="description">بكم ننمو </p>
                </div>
            </div>
            <div class="row">
                 <?php
                $sqlitem = "SELECT *,(SELECT name FROM users WHERE id = user_id)As adminName from menus_items order by rating LIMIT 3";
                $resitem = mysqli_query($con,$sqlitem);
                while ($rowitem = mysqli_fetch_array($resitem)) {
                    $adminName = $rowitem['adminName'];
                    $item_img = $rowitem['item_image'];
                    $item_desc = $rowitem['item_description'];
                    $item_id = $rowitem['id'];
                     
                ?>

                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <a href="detailsitem.php?id=<?php echo $item_id; ?>">
                        <img src="images/<?php echo $item_img; ?>" alt="" class="img-circle" style="height: 160px; width: 160px; border: 2px double #9027ac;"></a>
                        </div>
                        <h3 style="font-family: 'Droid Arabic Kufi';"><?php echo $adminName.":"; ?>كوافير</h3>
                        <p class="description" style="font-family: 'Droid Arabic Kufi';"><?php echo $item_description; ?></p>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>

    <div class="section section-small section-get-started" style="z-index: 1;">
        <div class="parallax filter">
            <div class="image"
                style="background-image: url('assets/ass/img/office-1.jpeg')">
            </div>
            <div class="container">
                <div class="title-area">
                    <h2 class="text-white">هل ترغب بالعمل معنا ؟</h2>
                    <div class="separator line-separator">♦</div>
                    <p class="description">نحن حريصون على إنشاء بشرة ثانية لأي شخص لديه إحساس بالأناقة! نحن نقوم بعمل يليق بكم وأخد آرائكم بعين الاعتبار ، نبقى عند حسن ظنكم</p>
                </div>

                <div class="button-get-started">
                    <a href="contact-us.php" class="btn btn-danger btn-fill btn-lg">تواصل معنا</a>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
