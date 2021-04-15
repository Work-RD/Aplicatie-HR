<!DOCTYPE html>
<html class="">

<head>
    <?php require("include/library.php");
    session_start();
    if($_SESSION['admin']!=1)   echo "<script> location.replace('error.php'); </script>";
                
        
    ?>
</head>

<body>

<?php include('include/menuAdmin.php'); ?>

<div class="col-lg-8 col-lg-offset-2">
    <section>
        <hr/>
    </section>
</div>
<div class='container-fluid'>
    <div class="container" style="margin-top:2%" align="center">
         <form class="form-inline" method="post" action="export.php" >
          <div class="form-group">

           <span style="font-size:20px;">Perioada:</span> <input style="height:35px;" type="date" name="startDate" required>
           <span style="font-size:20px;">-</span> <input style="height:35px;" type="date" name="endDate" required>
         
           <input type="submit" name="exportGeneral" value=" Export teste generale " class='btn btn-default'>
           <input type="submit" name="exportOperator" value=" Export teste operatori " class='btn btn-default'>
          </div>
         </form>
    </div>  
</div>

<div class="col-lg-8 col-lg-offset-2">
    <section>
        <hr/>
    </section>
</div>

</body>
</html>