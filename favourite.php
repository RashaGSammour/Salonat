<?php
include('functions.php');
include('conn.php');
include('header1.php');

$user_id = $_SESSION['UserId'];

if (isset($_GET['deleted_id']))
    {
        $id = $_GET['deleted_id'];

        // delete the entry

        $result = mysqli_query($con,"DELETE FROM favourite WHERE id='$id'") or die(mysql_error());
    }   

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body data-anchor="body">
        <div class="all-wrapper">

            <div class="main-contents gray-bg mini-50">
                <div class="container">
                    <div class="row grid salons-filter">
                        <?php
                        $sq = "SELECT * from favourite WHERE user_id = $user_id";
                        $re = mysqli_query($con,$sq);
                        if($re) $num_rows = mysqli_num_rows($re);
                        
                        if ($num_rows == 0 ) echo "<h3 style = 'text-align:center;margin-bottom:100px;margin-top:20px;'> لا يوجد عناصر في المفضلة<//h3>" ?>
                        <div class="col-md-12 grid-item mix">
                            <?php
                                
                                $sql = "SELECT * from favourite WHERE user_id = $user_id and favorite_status = '1'";
                                if(mysqli_query($con,$sql)){
                                    $sqlitems = "SELECT favourite.id,favourite.item_id As item_id,favourite.itemuser,menus_items.id,menus_items.item_name,menus_items.item_sub_category,menus_items.rating,menus_items.item_image,menus_items.item_price,sub_categories.name As categoryName,sub_categories.id FROM menus_items INNER JOIN favourite ON favourite.item_id = menus_items.id INNER JOIN sub_categories ON menus_items.item_sub_category=sub_categories.id WHERE favourite.user_id = $user_id order by favourite.id";
                                    $resitems = mysqli_query($con,$sqlitems);
                                    while ($rowitems = mysqli_fetch_array($resitems)){
                                        $item_id = $rowitems['item_id'];
                                        $name = $rowitems['item_name'];
                                        $price = $rowitems['item_price'];
                                        $rating = $rowitems['rating'];
                                        $sub_category = $rowitems['categoryName'];
                                        $image = $rowitems['item_image'];
                                        $itemuser = $rowitems['itemuser'];
                                        ?>                                  
                            <div class="salon-hr">
                                
                                <div class="main-info col-md-9">
                                    <div class="media-holder">
                                        <a href="detailsitem.php?id=<?php echo $item_id; ?>" title="<?php echo $name ?>" class="focuspoint">
                                            <img src="images/<?php echo $image; ?>" alt="IMAGE">
                                        </a>
                                    </div>
                                    <div class="over-contents">
                                        <h3 class="title"><a href="detailsitem.php?<?php echo $item_id; ?>"><?php echo $name; ?></a></h3>
                                        <?php if($rating == 1){ ?>
                                        <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php }else if ($rating == 2) { ?>
                                            <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php }else if ($rating == 3) { ?>
                                            <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php }else if ($rating == 4) { ?>
                                            <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php }else if ($rating == 5) { ?>
                                            <div class="rating" style="text-align: center;">
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                            <a href="#" class="active"><i class="icon-star"></i></a>
                                        </div><?php }else{ ?>
                                            <div class="rating" style="text-align: center;">
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                            <a href="#"><i class="icon-star"></i></a>
                                        </div><?php } ?>

                                        <a href="favourite.php?deleted_id=<?php echo $item_id; ?>" id="deletebtn" onclick="return confirm('هل انت متأكد من الحذف؟')" rel="tooltip" name="deleted_id" value="delete" class="btn btn-danger" style = "margin-left: 150px;background-color: red;color: white;">
                                            أزل من المفضلة</a>
                                    </div>
                                </div>
                                <div class="col-md-3 more-details">
                                    <div class="pull-left status-charge">
                                        <div class="box time">
                                            <span class="top">التصنيف</span>
                                            <span class="des"><?php echo $sub_category; ?></span>
                                        </div>
                                        <div class="box">
                                            <span class="top">السعر</span>
                                            <span class="des"><?php echo $price; ?></span>
                                        </div>
                                    </div>
                                    <div class="pull-left">
                                        <a href="detailsitem.php?<?php echo $item_id; ?>" class="more"><i class="icon-right-open-big"></i></a>
                                    </div> 
                                </div>

                            </div>
                            <?php } } ?>

                        </div>
            </div><!-- end of main contents -->
        </div><!-- end of all wrapper -->
        <?php include('footer.php'); ?>
    </body>
</html>