<?php
  include("../conn.php");

  if (isset($_GET['deleted_id']))
    {

      $id = $_GET['deleted_id'];

      $result = mysqli_query($con,"DELETE FROM categories WHERE id = '$id'") or die(mysql_error());

     }

  include("head.php");
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    
  </head>

    <body class="rtl">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
             <div class="col-md-12">
                <div class="card ">
                  <div class="card-header-primary card-header-text">
                    <div class="card-text">
                      <h4 class="card-title">التصنيفات</h4>
                    </div>                
                  </div>
                  <br>
                  <div class="row">
                <div class="col-md-12">
              <div class="card ">
                <div class="card-header-primary card-header-text ">
                  <div class="card-text">
                    <h4 class="card-title">إضافة تصنيف</h4>
                  </div>
                </div>
                <br>
                <div class="card-body ">
                  <form method="post" class="form-horizontal">
                    <div class="row">
                      <label class="col-sm-2 col-form-label text-center">اسم التصنيف باللغة العربية</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="Ar_name" class="form-control">
                          <span class="bmd-help">أدخل التصنيف باللغة العربية</span>
                        </div>
                      </div>
                    </div>
                    <!--<div class="row">
                      <label class="col-sm-2 col-form-label text-center">اسم التصنيف باللغة الانجليزية</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="En_name" class="form-control">
                          <span class="bmd-help">أدخل اسم التصنيف باللغة الانجليزية</span>
                        </div>
                      </div>
                    </div>-->
                      <button type="submit" name = "submit_btn" class="btn btn-fill btn-primary" style="font-size: 14px;" >إضافة</button>
                  </div>
                </div>
              </div>
            </div>
              <div class="card ">
                <div class="card-header-primary card-header-text ">
                  <div class="card-text">
                    <h4 class="card-title">عرض التصنيفات</h4>
                  </div>
                </div>
                <div class="card-body ">
                  <div class="table-responsive">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr>  
                          <th class="text-center">اسم التصنيف</th>
                          <!--<th>اسم الصنف باللغة الانجليزية</th>-->
                          <th class="text-center">خيارات</th>
                        </tr>
                      </thead>

                      <?php
                        include('../conn.php');

                        if(isset($_POST["submit_btn"])){
                    
                          #$En_name = $_POST['En_name'];
                          $Ar_name = $_POST['Ar_name'];
 
                          $sql="INSERT INTO categories (Ar_name) VALUES ('$Ar_name')";

                          if(mysqli_query($con , $sql)){
                            echo "<script>alert('تم إضافة التصنيف بنجاح!')</script>";
                          }else{
                            echo "Failed";
                          }
                        }

                        $get_categories = "select * from categories";

                        $run_categories = mysqli_query($con, $get_categories);

                        while ($row = mysqli_fetch_array($run_categories)){

                          $Name = $row['Ar_name'];
                          #$En_name = $row['En_name'];
                      ?>

                      <tr>
                        <td class="text-center"><?php echo $Name; ?></td>
                        <!--<td><?php echo $En_name ?></td>-->

                        <td class="text-center">
                          <a href="category.php?deleted_id=<?php echo $row["id"]; ?>" id="deletebtn" onclick="return confirm('هل انت متأكد من الحذف؟')" rel="tooltip" name="deleted_id" value="delete" class="btn btn-danger">
                          <i class="material-icons">close</i>
                          </a>
                        </td>
                      </tr>

                      <?php } ?>
                    </div>
                  </div>
                </div>
              </table>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<?php include('../footer.php'); ?>
</div>
</div>
</div>

</div>

  </body>
</html>