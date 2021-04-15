<!DOCTYPE html>
<html class="">

<head>
    <?php require("include/library.php");
    require("include/db.php");
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

<form method='post' action='administrareUser.php' id='myform'>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-lg-offset-2"> 
                <input required type="text"  id="numeuser" name="numeuser" placeholder="Nume user"> 
            </div>
            <div class="col-lg-2 "> 
                <input required type="password"  id="password" name="password" placeholder="Parola"> 
            </div>
            <div class="col-lg-2 "> 
                 <input required type="password"  id="confirm" name="confirm" placeholder="Confirma parola"> 
            </div>
    
            <div class="col-lg-2"> 
                 <select style="height:50px;" name="privilegii">
                    <option value="" disabled selected>Selecteaza Privilegii</option>
                     <option value='0'>User</option>
                     <option value='1'>Admin</option>
                 </select>
            </div>
        </div>
    <div class="row">
        <div class="col-lg-3 col-lg-offset-2" >
            <input style="margin-top:5px;" class="btn btn-default" id="myText" value="Creaza User" name="submit" type="submit" >
        </div>
    </div>
    </div>
</form>

<div class="col-lg-8 col-lg-offset-2">
    <section>
        <hr/>
    </section>
</div>

</body>
</html>


<?php
    
if(isset($_POST['submit'])){
    $result =sqlsrv_query($conn,"SELECT * FROM login WHERE nume like '".$_POST['numeuser']."'",array(), array( "Scrollable" => 'static' ));
    $row_count = sqlsrv_num_rows( $result );
    if(isset($_POST['privilegii']) && $_POST['password']==$_POST['confirm'] && $row_count==0){
        $result=sqlsrv_query($conn,"INSERT INTO login(nume,parola,privilegii) VALUES ('".$_POST['numeuser']."','".$_POST['password']."',".$_POST['privilegii'].".)");
        if( $result === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        else echo"<script>confirm('Userul a fost creat cu succes'); </script>";
    }
    else {
        if(!isset($_POST['privilegii'])) { echo "<script>alert('Privilegiile nu au fost selectate!');</script>"; }
        else if($_POST['password']!=$_POST['confirm']) { echo "<script>alert('Parole nu sunt indentice!');</script>"; }
        else if($row_count!=0) { echo "<script>alert('Exista deja un user cu acest nume!');</script>"; }
        }
        
}

?>