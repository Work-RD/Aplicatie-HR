<!DOCTYPE html>
<html class="">

<style>
hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
}    
</style>
<?php
    session_start();
    if($_SESSION['admin']!=1)   echo "<script> location.replace('error.php'); </script>";           
?>
<head>

    <?php require("include/library.php");
    require("include/db.php"); 
    
    echo "<script>
        function confirm_s() {
            var x=confirm('Esti sigur ca vrei sa stergi testul?');
            if (x) {
                jQuery('#div_session_write').load('modificaTest.php?sterge=1');
            }
        }
    </script>";
    
    
    function afiseaza_raspuns($valoare2, $valoare3, $valoare){
        $name="".$valoare3.$valoare2;
        echo "
        <div class='container-fluid'>
        <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
        <div class='raspuns' style='color:grey'>
        <input type='text' name='".$name."' value='".$valoare."' style='border:none; background: transparent; outline: 0;'>  
        </div> 
        </div>
        </div>
        </div>";
    }
    
    function afiseaza_raspuns_c($valoare2, $valoare3, $valoare){
        $name="".$valoare3.$valoare2;
        echo "
        <div class='container-fluid'>
        <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
        <div class='raspuns' style='background-color: #47d147; color:white'>
        <input type='text' name='".$name."' value='".$valoare."' style='border:none; background: transparent; outline: 0;'>  
        </div> 
        </div>
        </div>
        </div>";
    }
    echo "<script>
               function en() {
                var x = document.getElementsByClassName(btn btn-default);
                var i;
                for (i = 0; i < x.length; i++) {
                if(x[i].disabled==true)
                    x[i].removeAttribute('disabled');
                    
                else
                    x[i].removeAttribute('disabled','disabled')
               }
              
              }
      </script>";
     ?>
    

              
</head>

<style>
input[type=text], select, input[type=password] {
    width: 100%;
    padding: 10px 18px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
}
</style>

<body>

<div id='div_session_write'> </div>

<?php include('include/menuAdmin.php'); ?>

<div class="col-lg-8 col-lg-offset-2">
    <section>
        <hr/>
    </section>
</div>

<div class='container-fluid'>
    <div class="row">
        <div class="col-lg-2 col-lg-offset-3"> 
                <?php 
                    $result =sqlsrv_query($conn,"SELECT * FROM teste WHERE indisponibil=0");
                ?>
                <form id="myform" method="post" action="modificaTest.php" id="form">
                <select style="height:50px;" id="teste" class='form-control' name="teste" required > 
                   <option value="" disabled selected>Alege test ... </option>
                       <?php while($row1 = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){ ?>
                       <option value="<?php echo $row1['id'];?>"><?php echo $row1['nume'];?></option>
                       <?php } ?>
                </select>   
        </div>     
        
        <div class="col-lg-1">
            <input class="btn btn-default"  value="Modifica intrebari" name="submit" type="submit" onclick="en()" id='af' >
        </div>
        
        <div class="col-lg-1" style='margin-left:3%'>    
            <input class="btn btn-danger" onclick="confirm_s()" value="Sterge Test" name="sterge" id='sterge' type="hidden" >
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
<?php
if(isset($_POST['salveaza'])){
    $nrIntr=$_SESSION['intr'];
    for($i=0;$i<$nrIntr;$i++){
        $B="B".$i;
        $C="C".$i;
        $A="A".$i;
        $id=$_SESSION['teste'];
        $intr=$_POST[$i]; 
        $vB=$_POST[$B];
        $vC=$_POST[$C];
        $vA=$_POST[$A];
        $id_i="id".$i;
        $idI=$_POST[$id_i];
        $mysql2 = "UPDATE intrebari_teste SET intrebare='$intr', varianta1='$vA', varianta2='$vB', varianta3='$vC' WHERE id='$idI' AND id_test='$id' ";
        $result3 = sqlsrv_query($conn,$mysql2);
    }
}

if(isset($_POST['sterge_s'])){

$id=$_SESSION['teste'];    
$id_i=$_POST['sterge_comanda'];
$result3 =sqlsrv_query($conn,"DELETE FROM intrebari_teste WHERE id='$id_i'");
    if( $result3 === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    else {echo "
             <script>
             document.getElementById('af').click();
             confirm('Intrebarea a fost stersa.') </script>";
         }
   
}

?>
<!-- Afiseaza intrebari -->
<?php
    if(isset($_POST['submit'])){
        echo "<script>  document.getElementById('sterge').type = 'submit'; </script>";
        $_SESSION['teste']=$_POST['teste'];
        echo '<script>  document.getElementsByName("teste")[0].value='.$_SESSION['teste'].'</script>';
        $_SESSION['teste']=$_POST['teste'];
        $nume_test=$_SESSION['teste'];
        $result =sqlsrv_query($conn,"SELECT * FROM intrebari_teste WHERE id_test=".$_POST['teste']."");
        $_SESSION['intr']=0;
        
        $test="SELECT nume from teste where id='$nume_test'";
        $rtest=sqlsrv_query($conn,$test);
        while($row = sqlsrv_fetch_Array($rtest,SQLSRV_FETCH_ASSOC)){
        $_SESSION['test']=$row['nume'];
        }
        
        
        
        
        if($_SESSION['test']!=null) echo "<div class='col-lg-8 col-lg-offset-2'>
                                            <p style='font: italic bold 18px/30px Georgia, Arial'>Nume test : ".$_SESSION['test']."</p>
                                            </div>";
        
        while($row = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){  
              $idI=$row['id'];
            echo "<form method='post' action='modificaTest.php' id='myform' >";
                echo "
                    <div class='container-fluid'>
                        <div class='row'>       
                            <div class='col-lg-7 col-lg-offset-2'>
                                <div class='intrebare' style='color:white'>
                                    <input type='hidden' name='id".$_SESSION['intr']."' value='".$row['id']."'>
                                    <input class='27' name='".$_SESSION['intr']."' id='".$row['id']."'  value='". $row['intrebare'] . "' type='text' style='border:none; background: transparent; outline: 0;'  />
                                </div>
                            </div>
                            <div class='col-lg-1'>
                        <form class='form-inline'  action='ModificaTest.php' method='post'>    
                            <input style='float:right; padding-top:10%; padding-bottom:10%;' type='submit' class='btn btn-danger' name='sterge_s' value='Sterge intrebarea'>  
                            <input type='hidden' name='sterge_comanda' value='$idI'>
                         
                        </div>
                        </div>
                    </div>
            ";
            afiseaza_raspuns_c($_SESSION['intr'],"A",$row['varianta1']);
            afiseaza_raspuns($_SESSION['intr'],"B",$row['varianta2']);   
            afiseaza_raspuns($_SESSION['intr'],"C",$row['varianta3']);
            $_SESSION['intr']++;
  
           
        }
        echo "
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-lg-8 col-lg-offset-2'>
                        <section>
                            <hr/>
                        </section>
                    </div>
                 </div>
            </div>";   
        echo "
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-lg-3 col-lg-offset-2'>
                        <input type='submit' style='margin-buttom:20px; background-color:green; color:white' class='btn btn-default'  value='Salveaza modificari' name='salveaza'  >
                        <input class='btn btn-default' style='margin-buttom:20px; background-color:yellow; float:right' value='Adauga Intrebare' id='adauga' name='adauga' type='submit' >
                    </div>
                    </form>
                    </form>
                </div>
            </div>";    
} 
?>


<!-- Sterge test -->
<?php

if (isset($_GET['sterge'])) {$_SESSION['sterge'] = $_GET['sterge'];}
if(isset($_POST['sterge'])&&$_SESSION['sterge']==1){
    $id=$_SESSION['teste'];
    $result =sqlsrv_query($conn,"SELECT * FROM teste_date_de_useri WHERE id_test=".$id."",array(), array( "Scrollable" => 'static' ));

    $row_count = sqlsrv_num_rows( $result );
    if($row_count==0) { 
        $result3 =sqlsrv_query($conn,"DELETE FROM intrebari_teste WHERE id_test=".$id.";");
        $result2 =sqlsrv_query($conn,"DELETE FROM teste WHERE id=".$id.";");
        if( $result2 === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        else {echo "<script> confirm('Testul a fost sters.'); </script>"; 
              echo "<meta http-equiv='refresh' content='0'>";
             }
    }
    else {  
        $result3 =sqlsrv_query($conn,"UPDATE teste SET indisponibil=1 WHERE id=".$id.";");
        if( $result3 === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        else { echo "<script> confirm('Testul a fost sters.'); </script>";
              echo "<meta http-equiv='refresh' content='0'>";
       
             }
    }
    $_SESSION['sterge']=0;
}
  
?>

<!-- Adauga intrebare -->
<?php
 //redefinirea functiilor pentru afisare
 function afiseaza_raspuns2($valoare2, $valoare3){
        $name="".$valoare3.$valoare2;
        echo "
        <div class='container-fluid'>
        <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
        <div class='raspuns' style='color:grey'>
        <input type='text' name='".$name."' placeholder='Raspuns gresit' style='border:none; background: transparent; outline: 0;'>  
        </div> 
        </div>
        </div>
        </div>";
    }
    
    function afiseaza_raspuns_c2($valoare2, $valoare3){
        $name="".$valoare3.$valoare2;
        echo "
        <div class='container-fluid'>
        <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
        <div class='raspuns' style='background-color: #47d147; color:white'>
        <input type='text' name='".$name."' placeholder='Raspuns corect' style='border:none; background: transparent; outline: 0;'>  
        </div> 
        </div>
        </div>
        </div>";
    }

if(isset($_POST['adauga'])){
        $result =sqlsrv_query($conn,"SELECT * FROM intrebari_teste WHERE id_test=".$_SESSION['teste']."");
        $_SESSION['intr']=0;
        
        $test="SELECT nume from teste where id='".$_SESSION['teste']."'";
        $rtest=sqlsrv_query($conn,$test);
        while($row = sqlsrv_fetch_Array($rtest,SQLSRV_FETCH_ASSOC)){
        $_SESSION['test']=$row['nume'];
        }
        
        
        
        
        if($_SESSION['test']!=null) echo "<div class='col-lg-8 col-lg-offset-2'>
                                            <p style='font: italic bold 18px/30px Georgia, Arial'>Nume test : ".$_SESSION['test']."</p>
                                            </div>";
    
        echo "<form method='post' action='modificaTest.php'>";
        echo "
            <div class='container-fluid'>
                <div class='row'>       
                    <div class='col-lg-8 col-lg-offset-2'>
                        <div class='intrebare' style='color:white'>
                            <input name='1' 'id='myText'  placeholder='Intrebare' type='text' style='border:none; background: transparent; outline: 0;'  />
                        </div>
                    </div>
                </div>
            </div>";
        afiseaza_raspuns_c2('1',"A");
        afiseaza_raspuns2('1',"B");   
        afiseaza_raspuns2('1',"C");  
        echo "<script>
        function myFunction() {
            document.getElementById('submit2').click();    
        }
        </script>";
    
        echo "
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-lg-1 col-lg-offset-2'>
                        <input style='margin-top:10px; background-color:green; color:white;' onclick='myFunction()' class='btn btn-default'  value='Adauga Intrebarea' >
                        <input type='submit' style='visibility:hidden' id='submit2' name='submit2'>
                    </div>
                </div>
            </div>
        </form>";
}

//adauga intrebarea
if(isset($_POST['submit2'])){
    $B="B".'1';
    $C="C".'1';
    $A="A".'1';
    $id=$_SESSION['teste'];
    $intr=$_POST['1']; 
    $vB=$_POST[$B];
    $vC=$_POST[$C];
    $vA=$_POST[$A];
    if(strlen($intr)>0 &&  strlen($vA)>0 && strlen($vB)>0 &&  strlen($vC)>0) { 
        $mysql2 = "INSERT INTO intrebari_teste (id_test, intrebare, varianta1, varianta2, varianta3) VALUES ('$id', '$intr', '$vA', '$vB', '$vC')";
        $result3 = sqlsrv_query($conn,$mysql2);
        if( $result3 === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        else echo "<script> confirm('Intrebarea a fost adaugata cu succes.'); </script>";    
    }
}

/*
sterge intrebare
if(isset($_POST['sterge_i'])){

    sterge($_POST['modifica_h']);
}*/

//Modificari
/*
if(isset($_POST['salveaza'])){
    $nrIntr=$_SESSION['intr'];
    for($i=0;$i<$nrIntr;$i++){
        $B="B".$i;
        $C="C".$i;
        $A="A".$i;
        $id=$_SESSION['teste'];
        $intr=$_POST[$i]; 
        $vB=$_POST[$B];
        $vC=$_POST[$C];
        $vA=$_POST[$A];
        $id_i="id".$i;
        $idI=$_POST[$id_i];
        $mysql2 = "UPDATE intrebari_teste SET intrebare='$intr', varianta1='$vA', varianta2='$vB', varianta3='$vC' WHERE id='$idI' AND id_test='$id' ";
        $result3 = sqlsrv_query($conn,$mysql2);
    }
}

if(isset($_POST['sterge_s'])){

$id=$_SESSION['teste'];    
$id_i=$_POST['sterge_comanda'];
$result3 =sqlsrv_query($conn,"UPDATE intrebari_teste SET indisponibil=1 WHERE id='$id_i'");
    if( $result3 === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    else {echo "
             <script>
             document.getElementById('af').click();
             confirm('Intrebarea a fost stersa.') </script>";
         }
*/         
   

               

?>