<!DOCTYPE html>
<html class="">

<head>
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
    input[type=radio] {
    width: 100%;
    padding: 3px 3px;
    margin: 8px 0;
    display: inline;
    border: 1px solid #ccc;
    border-radius: 4px;
    position: center;
    margin-top: 20px;
    }   
    </style>
    <?php require("include/library.php");
    require("include/db.php");
    session_start();
    if($_SESSION['admin']!=1)   echo "<script> location.replace('error.php'); </script>";
    function afiseaza_raspuns($valoare2, $valoare3){
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
    
    function afiseaza_raspuns_c($valoare2, $valoare3){
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
<?php include('include/menuAdmin.php'); ?>

<div class='container-fluid'>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <section>
                <hr/>
            </section>
        </div>
</div>
</div>

<form method='post' action='testNou.php' id='myform'>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-lg-offset-2"> 
                <input required type="text"  id="numeTest" name="numeTest" placeholder="Nume test"> 
            </div>
        <div class="col-lg-2"> 
            <input required type="text"  name="nrIntr" placeholder="Numar total de intrebari">
        </div>
        <div class="col-lg-3"> 
            <input required type="text"  id="gresite" name="gresite" placeholder="Numar maxim de intrebari gresite ">
        </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">    
            <div class="col-lg-2 col-lg-offset-2">
                <input style="margin-top:5px;" class="btn btn-default" id="myText" value="Afiseaza formular" name="submit" type="submit" >
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
    if(isset($_POST['submit'])) {
    $numeTest=$_POST['numeTest'];
    $nrIntr=$_POST['nrIntr'];
    $_SESSION['$nrIntr']=$nrIntr;
    $gresite=$_POST['gresite'];
    echo '<script>  document.getElementsByName("numeTest")[0].value="'.$numeTest.'"</script>';
    echo '<script>  document.getElementsByName("nrIntr")[0].value="'.$nrIntr.'"</script>';
    echo '<script>  document.getElementsByName("gresite")[0].value="'.$gresite.'"</script>';
    
    $er1=0;
    $n=0;
    $nr=0;
    $g=0;
    if($gresite>=$nrIntr) $er1=1;
    if(is_numeric($numeTest)) $n=1;
    if(!is_numeric($nrIntr)) $nr=1;
    if(!is_numeric($gresite)) $g=1;    
    
     
    if($n==0 && $nr==0 && $g==0 && $er1==0) {
        $_SESSION['numeTest'] = $_POST['numeTest'];
        $_SESSION['gresite'] = $_POST['gresite'];
        
        echo "<form method='post' action='testNou.php'>";
        for($i=1;$i<=$nrIntr;$i++) {
            echo "
                <div class='container-fluid'>
                    <div class='row'>       
                        <div class='col-lg-8 col-lg-offset-2'>
                            <div class='intrebare' style='color:white'>
                                <input name='".$i."' 'id='myText' . placeholder='Intrebarea ". $i . "' type='text' style='border:none; background: transparent; outline: 0;'  />
                            </div>
                        </div>
                    </div>
                </div>";
        afiseaza_raspuns_c($i,"A");
        afiseaza_raspuns($i,"B");   
        afiseaza_raspuns($i,"C");  
        } 
        
        echo "<script>
            function myFunction() {
                if (window.confirm('Esti sigur ca vrei sa salvezi testul?')) { 
                document.getElementById('submit2').click();    
                }
            }
        </script>";
    
        echo "
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-lg-1 col-lg-offset-2'>
                        <input style='margin-top:10px;' onclick='myFunction()' class='btn btn-default'  value='Salveaza test' >
                        <input type='submit' id='submit2' style='visibility: hidden;' name='submit2'>
                    </div>
                </div>
            </div>
        </form>";
    } //sfarsit for
        
    else {
        if($n==1) echo "<script type='text/javascript'>alert('Nume invalid!')</script>";
        if($nr==1) echo "<script type='text/javascript'>alert('Numar intrebari invalid!')</script>";;
        if($g==1) echo "<script type='text/javascript'>alert('Max. intrebari gresite invalid!')</script>"; 
        if($er1==1) echo "<script type='text/javascript'>alert('Numarul de intrebari gresite trebuie sa fie mai mic decat numarul total de intrebari')</script>";
    }    
    }
    
     if(isset($_POST['submit2'])){
        $nrIntr=$_SESSION['$nrIntr'];
        for($i=1;$i<=$nrIntr;$i++){
            $B="B".$i;
            $C="C".$i;
            $A="A".$i;
            $intr=$_POST[$i]; 
            $vB=$_POST[$B];
            $vC=$_POST[$C];
            $vA=$_POST[$A];
            $err=0;
            if(!(strlen($intr)>0 && strlen($vA)>0 && strlen($vB)>0 && strlen($vC)>0)) {
                $err=1;
            }
        }
        if($err==0) { 
        $verify="INSERT INTO teste (nume,gresite,indisponibil) VALUES ('".$_SESSION['numeTest']."','".$_SESSION['gresite']."','0')";
        $result2=sqlsrv_query($conn,$verify);
        if( $result2 === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
        }
        $mysql="SELECT id FROM teste WHERE nume LIKE '".$_SESSION['numeTest']."'";
        $result = sqlsrv_query($conn,$mysql);
        while($row=sqlsrv_fetch_Array($result, SQLSRV_FETCH_ASSOC)){      
            $_SESSION['id_test']=$row['id'];
        }
        for($i=1;$i<=$nrIntr;$i++){
            $B="B".$i;
            $C="C".$i;
            $A="A".$i;
            $id=$_SESSION['id_test'];
            $intr=$_POST[$i]; 
            $vB=$_POST[$B];
            $vC=$_POST[$C];
            $vA=$_POST[$A];
                if(strlen($intr)>0 && strlen($vA)>0 && strlen($vB)>0 && strlen($vC)>0 && $err==0) { 
                    $mysql2 = "INSERT INTO intrebari_teste (id_test, intrebare, varianta1, varianta2, varianta3) VALUES ('$id', '$intr', '$vA', '$vB', '$vC')";
                    $result3 = sqlsrv_query($conn,$mysql2);
                        if( $result3 === false ) {
                            $err=1;
                         }
                 
                }
            
            }
            if(!(strlen($intr)>0 && strlen($vA)>0 && strlen($vB)>0 && strlen($vC)>0)) echo "<script> confirm('Completati toate intrebarile si raspunsurile.'); </script>";
            else if($err==0) echo "<script> confirm('Testul a fost creat cu succes.'); </script>";
     }
        
?>    
  
</body>
</html>




