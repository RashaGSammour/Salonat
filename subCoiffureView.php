<?php
include('functions.php');

    if (!isLoggedIn()) {
        include('header.php');
    }else {
        include('header1.php');
    }
    $user_id = $_SESSION['UserId'];

include('conn.php');

if(isset($_GET['id']))

{

    $id = $_GET['id'];

    $get_cat = "select * from sub_categories where id = '$id' ";

    $run_cat = mysqli_query($con, $get_cat);

    $row = mysqli_fetch_assoc($run_cat);

    $sub_category = $row['name'];

}

?>
<!DOCTYPE html>
<html>
<body>

    <nav aria-label="breadcrumb" role="navigation" style="margin-top: 20px;">
        <ol class="breadcrumb" style="background-color: #9027ac;text-align: center;width: 100%;height: 80px;">
            <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff; font-size: 30px; letter-spacing: 2px;margin: 10px -25px 10px -25px;">
                <a style="font-size: 30px;opacity: 1.7;" href="subCoiffureView.php?id=<?php echo $id ?>"><b><strong style="color: #ffffff"> <?php echo $sub_category; ?></strong></b></a>
            </li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            
            <?php

            $get_menus = "select * from menus_items where item_sub_category = $id ";

            $run_menus = mysqli_query($con, $get_menus);

            while ($row = mysqli_fetch_array($run_menus)) {

                $item_id = $row['id'];
                $name = $row['item_name'];
                $price = $row['item_price'];
                $image = $row['item_image'];
                $category = $row['item_category'];
                $description = $row['item_description'];

            ?>

            <div class="col-md-3" style="float: right; width: 25%; margin-bottom: 30px;">
                <div class="info-icon">
                    <div class="icon text-danger">
                        <a href="detailsitem.php?id=<?php echo $item_id; ?>">
                            <img src="images/<?php echo $image; ?>" style="height: 220px; width: 220px; border: 2px double #9027ac; text-align: right;" alt="<?php echo $name; ?>"/>
                        </a>
                    </div>
                    <h3 style="font-family: 'Droid Arabic Kufi';"><?php echo $name; ?></h3>
                    <p class="description" style="font-family: 'Droid Arabic Kufi';"><?php echo $description; ?></p>
                </div>
            </div>

            <?php }  ?>

        </div>
    </div>

    <?php include('footer.php'); ?>

</body>

</html>