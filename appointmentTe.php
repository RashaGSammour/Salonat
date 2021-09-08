<?php
include('functions.php');
include('conn.php');
include('header1.php');
$user_id = $_SESSION['UserId'];    
?>

<?php
$servername = "localhost";
$username   = "root";
$password   = "12345678";
$dbname     = "salonat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST["ok"])){
    if($user_id ==""){ echo "<script>alert('عليك تسجيل الدخول للمتابعة'); </script>";}
    else{
    $cat_id =$_POST["serv"];
    $Coiffure_id = $_POST['Coiffure'];
    
    $sql="INSERT INTO appointment(cat_id,coiffure_id,user_id) VALUES ('$cat_id','$Coiffure_id','$user_id')";

    $res = mysqli_query($con , $sql);

  if($res){
    $idsql = "SELECT max(id) As lastid FROM appointment";
    $idres = mysqli_query($con,$idsql);
    $idrow = mysqli_fetch_assoc($idres);
    $lastid = $idrow['lastid'];
    echo "<script>window.open('appointmentTe.php?lastid=$lastid','_self')</script>";
  }else {
    echo "<script>alert('Error Selected');</script>";
    echo "<script>window.open('appointmentss.php)</script>";
  }
}
}
if (isset($_GET['deleted_id']))
    {
      $id = $_GET['deleted_id'];

      // delete the entry

      $result = mysqli_query($con,"DELETE FROM appointment WHERE id='$id'") or die(mysql_error());

     }

if(isset($_GET['lastid'])){

        $idsql = "SELECT max(id) As lastid FROM appointment";
        $idres = mysqli_query($con,$idsql);
        $idrow = mysqli_fetch_assoc($idres);
        $lastid = $idrow['lastid'];
        
            if(isset($_POST["submit"]) == "submit" && isset($_POST["eventTitle"]) != "")
            {
                $adate = $_POST['eventDate'];
                $atime = $_POST['eventTitle'];
                $event_date = $adate." ".$atime; 
                    
                $sql = "UPDATE appointment SET title = 'محجوز' , event_date='$event_date',status='1',atime='$atime',adate='$adate' where id = '$lastid'";
                if (mysqli_query($con,$sql)) {
                    echo "<script>alert('تم حجز الموعد');</script>";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        


$coiffuresql = "SELECT coiffure_id FROM appointment WHERE id = '". $lastid ."'";
$coiffureres = mysqli_query($conn,$coiffuresql);
$coiffurerow = mysqli_fetch_assoc($coiffureres);
$coiffure_id = $coiffurerow['coiffure_id'];

$sql = "SELECT title, event_date as start ,color as backgroundColor FROM appointment WHERE coiffure_id = $coiffure_id";
$result = mysqli_query($conn,$sql); 
$myArray = array();
if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }

} 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width,initial-scale=1,maximum-scale=1" name="viewport">

        <!-- Favicon and Apple Icons -->
        <link rel="shortcut icon" href="images/favico.ico">
        <!-- css => style sheet -->
        <link rel="stylesheet" type="text/css" href="assets/salonatcom/style.css">
        <!-- If English version include en.css , and if Arabic version include ar.css -->
        <link rel="stylesheet" type="text/css" href="assets/salonatcom/css/en.css">
        <!-- <link rel="stylesheet" type="text/css" href="css/ar.css"> -->
        <style>
            .demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333}
            .demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
            .demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
            .demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
            .demo-table ul{margin:0;padding:0;}
            .demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
            .demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
        </style>
        <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/moment.min.js'></script>
<script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/jquery.min.js'></script>
<script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script>

  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      defaultDate: new Date(),
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      dayClick: function(date, jsEvent, view) {

        $("#successModal").modal("show");
        $("#eventDate").val(date.format());

      },
      events: <?php echo json_encode($myArray); ?>
    });

  });

</script>
<style>
  #calendar {
    max-width: 800px;
    margin: 20px auto;
  }

</style>
    <link href="assets/ass/css/style.css" rel="stylesheet">

    </head>

    <body data-anchor="body">
    
            <div class="main-contents gray-bg mini-50">
                <div class="container">
                       <div class="row salon-services-wrapper">
                            <div class="col-md-9">
                            <div class="block-box">
                                <ul class="box-header">
                                    <?php
                                    include('conn.php');
                                    if(isset($_GET['lastid'])){
                                        $idsql = "SELECT max(id) As lastid FROM appointment";
                                        $idres = mysqli_query($con,$idsql);
                                        $idrow = mysqli_fetch_assoc($idres);
                                        $id = $idrow['lastid'];
                                    }
                                    $sql = "SELECT *,(SELECT name FROM sub_categories where sub_categories.id= appointment.cat_id) As category_name,(SELECT name FROM users where users.id = appointment.coiffure_id) As admin_name,(SELECT id FROM users where users.id = appointment.coiffure_id) As admin_id,(SELECT name FROM users where users.id = appointment.user_id) As user_name FROM appointment WHERE id = '". $id ."'";
                                    $res = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($res);
                                    //$category_name = $row['category_name'];
                                    $admin_name = $row['admin_name'];
                                    $adate = $row['adate'];
                                    $coiffure_id = $row['admin_id'];
                                    $user_name = $row['user_name']
                                    ?>
                                    <li class="pull-center"><h5 class="title">
                                            <a onmouseover="this.style.color='#9027ac'" href="Coiffuresitem.php?id=<?php echo $coiffure_id; ?>" class="btn btn-primary"><?php echo $admin_name; ?></a>
                                        </h5></li>
                                    </ul>                                   
                                                           
                                   <div id='calendar'></div>
                                   <div class="modal fade" id="successModal" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content" style="direction: rtl">
  <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">أضف الوقت</h4>
  </div>
  <div class="modal-body" style="text-align: center;">
    <?php 
          if(isset($_POST['submit'])){
              $query ="INSERT INTO `notifications` (`user_id`, `name`,`coiffure_id`, `type`, `status`, `date`) VALUES ($user_id, '$user_name','$coiffure_id', 'comment','unread', CURRENT_TIMESTAMP)";
              if(performQuery($query)){
                  header("location:appointmentss.php");
              }
          }
          ?>
          <?php 
          if(isset($_GET['deleted_id'])){
              $query ="INSERT INTO `notifications` (`user_id`, `name`,`coiffure_id`, `type`, `status`, `date`) VALUES ($user_id, '$user_name','$coiffure_id', 'like','unread', CURRENT_TIMESTAMP)";
              if(performQuery($query)){
                  header("location:appointmentss.php");
              }
          }
          ?>
    <form action="#" method="post">
    <div class="form-group">
       <select style="background-color: #9027ac; text-align: center; color: white;" for="eventtitle" type="text" name="eventTitle" class="form-control" id="eventTitle" required="">
            <option disabled selected style="text-align: center;" >حدد الوقت</option>
                <?php
                 for($i = 9 ; $i <= 11 ; $i++){ ?>
            <option value= "<?php echo ($i . ':00:00') ?>" style = "text-align: center;"><?php echo $i."AM"; ?></option>
            <?php } ?>
            <option value= "<?php echo '12:00:00' ?>" style = "text-align: center;"><?php echo "12PM"; ?></option>
            <?php for($i=1; $i <= 6; $i++) { ?>
            <option value= "<?php echo ($i+12 .':00:00') ?>" style = "text-align: center;"><?php echo $i."PM"; ?></option>
            <?php } ?>
        </select>
      <br>
      <input type="hidden" name="eventDate" class="form-control" id="eventDate" >
    </div>
    <button type="submit" value="submit" name="submit" class="btn btn-success">أضف موعد</button>
    <a href="appointmentTe.php?deleted_id=<?php echo $row["id"]; ?>" id="deletebtn" onclick="return confirm('هل انت متأكد من الحذف؟')" rel="tooltip" name="deleted_id" value="delete" class="btn btn-danger" style = "background-color: red;color: white;">
                                            حذف موعد</a>
    
    
  </form>
  </div>
</div>
</div>
</div>
                               
                                
                            </div>

                            </div>
                             <div class="col-md-3">
                               
                                <div class="block-box" style= "padding-top: 20px;text-align: center;">
                                    <div><h3>احجز موعدك</h3></div>
                                     <form action="" method = 'post'>

                                        <div>
                                    <select class="widget-title" name="serv" style="background-color: #9027ac;">
                                    <option disabled selected >اختر خدمة</option>
                                    <?php 
                                    $sql = "SELECT * FROM sub_categories order by id desc";
                                    $run = mysqli_query($con,$sql);
                                    while ($row = mysqli_fetch_array($run)) {
                                        $name = $row['name'];
                                        $cat_id = $row['id'];
                                        ?>
                                    <option value= "<?php echo $cat_id; ?>"><?php echo $name; ?></option>
                                    <?php } ?>
                                    </select></div>
                                        <div>
                                    <select class="widget-title" name="Coff" style="background-color: #9027ac;">
                                    <option disabled selected >اختر كوافير</option>
                                    <?php 
                                    $sql = "SELECT * FROM users where user_type = 'admin' order by id desc";
                                    $run = mysqli_query($con,$sql);
                                    while ($row = mysqli_fetch_array($run)) {
                                        $name = $row['name'];
                                        $userID = $row['id'];
                                        ?>
                                    <option value= "<?php echo $userID; ?>"><?php echo $name; ?></option>
                                    <?php } ?>
                                    </select></div>
                                    <!--<div><input type="Date" name="adate" placeholder="اختر التاريخ" style="color: #9027ac;background-color: #f5f5f5;"></div>--><br>
                                    <div>
                                    <button class="btn btn-primary" name="ok">الساعات المتاحة</button>
                                    </div>
                            </form>    
                                </div><!-- end of cart wrapper -->
                            </div>                                  
                        </div>
                    </div>
            </div><!-- end of main contents -->
        <!-- end of all wrapper -->
        
        <?php //include('footer.php');?>
        <!-- jQuery (necessary for JavaScript plugins) ================================================== -->
        <!-- <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
        

    </body>
</html>