<?php
include('functions.php');
include('header1.php');
$user_id = $_SESSION['UserId'];
include("conn.php");

$id = $_GET['id'];

  $query ="UPDATE `notifications` SET `status` = 'read' WHERE `id` = $id;";
  performQuery($query);

?>
<!DOCTYPE html>
<html>
<body>

    <div class="container">
        <div class="row">
            <br>
            <?php
            $query = "SELECT * from `notifications` where `user_id` = '$user_id';";
            if(count(fetchAll($query))>0){
                foreach(fetchAll($query) as $i){
                    
            ?>
            <ol class="breadcrumb" style="width: 1110px; margin-left: 30px; text-align: right;background-color: white;">
                <li class="breadcrumb-item active" aria-current="page" style="color: #9027ac; font-size: 20px;"><b> <?php if($i['type']=='like'){
                        echo "تم حذف موعدك "." ".$i['date'];
                    }else{
                        echo "تم تعديل موعدك"." ".$i['date'];
                    } ?> </b>
                </li>
            </ol>
        <?php } } ?>
        </div>
    </div>
    <?php include('footer.php'); ?>

</body>
</html>