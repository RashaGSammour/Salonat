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

    $get_user = "select * from users where id = '$id'";

    $run_user = mysqli_query($con, $get_user);

    $row = mysqli_fetch_assoc($run_user);

    $name = $row['name'];

}

?>
<!DOCTYPE html>
<html>
<body>

    <nav aria-label="breadcrumb" role="navigation" style="margin-top: 20px;">
        <ol class="breadcrumb" style="background-color: #9027ac;text-align: center;width: 100%;height: 80px;">
            <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff; font-size: 30px; letter-spacing: 2px;margin: 10px -25px 10px -25px;">
                <a style="font-size: 30px;opacity: 1.7;" href="Coiffuresitem.php?id=<?php echo $id ?>"><b><strong style="color: #ffffff;"> <?php echo $name; ?></strong></b></a>
            </li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">

            <?php

            $get_menus = "select *,(SELECT Ar_name from categories where categories.id = item_category) AS categoryName,(SELECT name from sub_categories where sub_categories.id = item_sub_category) AS subcategoryName from menus_items where user_id = '$id' order by id desc";

            $run_menus = mysqli_query($con, $get_menus);

            while ($row = mysqli_fetch_array($run_menus)) {

                $id = $row['id'];
                $name = $row['item_name'];
                $price = $row['item_price'];
                $image = $row['item_image'];
                $category = $row['categoryName'];
                $sub_category = $row['subcategoryName'];
                $description = $row['item_description'];

            ?>

            <div class="col-md-3" style="float: right; width: 25%; margin-bottom: 30px;">
                <div class="info-icon">
                    <div class="icon text-danger">
                        <a href="detailsitem.php?id=<?php echo $id; ?>">
                            <img src="images/<?php echo $image; ?>" style="height: 220px; width: 220px; border: 2px double #9027ac; text-align: right;" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                        </a>
                    </div>
                    <h3 style="font-family: 'Droid Arabic Kufi';"><?php echo $category; ?></h3>
                    <p class="description" style="font-family: 'Droid Arabic Kufi';"><?php echo $sub_category; ?></p>
                </div>
            </div>
            <?php } ?>

        </div>
        <!--<nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <span class="page-link">السابق</span>
                </li>
                <li class="page-item-primary"><a class="page-link-primary" href="#">1</a></li>
                <li class="page-item-primary active">
                    <span class="page-link-primary">2
                        <span class="sr-only">(current)</span>
                    </span>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">التالي</a>
                </li>
            </ul>
        </nav>-->
    </div>

    <?php include('footer.php'); ?>

</body>
<!--   core js files    -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.js" type="text/javascript"></script>

<!--  js library for devices recognition -->
<script type="text/javascript" src="assets/js/modernizr.js"></script>

<!--  script for google maps   -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!--   file where we handle all the script from the Gaia - Bootstrap Template   -->
<script type="text/javascript" src="assets/js/gaia.js"></script>
<!-- SHINE PROJECT-->
<script src="js/jquery.min.js" type="text/javascript"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

</html>