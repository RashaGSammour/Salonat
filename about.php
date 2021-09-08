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
<html>
<body>

    <nav aria-label="breadcrumb" role="navigation" style="margin-top: 20px;">
        <ol class="breadcrumb" style="background-color: #9027ac;text-align: center;width: 100%;height: 80px;">
            <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff; font-size: 30px; letter-spacing: 2px;margin: 10px -25px 10px -25px;">
                <b><strong style="color: #ffffff;">من نحن</strong></b>
            </li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-9" style="float: left;">
              <div style="background-color: white;">
              <p style="font-size: large;font-family: 'Droid Arabic Kufi';color: #9027ac;margin-top: 10px;">
                إن صالوناتكم دوت كوم هي شركة تعمل بموجب قوانين دولة الكويت، ويقع مقرها المُسجل في شارع أحمد الجابر، مدينة الكويت، ص. ب. رقم 21600 الصفاة 13079 الكويت. صالوناتكم توفر منصة سهلة وسريعة الاستخدام لحجز مواعيد الصالونات عبر الإنترنت. كما تسمح لمستخدميها، السيدات والسادة، البحث عن توفر مواعيد في الصالونات أو سبا وحجزمواعيدهم  المقبلة بسهولة النقرعلى زر. 

  صالوناتكم يوفر أيضا خدمة حجز مواعيد خدمة منازل  وبذلك يوفر على المستخدمين الوقت والجهد الثمينين .

على منصة صالوناتكم يمكن للزوار اكتشاف صالونات أو معاهد صحية والاستمتاع بتجربة جمالية فريدة من نوعها! كما يمكن للزوار مقارنة الأسعار، وتحديد الخدمات المطلوبة بعدد قليل من النقرات ويوفر امكانية الدفع عبر الإنترنت أو الدفع في صالون.

بعد الانتهاء من الحجز، سوف يرسل صالوناتكم تأكيداً فورياً عن طريق البريد الإلكتروني. كما يوفر صالوناتكم خدمة عملاء ودية مخصصة للمساعدة بأي طريقة ممكنة.

حجز المواعيد في الصالون هو فقط أحد الأشياء التي يمكنك القيام بها على تطبيق صالوناتكم والموقع. صالوناتكم يبقيك مضطلعا على أحدث صيحات الجمال من خلال مدونة موقعنا و النشرة البريدية.

مهمتنا هي أن تصبح منصة صالوناتكم المحطة الوحيدة لحجز المواعيد في الصالون والسبا على الانترنت  24/7 على شبكة الإنترنت.
              </p>
               
            </div><br>
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
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>