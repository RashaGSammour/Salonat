<?php
  include("conn.php");
  //include('functions.php');
  include("head.php"); 
  $user_id = $_SESSION['UserId'];
  if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
  }

  if (isset($_GET['deleted_id']))
    {
      $id = $_GET['deleted_id'];

      // delete the entry

      $result = mysqli_query($con,"DELETE FROM menus_items WHERE id='$id'") or die(mysql_error());

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
                      <h4 class="card-title">القائمة</h4>
                    </div>
                    <a href="Additem.php" class="btn btn-round btn-fab btn-primary">
                        <i class="material-icons"> add </i>
                    </a>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                  <tr>
                    <th>الاسم</th>
								    <th>السعر  </th>
                    <th>الصورة</th>
                    <th>التصنيف</th>
                    <th>الوصف</th>
                    <th class="text-center">خيارات</th>
                  </tr>
                </thead>
                <tbody>
						<?php

            $user_id = $_SESSION['UserId'];

            $get_menus = "select *, (SELECT Ar_name from categories where categories.id = item_category) AS categoryName from menus_items where user_id = $user_id order by id desc";

            $run_menus = mysqli_query($con, $get_menus);
            $num_rows = mysqli_num_rows($run_menus);
            while ($row = mysqli_fetch_array($run_menus)){
       
              $id = $row['id'];  
              $name = $row['item_name'];
              $price = $row['item_price'];
              $image = $row['item_image'];
              $category = $row['categoryName'];
              $description = $row['item_description'];
              $rating = $row['rating'] + $rating;
             
              ?> 
              <tr>
                <td><?php echo $name; ?></td>
								<td><?php echo $price; ?></td>
                <td><img src="../images/<?php echo $image;?>" width="60" height="60" alt= "<?php echo $name; ?>"/></td>
                <td><?php echo $category; ?></td>
                <td><?php echo $description; ?></td>
                
                <td class="td-actions text-center simulateWindowResize">           
                  <a href="Edititem.php?id=<?php echo $row["id"]; ?>"  id="editbtn" rel="tooltip" class="btn btn-success" name="id">
                      <i class="material-icons">edit</i>
                  </a>

                  <a href="menus.php?deleted_id=<?php echo $row["id"]; ?>" id="deletebtn" onclick="return confirm('هل انت متأكد من الحذف؟')" rel="tooltip" name="deleted_id" value="delete" class="btn btn-danger">
                  <i class="material-icons">close</i>
                  </a>  

                </td>                
                
              </tr>
	          <?php }  $coiffureRate = $rating/$num_rows;
            $sqlcoiffure = "UPDATE users SET rating = '$coiffureRate' WHERE id = '$user_id'";
            mysqli_query($con,$sqlcoiffure);
           ?>
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