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
?>
<!DOCTYPE html>
<html lang="ar">
    <head>
        <link rel="shortcut icon" href="assets/salonatcom/images/favico.ico">
        <link rel="stylesheet" type="text/css" href="assets/salonatcom/style.css">
        <link rel="stylesheet" type="text/css" href="assets/salonatcom/css/en.css">
    </head>
    <body>
        <div class="page-info accent-bg" style="background-color: #eee;">
            <div class="container">
                <h1 class="title" style="font-family: monospace; color: #9027ac;text-align: center;">نتائج البحث</h1>
                <div class="filters" style="margin-left: 245px; ">
                    <div class="row">
                         <div class="col-md-3">
                            <div class="search">
                                    <ul>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" style = "display: flex;">
                                            <button style="background-color: transparent;" type="submit"><i class="icon-search" style="color: #9027ac;" ></i></button>
                                            <input type="search" name="search" placeholder="ابحث">
                                        </form>
                                    </ul>
                                </div>   
                            </div>
                             <div class="col-md-3 sort-by">
                            <div class="mutliSelect-wrapper">
                                <div class="dt">
                                    <a href="#">    
                                        <p class="multiSel"></p>
                                        <span class="hida" style="font-size: 18px;margin-left: 65px;">ترتيب حسب</span>
                                    </a>
                                </div>
                                <div class="dd ">
                                    <div class="mutliSelect">
                                        <ul>
                                            <li>
                                                <ul class="filter-group checkboxes">

                                                    <li style="background-color: #ac63c0; color: white; width: 100%; font-size: 18px;font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif; padding: 0px 0px !important; text-align: center; cursor: pointer;" class="sort active" data-sort="default" data-order="default">جميع العناصر</li>
                                                    <li style="background-color: #ac63c0; color: white; width: 100%; font-size: 18px;font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif; padding: 0px 0px !important; text-align: center; cursor: pointer;" class="sort" data-sort="name:asc">الاسم</li>
                                                    <li style="background-color: #ac63c0; color: white; width: 100%; font-size: 18px;font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif; padding: 0px 0px !important; text-align: center; cursor: pointer;" class="sort" data-sort="rating:des">التقييم</li>
                                                    <li style="background-color: #ac63c0; color: white; width: 100%; font-size: 18px;font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif; padding: 0px 0px !important; text-align: center; cursor: pointer;" class="sort" data-sort="price:asc">السعر</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-3">
                            <div class="mutliSelect-wrapper">
                            <div class="dt">
                                <a href="#">
                                    <p class="multiSel"></p>
                                    <span class="hida" style="margin-left: 85px;font-size: 18px;">المنطقة</span>
                                </a>
                            </div>
                            <div class="dd">
                                <div class="mutliSelect">
                                    <ul>
                                        <li>
                                            <ul class="filter-group checkboxes">
                                                <li><input type="checkbox" data-filter=".kuwait" id="kuwait" data-value="غزة"><label for="kuwait">غزة</label></li>
                                                <li><input type="checkbox" data-filter=".dasman" id="dasman" data-value="خانيونس"><label for="dasman">خانيونس</label></li>
                                                <li><input type="checkbox" data-filter=".visa" id="visa" data-value="رفح"><label for="visa">رفح</label></li>
                                                <li><input type="checkbox" data-filter=".master" id="master" data-value="جباليا"><label for="master">جباليا</label></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-contents gray-bg mini-50">
                <div class="container">
                    <div class="row grid salons-filter">
                        <div class="fail-message"><span>لا يوجد عناصر تطابق عملية البحث</span></div>
                         <?php 

                         if(isset($_GET['search'])){

                            $search_query = $_GET['user_search'];

                            $get_menus = "select *,(SELECT Ar_name from categories where categories.id = item_category) AS categoryName,(SELECT city from users where users.id = user_id) AS cityName from menus_items where item_name like '%$search_query%' order by id desc";

                            $run_menus = mysqli_query($con, $get_menus);

                            while($row = mysqli_fetch_array($run_menus)){

                                $id = $row['id']; 
                                $name = $row['item_name'];
                                $price = $row['item_price'];
                                $image = $row['item_image'];
                                $category = $row['categoryName'];
                                $description = $row['item_description'];
                                $rating = $row['rating']; 
                                $city = $row['cityName'];                              
                        ?>
                        <div class="col-md-12 grid-item mix <?php if($city == 'غزة')echo kuwait;elseif($city == 'خانيونس')echo dasman;elseif($city=='رفح')echo visa; elseif($city == 'جباليا')echo master; else echo " ";  ?>" data-name = "<?php echo $name; ?>" data-price = "<?php echo $price; ?>" data-rating = "<?php echo $rating; ?>">
                            <div class="salon-hr">
                                <div class="col-md-3 more-details">
                                    <div class="pull-left status-charge">
                                        <div class="box time">
                                            <span class="top"><?php echo $category; ?></span>
                                        </div>
                                        <div class="box">
                                            <span class="top" >السعر</span>
                                            <span class="des">
                                                <?php echo $price;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="pull-left">
                                        <a href="detailsitem.php?id=<?php echo $id; ?>" class="more"><i class="icon-right-open-big"></i></a>
                                    </div> 
                                </div>
                                <div class="main-info col-md-9">
                                    <div class="media-holder">
                                        <a href="detailsitem.php?id=<?php echo $id; ?>" title="<?php echo $name ?>" class="focuspoint">
                                            <?php echo '<img src="images/'.$image.'" alt="'.$name.'"/>';?>              
                                        </a>
                                    </div>
                                    <div class="over-contents">
                                        <div class="col-md-12 " style="padding-bottom: 40px; padding-top: 40px;">
                                        <h3 class="title"><a href="detailsitem.php?id= <?php echo $id;?>"><b><?php echo $name; ?></b></a></h3>
                                    </div>
                                     <?php if($rating == 1){ ?>
                                        <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><? } ?>
                                        <?php if($rating == 2){ ?>
                                        <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><? } ?>
                                        <?php if($rating == 3){ ?>
                                        <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><? } ?>
                                        <?php if($rating == 4){ ?>
                                        <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><? } ?>
                                        <?php if($rating == 5){ ?>
                                        <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                        </div><? }if($rating == null){ ?>
                                        <div class="rating" style="text-align: center;">
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><? } ?>
                                        <div style="text-align: center;">
                                        <p><?php echo $description; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } 
                        }

                            $whr = "";

                            if(isset($_GET['category'])){

                                $category = $_GET['category'];

                                if($category != "" && !strcasecmp($category,"مكياج")){

                                    $whr .= " AND item_category = 4 ";
                                }
                                elseif($category != "" && !strcasecmp($category,'تصفيف شعر')){

                                    $whr .= " AND item_category = 6 ";
                                }

                                $get_category = "select *,(SELECT Ar_name from categories where categories.id = item_category) AS categoryName from menus_items WHERE 1=1 $whr order by id desc";

                                $run_category = mysqli_query($con, $get_category);

                                while ($row = mysqli_fetch_array($run_category)){

                                $categoryID = $row['item_category'];
                                $id = $row['id']; 
                                $name = $row['item_name'];
                                $price = $row['item_price'];
                                $image = $row['item_image'];
                                $category = $row['categoryName'];
                                $description = $row['item_description'];

                                ?>

                                    <div class="col-md-12 grid-item mix kuwait visa opened" data-rating="3">
                            <div class="salon-hr">
                                <div class="col-md-3 more-details">
                                    <div class="pull-left status-charge">
                                        <div class="box time">
                                            <span class="top"><?php echo $category; ?></span>
                                        </div>
                                        <div class="box">
                                            <span class="top" >أفضل سعر</span>
                                            <span class="des">
                                                <?php echo $price;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="pull-left">
                                        <a href="detailsitem.php?id = <?php echo $id; ?>" class="more"><i class="icon-right-open-big"></i></a>
                                    </div> 
                                </div>
                                <div class="main-info col-md-9">
                                    <div class="media-holder">
                                        <a href="detailsitem.php?id = <?php echo $id; ?>" title="<?php echo $name ?>" class="focuspoint">
                                            <?php echo '<img src="images/'.$image.'" alt="'.$name.'"/>';?>              
                                        </a>
                                    </div>
                                    <div class="over-contents">
                                        <div class="col-md-12 " style="padding-bottom: 40px; padding-top: 40px;">
                                        <h3 class="title"><a href="detailsitem.php?id = <?php echo $id; ?>"><b><?php echo $name; ?></b></a></h3>
                                    </div>
                                        <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div>
                                        <div style="text-align: center;">
                                        <p><?php echo $description; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            }
                        }
                    ?>
                </div>
            </div><!-- end of main contents -->
        </div><!-- end of all wrapper -->

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