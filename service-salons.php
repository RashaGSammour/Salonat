<?php
include('functions.php');

    if (!isLoggedIn()) {
        include('header.php');
    }else {
        include('header1.php');
    }
    $user_id = $_SESSION['UserId'];
?>
<?php include("conn.php");?>
<!DOCTYPE html>
<html>
<body>

    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb" style="background-color: #9027ac;text-align: center;width: 100%;height: 80px;">
            <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff; font-size: 30px; letter-spacing: 2px;margin: 10px -25px 10px -25px;">
                <a style="font-size: 30px; opacity: 1.7;" href="CoiffureView.php"><b><strong style="color: #ffffff">خدمات الصالونات</strong></b></a>
            </li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <?php

            $get_cat = "SELECT * FROM categories";

            $run_cat = mysqli_query($con,$get_cat);

            while ($row_cat = mysqli_fetch_array($run_cat)){

            $category = $row_cat['Ar_name'];

            $id_cat = $row_cat['id'];

            ?>
            
            <ol class="breadcrumb" style="clear: both; width: 1110px; margin-left: 30px; text-align: right;">
                <li class="breadcrumb-item active" aria-current="page" style="color: #9027ac; font-size: 20px;"><a style="font-size: 20px;" href="CoiffureView.php?id=<?php echo $id_cat ?>"><b> <?php echo $category; ?> </b></a>
                </li>
            </ol>

            <?php

            $get_menus = "select * from menus_items where item_category = $id_cat order by item_category asc";

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