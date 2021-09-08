<?php

include('conn.php');
include('head.php');
$user_id = $_SESSION['UserId'];

if (isset($_GET['id']))
{
  $id = $_GET['id'];
  $get_appointment = "select *, (SELECT name from sub_categories WHERE sub_categories.id = cat_id) As subcategoryName,(SELECT name from users where users.id = user_id) AS customer from appointment WHERE id = '$id'";

  $run_appointment = mysqli_query($con, $get_appointment);
  $row = mysqli_fetch_array($run_appointment);
  $customer_id=$row['user_id'];
  $customer = $row['customer'];
  $category = $row['subcategoryName'];
  $event_date = $row['event_date'];
  $adate = $row['adate'];
  $atime = $row['atime'];

}else{

  $customer = "";
  $category = "";
  $event_date = "";
  $adate = "";
  $atime = "";


}

if(isset($_POST["submit_btn"]))

{ 

  $btn_id = $_GET['id'];

  if($_POST['adate'] == "")
    {
      $adate = $row['adate'];

    }else{

      $adate = $_POST['adate'];
    }

     if($_POST['atime'] == "")
    {
      $atime = $row['atime'];

    }else{

      $atime = $_POST['atime'];
    }


  if($_POST['subcategory'] == "")
    {
      $category = $row['cat_id'];

    }else{

      $category = $_POST['subcategory'];
    }

    $event_date = $adate." ".$atime;

  $sql = "UPDATE appointment SET cat_id='$category', adate= '$adate', atime='$atime',event_date='$event_date' WHERE id = '$btn_id'" ;
  $res = mysqli_query($con , $sql);

  if($res){
    echo "<script>alert('تم تعديل الموعد')</script>";
    echo "<script>window.open('calender.php?','_self')</script>";

  }else {
    echo "Failed";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
</head>

<body >
 
      <div class="content">
        <div class="container-fluid">
          <div class="row">                    
            <div class="col-md-12">
              <div class="card ">
                <div class="card-header-primary card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">تعديل الموعد</h4>
                  </div>
                </div>
                <div class="card-body ">
                  <form method="post"  class="form-horizontal"  enctype="multipart/form-data">
                    <div class="row">
                      <label class="col-sm-2 col-form-label">الزبون</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="hidden" name="id" class="form-control">
                          <input type="text" name="customer" class="form-control" value="<?php echo $customer; ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">التاريخ</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="adate" class="form-control" value="<?php echo $adate; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">الوقت</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="atime" class="form-control" value="<?php echo $atime; ?>">
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row"> 
                      <label class="col-sm-2 col-form-label">التصنيف</label>      
                        <select name="subcategory" class="col-sm-2 btn btn-round text-left btn-primary" style="font-size: 14px;color: white;">
                          
                          <?php
                          
                            $run = mysqli_query($con,"SELECT appointment.cat_id,appointment.id,sub_categories.id,sub_categories.name FROM appointment INNER JOIN sub_categories ON appointment.cat_id = sub_categories.id WHERE appointment.id = '$id'");
                            $row = mysqli_fetch_array($run);
                          
                             $id = $row['id'];
                              
                             $Name = $row['name'];

                             $appointmentID = $row['cat_id'];
                           
                          ?>
                          
                          <option disabled selected style="color: white;" ><?php if ($id == $appointmentID) {echo $Name;} else echo "اختر تصنيف<";?></option>
                          
                          <?php

                            $run = mysqli_query($con,"SELECT id, name FROM sub_categories");

                            while($row = mysqli_fetch_array($run)){

                              $id = $row['id'];
                              $Name = $row['name'];
                          ?>                            

                            <option value= "<?php echo $id; ?>" >

                             <?php 
                            
                            echo $Name;
                            
                              }
                            
                            ?>     
                          
                            </option>
                          </select>
                        </div>
                        <br>
                        <button type="submit" name = "submit_btn" class="btn btn-fill btn-primary">تأكيد</button>
                      </div>
                    </div>
                </form>
            </div>
            <?php 
          if(isset($_POST['submit_btn'])){
              $query ="INSERT INTO `notifications` (`user_id`, `name`, `type`, `status`, `date`) VALUES ($customer_id, '$customer', 'comment','unread', CURRENT_TIMESTAMP)";
              if(performQuery($query)){
                  header("location:calender.php");
              }
          }
          ?>

        </div>
    </div>
</div>
<?php include('footer.php');?>
</div>
</div>
</body>
</html>