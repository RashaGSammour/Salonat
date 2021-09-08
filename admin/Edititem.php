<?php

include('../conn.php');

if (isset($_GET['id']))
{
  $id = $_GET['id'];
  $get_menus = "select *, (SELECT Ar_name from categories WHERE categories.id = item_category) As categoryName from menus_items WHERE id = '$id'";

  $run_menus = mysqli_query($con, $get_menus);
  $row = mysqli_fetch_array($run_menus);
  
  $name = $row['item_name'];
  $price = $row['item_price'];
  $image = $row['item_image'];
  $description = $row['item_description'];
  $category = $row['categoryName'];

}else{

  $name = "";
  $price = "";
  $description = "";
  $category = "";

}

if(isset($_POST["submit_btn"]))

{ 

  $btn_id = $_GET['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];

  if($_FILES['image']['name'] == ""){

    $image = $row['item_image'];
  
  }

  else {

  $image = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  move_uploaded_file($image_tmp,"../images/$image");
  
  }

  $description = $_POST['description'];

  if($_POST['category'] == "")
    {
      $category = $row['item_category'];

    }else{

      $category = $_POST['category'];
    }

  $sql = "UPDATE menus_items SET item_name='$name', item_price ='$price', item_image ='$image', item_category = '$category', item_description= '$description' WHERE id = '$btn_id'" ;
  $res = mysqli_query($con , $sql);

  if($res){
    echo "<script>alert('تم تعديل النموذج بنجاح')</script>";
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

<body >
 
      <div class="content">
        <div class="container-fluid">
          <div class="row">                    
            <div class="col-md-12">
              <div class="card ">
                <div class="card-header-primary card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">تعديل نموذج</h4>
                  </div>
                </div>
                <div class="card-body ">
                  <form method="post"  class="form-horizontal"  enctype="multipart/form-data">
                    <div class="row">
                      <label class="col-sm-2 col-form-label">الاسم</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="hidden" name="id" class="form-control">
                          <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                          <span class="bmd-help">أدخل الاسم</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">السعر</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                          <span class="bmd-help">أدخل السعر</span>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">أضف صورة</label>
                          <input type="file" name="image"/>
                          <img src="../images/<?php echo $image; ?>" width="60" height="60"/>
                    </div>
                    <br>
                    <div class="row"> 
                      <label class="col-sm-2 col-form-label">التصنيف</label>      
                        <select name="category" class="col-sm-2 btn btn-round text-left btn-primary" style="font-size: 14px">
                          
                          <?php
                          
                            $run = mysqli_query($con,"SELECT menus_items.item_category,categories.id,categories.Ar_name FROM menus_items INNER JOIN categories ON menus_items.item_category = categories.id");
                            $row = mysqli_fetch_array($run);
                          
                             $id = $row['id'];
                              
                             $Name = $row['Ar_name'];

                             $menusID = $row['item_category'];
                           
                          ?>
                          
                          <option disabled selected ><?php if ($id == $menusID) {echo $Name;} else echo "اختر تصنيف<";?></option>
                          
                          <?php

                            $run = mysqli_query($con,"SELECT id, Ar_name FROM categories");

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
                        <br>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">الوصف</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                        <textarea name="description"><?php echo $description;?></textarea> 
                        </div>
                      </div>
                    </div>
                        <button type="submit" name = "submit_btn" class="btn btn-fill btn-primary">تأكيد</button>
                      </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include('../footer.php');?>
</div>
</div>
</body>
</html>