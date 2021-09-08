<?php
include('../conn.php');
include('../functions.php');

  if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
  }

if(isset($_POST["submit_btn"])){
  $name = $_POST['name'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  $image = $_FILES['image']['name']; 
  $image_tmp = $_FILES['image']['tmp_name'];
  move_uploaded_file($image_tmp,"../images/$image");

  $description = $_POST['description'];

  $user_id = $_SESSION['UserId'];

  $sql="INSERT INTO menus_items (user_id, item_name , item_price , item_image , item_category ,item_description) VALUES ('$user_id','$name','$price','$image',$category,'$description')";
  $res = mysqli_query($con , $sql);

  if($res){
    echo "<script>alert('تم لإضافة العنصر بنجاح')</script>";
    echo "<script>window.open('menus.php?','_self')</script>";
  }else {
    echo "Failed";
  }
}
include('head.php');
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

<body>
 
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">       
            <div class="col-md-12">
              <div class="card ">
                <div class="card-header-primary card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">إضافة نموذج جديد<h4>
                  </div>
                </div>
                <div class="card-body ">
                  <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row text-right" >
                      <div class="col-md-12">
                    <div class="form-group"> 
                      <label class="col-sm-2 col-form-label">الاسم</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="name" class="form-control">
                          <span class="bmd-help">أدخل الاسم من فضلك</span>
                        </div>
                      </div>
                    </div>
                  </div>
                    </div>
                    <div class="row text-right" >
                      <div class="col-md-12">
                    <div class="form-group"> 
                      <label class="col-sm-2 col-form-label">السعر</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="price" class="form-control">
                          <span class="bmd-help">أدخل السعر من فضلك</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                    <br>                    
                    <div class="row text-right">
                    <div class="col-md-12"> 
                    <div class="form-group">
                      <label class="col-sm-2 col-form-label">أضف صورة</label>
                        </div>
                          <input type="file" name="image">
                    </div>
                  </div>
                    <br>
                    <div class="row text-right">
                    <div class="col-md-12">
                    <div class="form-group"> 
                      <label class="col-sm-2 col-form-label">التصنيف</label>      
                        <select name="category" class="col-sm-2 btn btn-round btn-primary" style="font-size: 16px" >
                            <option disabled selected >اختر تصنيف</option>
                            
                            <?php
                            
                            $run = mysqli_query($con,"SELECT id,Ar_name FROM categories");
                          
                            while($row = mysqli_fetch_array($run)){
                              
                              $id = $row['id'];
                              
                              $Name = $row['Ar_name'];

                             ?>

                            <option value= "<?php echo $id; ?>" >

                             <?php 
                            
                            echo $Name;
                            
                              }
                            
                            ?>     
                            </option>
                          </select>
                        </div>
                      </div>
                    </div>
                      <br>
                   <div class="row text-right">
                      <label class="col-sm-2 col-form-label">الوصف</label>
             
                      <div class="col-sm-10">
                        <div class="form-group">

                        <textarea name="description"></textarea> 
                        </div>
                      </div>
                    </div>
                      <button type="submit" name = "submit_btn" class="btn btn-fill btn-primary" style="font-size: 16px">تأكيد</button>
                       </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include('../footer.php'); ?>
</body>
</html>