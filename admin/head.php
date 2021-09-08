<?php include('functions.php');
$user_id = $_SESSION['UserId']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Salonat</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Aref+Ruqaa" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet">
  <link href="../assets/css/material-dashboardv2.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
</head>

<body class="rtl">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="#eee" >
      
       <!-- Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag -->
      <div class="logo">
        <a href="../index.php" class="simple-text logo-mini"><b style="font-size:34px; font-style:oblique;font-family:cursive;color: #9027ac;">S</b>
        </a>
        <a href="../index.php" class="simple-text logo-normal" style="padding-right: 10px;"><b style="letter-spacing: -6px; font-size: 34px; font-style: oblique;  font-family: cursive;margin-left: 75px;color: #9027ac;">SALONAT</b>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="../images/admin_profile.png" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                <?php  if (isset($_SESSION['user'])) : ?>
                  <strong><?php echo $_SESSION['user']['username']; ?></strong>
                  <small><i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i></small>
                <?php endif ?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="Editprofile.php">
                    <span class="sidebar-mini"><i class="material-icons">face</i></span>
                    <span class="sidebar-normal">تعديل الملف الشخصي</span>
                  </a>
                </li>
                <!--<li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> EP </span>
                    <span class="sidebar-normal"> Edit Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> S </span>
                    <span class="sidebar-normal"> Settings </span>
                  </a>
                </li>-->
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <i class="material-icons">account_balance</i>
              <p>الرئيسية </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="menus.php"><i class="material-icons">table_chart</i>
              <p>القائمة</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="calender.php"><i class="material-icons">table_chart</i>
              <p>مواعيد الزبائن</p>
            </a>
          </li>
        </ul> 
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar --> 
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="menus.php">لوحة التحكم</a>
          </div>
         
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form" action="results_Search">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="ابحث...">
               <button type="submit" class="btn btn-white btn-round btn-just-icon" name="search">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item ">
                <a class="nav-link" href="menus.php">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com"id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <!-- <a class="nav-link" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  --><i class="material-icons">notifications</i>
                   <?php

                $query = "SELECT * from `notifications` where `status` = 'unread' and coiffure_id = $user_id order by `date` DESC";
                if(count(fetchAll($query))>0){
                ?>
                <span class="notification"><?php echo count(fetchAll($query)); ?></span>
              <?php
                }
                    ?>

                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="text-align: center;">
                  <?php
                $query = "SELECT * from `notifications` where coiffure_id = $user_id order by `date` DESC LIMIT 5";
                 if(count(fetchAll($query))>0){
                     foreach(fetchAll($query) as $i){
                ?>
              <a style ="
                         <?php
                            if($i['status']=='unread'){
                                echo "font-weight:bold;";
                            }
                         ?>
                         " class="dropdown-item" href="calender.php?id=<?php echo $i['id'] ?>">
                <small><i><?php
                 date_default_timezone_set("Asia/Gaza");
                 echo date('F j, Y, g:i a',strtotime($i['date'])) ?></i></small><br/>
                  <?php
                if($i['type']=='comment'){
                    echo "تم حجز موعد جديد معك";
                }else if($i['type']=='like'){
                    echo "تم حذف موعد ";
                }
                  
                  ?>
                </a>
              <div class="dropdown-divider"></div>
                <?php
                     }
                 }else{
                     echo "لا يوجد مواعيد محجوزة";
                 }
                     ?>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="Editprofile.php">تعديل الملف الشخصي</a>
                  
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href = '../logout.php'>تسجيل خروج</a>
                  <!--<a class="dropdown-item" href = 'logout.php'>Log out</a>-->
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- Core JS Files   -->
 <script src="../assets/js/core/jquery.min.js"></script>
 <script src="../assets/js/core/popper.min.js"></script>
 <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
 <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
 <!-- Plugin for the momentJs  -->
 <script src="../assets/js/plugins/moment.min.js"></script>
 <!--  Plugin for Sweet Alert -->
 <script src="../assets/js/plugins/sweetalert2.js"></script>
 <!-- Forms Validations Plugin -->
 <script src="../assets/js/plugins/jquery.validate.min.js"></script>
 <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
 <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
 <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
 <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
 <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
 <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
 <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
 <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
 <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
 <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
 <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
 <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
 <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
 <script src="../assets/js/plugins/fullcalendar.min.js"></script>
 <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
 <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
 <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
 <script src="../assets/js/plugins/nouislider.min.js"></script>
 <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
 <!-- Library for adding dinamically elements -->
 <script src="../assets/js/plugins/arrive.min.js"></script>
 <!--  Google Maps Plugin    -->
 <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
 <!-- Chartist JS -->
 <script src="../assets/js/plugins/chartist.min.js"></script>
 <!--  Notifications Plugin    -->
 <script src="../assets/js/plugins/bootstrap-notify.js"></script>
 <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="../assets/js/material-dashboardv2.js" type="text/javascript"></script>
 <!-- Material Dashboard DEMO methods, don't include it in your project! -->
 <script>
   $(document).ready(function() {
 $('#datatables').DataTable({
       "pagingType": "full_numbers",
       "lengthMenu": [
         [10, 25, 50, -1],
         [10, 25, 50, "All"]
       ],
       responsive: true,
       language: {
           "lengthMenu": "عرض _MENU_",
           "zeroRecords": "لا يوجد بيانات لعرضها",
           "info": "عرض صفحة _PAGE_ من _PAGES_",
           "infoEmpty": "لا يوجد بيانات لعرضها",
     "sSearch": "بحث",
           "infoFiltered": "(فلترة من _MAX_ الاجمالي)",
      "paginate": {
       "previous": "السابق",
       "next": "التالي",
       "first": "الاول",
       "last": "الاخير"
     }
       }
     });

     var table = $('#datatable').DataTable();

     // Edit record
     table.on('click', '.edit', function() {
       $tr = $(this).closest('tr');
       var data = table.row($tr).data();
       alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
     });

     // Delete a record
     table.on('click', '.remove', function(e) {
       $tr = $(this).closest('tr');
       table.row($tr).remove().draw();
       e.preventDefault();
     });
     $().ready(function() {
       $sidebar = $('.sidebar');

       $sidebar_img_container = $sidebar.find('.sidebar-background');

       $full_page = $('.full-page');

       $sidebar_responsive = $('body > .navbar-collapse');

       window_width = $(window).width();

       fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

       if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
         if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
           $('.fixed-plugin .dropdown').addClass('open');
         }

       }

       $('.fixed-plugin a').click(function(event) {
         // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
         if ($(this).hasClass('switch-trigger')) {
           if (event.stopPropagation) {
             event.stopPropagation();
           } else if (window.event) {
             window.event.cancelBubble = true;
           }
         }
       });

       $('.fixed-plugin .active-color span').click(function() {
         $full_page_background = $('.full-page-background');

         $(this).siblings().removeClass('active');
         $(this).addClass('active');

         var new_color = $(this).data('color');

         if ($sidebar.length != 0) {
           $sidebar.attr('data-color', new_color);
         }

         if ($full_page.length != 0) {
           $full_page.attr('filter-color', new_color);
         }

         if ($sidebar_responsive.length != 0) {
           $sidebar_responsive.attr('data-color', new_color);
         }
       });

       $('.fixed-plugin .background-color .badge').click(function() {
         $(this).siblings().removeClass('active');
         $(this).addClass('active');

         var new_color = $(this).data('background-color');

         if ($sidebar.length != 0) {
           $sidebar.attr('data-background-color', new_color);
         }
       });

       $('.fixed-plugin .img-holder').click(function() {
         $full_page_background = $('.full-page-background');

         $(this).parent('li').siblings().removeClass('active');
         $(this).parent('li').addClass('active');


         var new_image = $(this).find("img").attr('src');

         if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
           $sidebar_img_container.fadeOut('fast', function() {
             $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
             $sidebar_img_container.fadeIn('fast');
           });
         }

         if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
           var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

           $full_page_background.fadeOut('fast', function() {
             $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
             $full_page_background.fadeIn('fast');
           });
         }

         if ($('.switch-sidebar-image input:checked').length == 0) {
           var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
           var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

           $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
           $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
         }

         if ($sidebar_responsive.length != 0) {
           $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
         }
       });

       $('.switch-sidebar-image input').change(function() {
         $full_page_background = $('.full-page-background');

         $input = $(this);

         if ($input.is(':checked')) {
           if ($sidebar_img_container.length != 0) {
             $sidebar_img_container.fadeIn('fast');
             $sidebar.attr('data-image', '#');
           }

           if ($full_page_background.length != 0) {
             $full_page_background.fadeIn('fast');
             $full_page.attr('data-image', '#');
           }

           background_image = true;
         } else {
           if ($sidebar_img_container.length != 0) {
             $sidebar.removeAttr('data-image');
             $sidebar_img_container.fadeOut('fast');
           }

           if ($full_page_background.length != 0) {
             $full_page.removeAttr('data-image', '#');
             $full_page_background.fadeOut('fast');
           }

           background_image = false;
         }
       });

       $('.switch-sidebar-mini input').change(function() {
         $body = $('body');

         $input = $(this);

         if (md.misc.sidebar_mini_active == true) {
           $('body').removeClass('sidebar-mini');
           md.misc.sidebar_mini_active = false;

           $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

         } else {

           $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

           setTimeout(function() {
             $('body').addClass('sidebar-mini');

             md.misc.sidebar_mini_active = true;
           }, 300);
         }

         // we simulate the window Resize so the charts will get updated in realtime.
         var simulateWindowResize = setInterval(function() {
           window.dispatchEvent(new Event('resize'));
         }, 180);

         // we stop the simulation of Window Resize after the animations are completed
         setTimeout(function() {
           clearInterval(simulateWindowResize);
         }, 1000);

       });
     });
   });
 </script>
 <script>
   $(document).ready(function() {
     // initialise Datetimepicker and Sliders
     md.initFormExtendedDatetimepickers();
     if ($('.slider').length != 0) {
       md.initSliders();
     }
   });
 </script>
</body>

</html>