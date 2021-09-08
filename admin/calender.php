<?php
  include("conn.php");
  include("head.php");

  $id = $_GET['id'];

  $query ="UPDATE `notifications` SET `status` = 'read' WHERE `id` = $id;";
  performQuery($query);

  if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
  }

  if (isset($_GET['deleted_id']))
    {
      $id = $_GET['deleted_id'];

      // delete the entry

      $result = mysqli_query($con,"DELETE FROM appointment WHERE id='$id'") or die(mysql_error());

     }
       
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
  </head>
    <body class="rtl">
      <div class="content">
		<div class="container-fluid">


      <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
            <span style="text-align: center;">
                <b> Success - </b>
            
            <?php
              echo $_SESSION['success'];
              unset($_SESSION['success']);
            ?></span>
        </div>
        <?php endif ?>


          <div class="row">
          	 <div class="col-md-12">
              <form id="TypeValidation" class="form-horizontal" method="POST" action = "<?php $_PHP_SELF ?>">
                <div class="card ">
                  <div class="card-header-primary card-header-text">
                    <div class="card-text">
                      <h4 class="card-title">مواعيد الزبائن</h4>
                    </div>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                  <tr>
                    <th>الاسم</th>
								    <th>الخدمة</th>
                    <th>الهاتف</th>
                    <th>الموعد</th>
                    <th class="text-center">خيارات</th>
                  </tr>
                </thead>
                <tbody>
						<?php

            $user_id = $_SESSION['UserId'];

            $get_appointment = "SELECT *, (SELECT name from sub_categories where sub_categories.id = appointment.cat_id) AS sub_categoryName,(SELECT name from users where users.id = user_id) AS customer,(SELECT mobile from users where users.id = user_id) AS phone from appointment where coiffure_id = $user_id order by id desc";

            $run_appointment = mysqli_query($con, $get_appointment);
        
            while ($row = mysqli_fetch_array($run_appointment)){

              $customer_id = $row['user_id'];
              $id = $row['id'];  
              $date = $row['event_date'];
              $customer = $row['customer'];
              $phone = $row['phone'];
              $category = $row['sub_categoryName'];
            ?> 
              <tr>
                <td><?php echo $customer; ?></td>
								<td><?php echo $category; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $date; ?></td>

                <td class="td-actions text-center simulateWindowResize">           
                  <a href="Editappointment.php?id=<?php echo $row["id"]; ?>"  id="editbtn" rel="tooltip" class="btn btn-success" name="id">
                      <i class="material-icons">edit</i>
                  </a>
                  <?php 
                  if(isset($_GET['deleted_id'])){
                    $query ="INSERT INTO `notifications` (`user_id`, `name`, `type`, `status`, `date`) VALUES ($customer_id, '$customer', 'like','unread', CURRENT_TIMESTAMP)";
                    if(performQuery($query)){
                      //echo "<script>window.open('calender.php');</script>";
                    }
                  }
                  ?>
                  <a href="calender.php?deleted_id=<?php echo $row["id"]; ?>" id="deletebtn" onclick="return confirm('هل انت متأكد من الحذف؟')" rel="tooltip" name="deleted_id" value="delete" class="btn btn-danger">
                  <i class="material-icons">close</i>
                  </a>  

                </td>                
                
              </tr>
	          <?php } ?>
		      </tbody>
           </table>
             </div>
               </div>
                 </div>
                  </div>
<!----------------------------------------------------------->
</div>
</form>
</div>
</div>
<?php include('footer.php') ?>
</div>
</div>

</body>

</html>