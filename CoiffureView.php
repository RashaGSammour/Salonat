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

if(isset($_GET['id']))

{

    $id = $_GET['id'];

    $get_cat = "select * from categories where id = '$id' ";

    $run_cat = mysqli_query($con, $get_cat);

    $row = mysqli_fetch_assoc($run_cat);

    $category = $row['Ar_name'];

}

?>
<!DOCTYPE html>
<html>
<body>

    <nav aria-label="breadcrumb" role="navigation" style="margin-top: 20px;">
        <ol class="breadcrumb" style="background-color: #9027ac;text-align: center;width: 100%;height: 80px;">
            <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff; font-size: 30px; letter-spacing: 2px;margin: 10px -25px 10px -25px;">
                <a style="font-size: 30px; opacity: 1.7;" href="CoiffureView.php?id=<?php echo $id ?>"><b><strong style="color: #ffffff"> <?php echo $category; ?></strong></b></a>
            </li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <?php

            $get_sub_cat = "SELECT * FROM sub_categories WHERE cat_id = $id";

            $run_sub_cat = mysqli_query($con,$get_sub_cat);

            while ($row_sub_cat = mysqli_fetch_array($run_sub_cat)){

            $sub_category = $row_sub_cat['name'];

            $id_sub_cat = $row_sub_cat['id'];

            ?>
            
            <ol class="breadcrumb" style="clear: both; width: 1110px; margin-left: 30px; text-align: right;">
                <li class="breadcrumb-item active" aria-current="page" style="color: #9027ac; font-size: 20px;"><a style="font-size: 20px;" href="subCoiffureView.php?id=<?php echo $id_sub_cat ?>"><b> <?php echo $sub_category; ?> </b></a>
                </li>
            </ol>

            <?php

            $get_menus = "select * from menus_items where item_category = $id AND item_sub_category = $id_sub_cat order by id desc";

            $run_menus = mysqli_query($con, $get_menus);

            while ($row = mysqli_fetch_array($run_menus)) {

                $item_id = $row['id'];
                $name = $row['item_name'];
                $price = $row['item_price'];
                $image = $row['item_image'];
                $category = $row['item_category'];
                $description = $row['item_description'];

            ?>
            <div class="row col-md-3"style="float:right">
                
                        <a href="detailsitem.php?id=<?php echo $item_id; ?>">
                            
                            <img src="images/<?php echo $image; ?>" style="clear: both; height: 220px; width: 220px; border: 2px double #9027ac;" alt="<?php echo $name; ?>"/>
                        
                        </a>
                    <h3 style="font-family: 'Droid Arabic Kufi';text-align: center"><?php echo $name; ?></h3>
                    <h5 style="font-family: 'Droid Arabic Kufi';text-align: center"><?php echo $description; ?></h5>
        </div>
        <?php } } ?>
        </div>
    </div>
    <?php include('footer.php'); ?>

</body>
</html>