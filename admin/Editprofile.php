<?php
include('head.php');
include('conn.php');
$user_id =$_SESSION['UserId'];
?>
<?php
if (isset($_SESSION['UserId']))
{
  $get_users = "select * from users WHERE id = '$user_id'";
  $run_users = mysqli_query($con, $get_users);
  $row = mysqli_fetch_array($run_users);
  
  $username = $row['username'];
  $name = $row['name'];
  $city = $row['city'];
  $mobile = $row['mobile'];
  $email = $row['email'];
  $adate =$row['adate'];
  $info =$row['info'];
  $password = $row['password'];

}else{

  $username = "";
  $name = "";
  $mobile = "";
  $city ="";
  $email = "";
  $password = "";

}

if(isset($_POST["submit"]))

{ 
  $password = md5($_POST['password']);
  if($password != $row['password']) echo "يجب إدخال كلمة مرور صحيحة";
  else{
  $name = $_POST['name'];
  if($name == "") $name =$row['name'];
  $city = $_POST['city'];
  if($city == "") $city = $row['city'];
  $mobile = $_POST['mobile'];
  if($$mobile == "") $mobile = $row['mobile'];
  $info = $_POST['info'];
  if($info == "") $info = $row['info'];
  $adate = $_POST['adate'];
  if($adate == "") $adate = $row['adate'];
  $password1 = md5($_POST['password1']);
  $password2 = md5($_POST['password2']);
  if($password1 != $password2) echo "كلمة المرور ليست متطابقة";
  else if($password1 == "") $password1 = $row['password'];
  $sql = "UPDATE users SET adate='$adate' , name = '$name' , mobile = '$mobile' , city = '$city' , password = $password1,info='$info' WHERE id = '$user_id'" ;
  $res = mysqli_query($con , $sql);
  
  if($res){
    echo "<script>alert('تم تعديل المستخدم بنجاح!')</script>";
    echo "<script>window.open('menus.php?','_self')</script>";

  }else {
    echo "Failed";
  }
}
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="utf-8" />
</head>

<body class="rtl">
      <div class="content rtl">
        <div class="container-fluid">
          <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img src="../images/admin_profile.png" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray"><?php echo $name; ?></h6>
                  <h4 class="card-title"><?php echo $username; ?></h4>
                  <p class="card-description"><?php if($info != 0) echo $info; else echo "معلومات عنك"; ?></p>
                </div>
              </div>
            </div>
          <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                  <div class="card-icon" style="float: right;">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title" style="text-align: right;"> تعديل الصفحة الشخصية -
                     <small class="category">أكمل تعبئة البيانات</small>
                  </h4>
                </div>
                <div class="card-body">
                  <form method="post" >
                    <div class="row" style="text-align: center;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">البريد الالكتروني</label>
                          <input type="email" class="form-control" style="color: #9027ac" value="<?php echo $email; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">اسم المستخدم</label>
                          <input type="text" class="form-control" style="color: #9027ac" value="<?php echo $username; ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="text-align: center;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">الهاتف</label>
                          <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">الاسم</label>
                          <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="text-align: center;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">المدينة</label>
                          <input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">تاريخ الميلاد</label>
                          <input type="Date" class="form-control" name="adate" value="<?php echo $adate; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="text-align: center;">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>تفاصيل</label>
                          <div class="form-group">
                            <label class="bmd-label-floating">يمكنك كتابة معلومات عن نفسك</label>
                            <textarea class="form-control" rows="5" name="info" value= "<?php echo $info; ?>"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="text-align: center;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">تأكيد كلمة المرور</label>
                          
                          <input type="password" class="form-control" name="password1" value="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">تغيير كلمة المرور </label>
                          <input type="password" class="form-control" name="password2" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="text-align: center;">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">أدخل كلمة المرور السابقة لحفظ التعديل</label>
                            <input type="password" class="form-control"  name="password">
                          </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" name="submit">حفظ</button><br>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>

              </div>
              
            </div>

        </div>
      
  
</body>

</html>