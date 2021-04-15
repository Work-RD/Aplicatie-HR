<html>
<head>
    <?php require("include/library.php");
    require("include/db.php");
    session_start();
    function afiseaza_raspuns($valoare,$valoare2,$valoare3){
        echo "
        <div class='container-fluid'>
        <div class='row'>
        <div class='col-lg-7 col-lg-offset-2'>
        <div class='raspuns' style='color:grey'>
        <input type='text' name='rasp' value='".$valoare."' style='border:none; background: transparent; outline: 0;' disabled>
        </div>
        </div>
        <div class='col-lg-1 '>
        <input style='margin-top:20%;' type='radio' required  name='".$valoare2."' value='".$valoare3."' >
        </div> 
        </div>
        </div>";
    }
    ?>
<style>
.observatii2 {
    border-radius: 3px;
    border: solid;
    border: 1px solid #ccc;
    margin: 8px 0;
    padding: 7px;
}     
</style>   
<script>
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
if(dd<10) {
  dd='0'+dd
} 

if(mm<10) {
  mm='0'+mm
} 

today = mm+'/'+dd+'/'+yyyy;
document.getElementById("demonew").innerHTML = today;
var myVar=setInterval(function(){myTimer()},1000);

function myTimer() {
    var d = new Date();
    document.getElementById("demo").innerHTML = d.toLocaleTimeString();
}
</script>
</head>

<style>

</style>
  
<body>
<div class='container-fluid'>
   <div class='row'>
       <div class='col-lg-1'>
         <img src='sigla.jpg'>
       </div>

   <div class='col-lg-2 col-lg-offset-3'>
       <p name='nume_t' style='margin-top: 20px; text-align: right;font-weight: bolder;'></p>
   </div>
    <div class="col-lg-2 ">
        <?php 
        $count="SELECT COUNT(id) as 'Nr' FROM teste_date_de_useri";
        $result = sqlsrv_query($conn,$count);
        while($row = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){ 
            $nr=$row['Nr'];   
        }
        $nr=$nr+1;
        echo "<p style='margin-top: 20px; text-align: right;font-weight: bolder;'>Numar test : ".$nr."</p>";
        ?>
    </div>    
    <div style='border-width: 1px 1px 1px 1px; border-color: #3498db;'>
<div class="col-lg-1" style="color:black;margin-top: 20px; text-align: right;font-weight: bolder;" >
<p id="demo" style='float:right'></p>
</div>      
<div class='col-lg-1'>   
    <p id="demonew" style='float:right;margin-top: 20px; text-align: right;font-weight: bolder;'></p>
</div></div>    
<script>
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
if(dd<10) {
  dd='0'+dd
} 
if(mm<10) {
  mm='0'+mm
} 
today = mm+'/'+dd+'/'+yyyy;
document.getElementById("demonew").innerHTML = today;
var myVar=setInterval(function(){myTimer()},1000);

function myTimer() {
    var d = new Date();
    document.getElementById("demo").innerHTML = d.toLocaleTimeString();
}
</script>    
       
    
</div>
    </div>

<div class='container-fluid'>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <section>
            <hr/>
        </section>
    </div>
</div>
</div>
<div class='container-fluid'>
<div class='row'>
<div class="col-lg-2 col-lg-offset-2"> 
        <form id="myform" method="post" action="user.php" id="form">
            <?php 
                $result =sqlsrv_query($conn,"SELECT * FROM teste WHERE indisponibil=0");
            ?>
        <select id="teste" class='form-control' name="teste" required > 
               <option value="" disabled selected>Selecteaza test ... </option>
            <?php while($row1 = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){ ?>
                <option value="<?php echo $row1['id'];?>"><?php echo $row1['nume'];?></option>
            <?php } ?>
        </select>   
             
    </div>
     
    </div></div>



<div class='container-fluid'>
<div class="row">
    <div class="col-lg-2 col-lg-offset-2"> 
         <input required type="text" value="<?php echo (isset($_POST['prenume']) ? $_POST['prenume']:''); ?>" id="prenume" name="prenume" placeholder="Prenume ">
    </div>
    <div class="col-lg-2"> 
         <input required type="text" value="<?php echo (isset($_POST['nume']) ? $_POST['nume']:''); ?>" id="nume" name="nume" placeholder="Nume "> 
    </div>
    <div class="col-lg-2"> 
         <input required type="text" value="<?php echo (isset($_POST['functie']) ? $_POST['functie']:''); ?>" id="functie" name="functie" placeholder="Functie "> 
    </div>
    <div class="col-lg-2"> 
         <input required type="text" value="<?php echo (isset($_POST['nr_marca']) ? $_POST['nr_marca']:''); ?>" id="nr_marca" name="nr_marca" placeholder="Numar de marca "> 
    </div>
    
</div>
</div>

<div class='container-fluid'>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="observatii2">
            <input id="myText" value="<?php echo (isset($_POST['obs']) ? $_POST['obs']:''); ?>" placeholder="Observatii " type="text" style="border:none; background: transparent; outline: 0;" name="obs">
        </div>
    </div>
</div>
</div>

<div class='container-fluid'>
<div class="row">
    <div class="col-lg-1 col-lg-offset-2">
        <input class="btn btn-default" id="myText" value="Incepe testul!" name="submit" type="submit" >
    </div>
</div>    
</div>
</form>

<div class='container-fluid'>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <section>
            <hr/>
        </section>
    </div>
</div>
</div>


<?php

if (isset($_POST['submit'] ) && $_POST['teste']!=""){
    $nume_test=$_POST['teste']; 
	$nume=$_POST['nume']; 
	$prenume=$_POST['prenume'];
    $functie=$_POST['functie'];
    $id=$_POST['nr_marca'];
    $_SESSION['obs']=$_POST['obs'];
    $_SESSION["nume_test"]=$nume_test; 
    $_SESSION["id"]=$id; 
    $_SESSION['teste']=$nume_test;
    
    $test="SELECT nume from teste where id='$nume_test'";
    $rtest=sqlsrv_query($conn,$test);
    while($row = sqlsrv_fetch_Array($rtest,SQLSRV_FETCH_ASSOC)){
        $_SESSION['test']=$row['nume'];
        echo "<script>document.getElementsByName('nume_t')[0].textContent += '".$_SESSION['test']."'</script>";
    }
    
    $n=0;
    $p=0;
    $f=0;
    $nr=0;
    if(is_numeric($nume)) $n=1;
    if(is_numeric($prenume)) $p=1;
    if(is_numeric($functie)) $f=1;
    if(!is_numeric($id) || $id>9999999) $nr=1;
    
    $delay="select  *  from teste_date_de_useri WHERE  teste_date_de_useri.id_user='$id' and DATEDIFF(minute, teste_date_de_useri.data_sustinere, GetDate())<5"; 
    $resultD= sqlsrv_query($conn,$delay,array(), array( "Scrollable" => 'static' ));
    if( $resultD === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    $count = sqlsrv_num_rows( $resultD );

    if($n==0 && $p==0 && $f==0 && $nr==0 && $count==0) { 
    $verify="IF NOT EXISTS ( SELECT 1 FROM Users WHERE id = '$id' )
                BEGIN
                    INSERT INTO users (id, nume, prenume, functie) VALUES ('$id', '$nume', '$prenume', '$functie')
                END";    
    $result2 = sqlsrv_query($conn,$verify);
     
    
    
    
    $result =sqlsrv_query($conn,"SELECT * FROM intrebari_teste WHERE id_test=".$_SESSION['teste']."");
    if( $result === false ) {
                die( print_r( sqlsrv_errors(), true));
            }    
    $intrebari=array();
    $k=0;
  
    while($row = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){  
        echo "<form method='post' action='user.php' id='myform' >";
        echo "
            <div class='container-fluid'>
            <div class='row'>       
                <div class='col-lg-8 col-lg-offset-2'>
                    <div class='intrebare' style='color:white'>
                        <input name='raspuns' 'id='myText' . value='". $row['intrebare'] . "' type='text' style='border:none; background: transparent; outline: 0;' disabled disabled />
                    </div>
                </div>
            </div>
            </div>";
        
        $intrebari[$k]=$row['id'];
        $k++;
        $numbers = range(1, 3);
        shuffle($numbers);
        foreach ($numbers as $number) {
            if($number==1) afiseaza_raspuns($row['varianta1'],$row['id'],"varianta1");
            else if($number==2) afiseaza_raspuns($row['varianta2'],$row['id'],"varianta2");
            else if($number==3)   afiseaza_raspuns($row['varianta3'],$row['id'],"varianta3");
        }
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
   
echo "<script>
        function myFunction() {
            if (window.confirm('Esti sigur ca vrei sa finalizezi testul?')) { 
                document.getElementById('submit2').click();
                ". $_SESSION['var']=1 . "    
            }
        }
    </script>";
    
echo "
    <div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-1 col-lg-offset-2'>
            <input style='margin-buttom:20px;' onclick='myFunction()' class='btn btn-default'  value='Finalizeaza!' name='submit2'  >
            <input type='submit' id='submit2' style='visibility: hidden;'>
    </div>
    </form>
</div></div>";
    
echo "<script>
        document.getElementsByName('teste')[0].disabled=true;
        document.getElementsByName('teste')[0].value=".$nume_test.";
        document.getElementsByName('nume')[0].readOnly=true;
        document.getElementsByName('prenume')[0].readOnly=true;
        document.getElementsByName('functie')[0].readOnly=true;
        document.getElementsByName('nr_marca')[0].readOnly=true;
        document.getElementsByName('obs')[0].readOnly=true;
        document.getElementsByName('submit')[0].disabled=true;
        </script>";

}

    else {
        if($n==1) echo "<script type='text/javascript'>alert('Nume invalid!')</script>";
        if($p==1) echo "<script type='text/javascript'>alert('Prenume invalid!')</script>";;
        if($f==1) echo "<script type='text/javascript'>alert('Functie invalida!')</script>";
        if($nr==1) echo "<script type='text/javascript'>alert('Nr. marca invalid!')</script>";
        if($count!=0) echo "<script type='text/javascript'>alert('Testul nu este disponibil inca.')</script>";
    }
}

  

?>
<?php
  
if(isset($_POST['submit2'])&&$_SESSION['var']==1){
    $k=0;
    $intrebari=array();    
    $id=$_SESSION["id"];
    $nume_test=$_SESSION["nume_test"];
    $obs=$_SESSION['obs'];
   
    
     $mysql2 = "INSERT INTO teste_date_de_useri (id_test, id_user, data_sustinere, rezultat, observatii) OUTPUT INSERTED.id as 'ID' VALUES ('$nume_test', '$id', GetDate(), '0','$obs')";
     $result3 = sqlsrv_query($conn,$mysql2);
     while($row = sqlsrv_fetch_Array($result3,SQLSRV_FETCH_ASSOC)){  
            $_SESSION['ok']=$row['ID'];
     } 
    
     
     $id_t=$_SESSION['ok'];
     $result =sqlsrv_query($conn,"SELECT * FROM intrebari_teste WHERE id_test='$nume_test'");
     while($row = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){  
            $intrebari[$k]=$row['id'];
            $k++;
        }   
        $mysql1="SELECT * FROM teste WHERE id='$nume_test'";
        $result1 = sqlsrv_query($conn,$mysql1);
        while($row=sqlsrv_fetch_Array($result1, SQLSRV_FETCH_ASSOC)){
            $gresite=$row['gresite']; 
        }     
        $gresite_user=0;
      
        foreach ($intrebari as $intr){
            $raspuns3=$_POST[$intr];
            $mysql2 = "INSERT INTO istoric_teste (id_test_history, id_intrebare, raspuns_ales) VALUES ('$id_t', '$intr', '$raspuns3')";
            $result3 = sqlsrv_query($conn,$mysql2);
            if( $result3 === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
            if($raspuns3!="varianta1") $gresite_user++;    
        }
        if($gresite_user>$gresite) 
        { 
          //  echo "<script> window.confirm('Nu ai trecut testul. '); </script>";
            echo "<div class='container-fluid'><div class='row'><div class='col-lg-8 col-lg-offset-2'><div class='alert alert-warning' style='height:30%;font-size: 250%; text-           align:center; background-color:#ff0000; color: white ;'>
                    <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <div style='text-align:center;margin-top:5%;'> <strong>NU</strong> ai trecut testul! </div>
                  </div></div></div></div>";
            
            $rezultat=0;
        }
    
        else  
        { 
         //   echo "<script> window.confirm('Felicitari, ai trecut testul!'); </script>";  
              echo "<div class='container-fluid'><div class='row'><div class='col-lg-8 col-lg-offset-2'><div class='alert alert-success' style='height:30%;font-size: 250%; text-              align:center; background-color:#00cc00; color: white ;'>
                    <a href='#' class='close' data-dismiss='alert'>&times;</a>
                    <div style='text-align:center;margin-top:5%;'> <strong>Felicitari!</strong> Ai trecut testul! </div>
                </div></div></div></div>";
            $rezultat=1;
        }
        $mysql2 = "UPDATE teste_date_de_useri SET rezultat='$rezultat' WHERE id='".$_SESSION['ok']."'";
        $result3 = sqlsrv_query($conn,$mysql2);
          if( $result3 === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
    
}
?>

</body>
</html>