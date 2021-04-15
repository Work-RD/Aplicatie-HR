<html class="">


<head>
    <?php require("include/library.php");
    require("include/db.php");
    session_start();
    if($_SESSION['admin']!=1)   echo "<script> location.replace('error.php'); </script>";
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

<div class="col-lg-8 col-lg-offset-2">
    <section>
        <hr/>
    </section>
</div>
<div class='container-fluid'>
    <div class="container" style="margin-top:2%" align="center">
         <form class="form-inline" method="post" action="cautareRezultate.php" >
          <div class="form-group">
         
            <select class="form-control" name="cautare" required>
              <option value="" disabled selected>Alege criteriu cautare ... </option>
              <option value="1">Nume </option>
              <option value="2">Prenume</option>
              <option value="3">Functie</option>
              <option value="4">Numar de marca</option>  
            </select>
          <input type="text" name="valoare" class="form-control" required>
           <input type="submit" name="submit" value=" Submit " class='btn btn-default'>
          </div>
         </form>
    </div>  
</div>

<?php
if(!(isset($_POST['submit']))){
$mysql="SELECT DISTINCT TOP 10 users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', teste_date_de_useri.id, teste.nume as 'Test', teste_date_de_useri.data_sustinere, 
teste_date_de_useri.rezultat as 'Promovabilitate'
FROM teste_date_de_useri 
INNER JOIN users ON users.id=teste_date_de_useri.id_user
INNER JOIN teste ON teste.id=teste_date_de_useri.id_test
ORDER BY teste_date_de_useri.id DESC";    
print_r(sqlsrv_errors(),true);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $mysql , $params, $options );
$row_count = sqlsrv_num_rows( $result );
if( $row_count>0 ) include ('include\table.php');    
//
$mysql="SELECT DISTINCT TOP 10 users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', rezultat.id, rezultat.grad as 'Grad', rezultat.rezultat as 'Promovabilitate'
FROM rezultat 
INNER JOIN users ON users.id=rezultat.id_user
ORDER BY rezultat.id DESC";    
print_r(sqlsrv_errors(),true);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $mysql , $params, $options );
$row_count = sqlsrv_num_rows( $result );
if( $row_count>0 ) include ('include\table-rezultate.php');
}
?>

<div class="col-lg-8 col-lg-offset-2">
    <section>
        <hr/>
    </section>
</div>

</body>
</html>




<?php
if(isset($_POST['submit']))
{

include('include\db.php');
$cautare=$_POST['cautare'];
$valoare=$_POST['valoare'];

    
//Cautare dupa numarul comenzii;    
if($cautare==1){
    if(!is_numeric($valoare)) { 
  
    $mysql="SELECT DISTINCT users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', teste_date_de_useri.id, teste.nume as 'Test', teste_date_de_useri.data_sustinere, 
    teste_date_de_useri.rezultat as 'Promovabilitate'
    FROM teste_date_de_useri
    INNER JOIN users ON users.id=teste_date_de_useri.id_user
    INNER JOIN teste ON teste.id=teste_date_de_useri.id_test
    WHERE users.nume like  '%$valoare%'";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table.php');  
    //
    $mysql="SELECT DISTINCT users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', rezultat.id, rezultat.grad as 'Grad', rezultat.rezultat as 'Promovabilitate'
    FROM rezultat
    INNER JOIN users ON users.id=rezultat.id_user
    WHERE users.nume like  '%$valoare%'";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-rezultate.php');            
    }  
    
    else { echo " <script type='text/javascript'>alert('Valoarea introdusa nu corespunde tipului de data cerut. (Nume -> text)')</script>"; echo "<script> location.replace('cautareRezultate.php'); </script>"; }
}
    
//Cautare dupa nume_comanda    
if($cautare==2){
    if(!is_numeric($valoare)) { 
    $mysql="SELECT DISTINCT users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', teste_date_de_useri.id, teste.nume as 'Test', teste_date_de_useri.data_sustinere, 
    teste_date_de_useri.rezultat as 'Promovabilitate'
    FROM teste_date_de_useri
    INNER JOIN users ON users.id=teste_date_de_useri.id_user
    INNER JOIN teste ON teste.id=teste_date_de_useri.id_test
    WHERE users.prenume like  '%$valoare%'";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table.php');   
    //
    $mysql="SELECT DISTINCT users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', rezultat.id, rezultat.grad as 'Grad', rezultat.rezultat as 'Promovabilitate'
    FROM rezultat
    INNER JOIN users ON users.id=rezultat.id_user
    WHERE users.prenume like  '%$valoare%'";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-rezultate.php');
    }

    else { echo " <script type='text/javascript'>alert('Valoarea introdusa nu corespunde tipului de data cerut. (Prenume -> text)')</script>"; echo "<script> location.replace('cautareRezultate.php'); </script>"; }
}     
    
    
//Cautare dupa nume_solicitant;      
if($cautare==3){
    if(!is_numeric($valoare)) { 
    $mysql="SELECT DISTINCT users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', teste_date_de_useri.id, teste.nume as 'Test', teste_date_de_useri.data_sustinere, 
    teste_date_de_useri.rezultat as 'Promovabilitate'
    FROM teste_date_de_useri
    INNER JOIN users ON users.id=teste_date_de_useri.id_user
    INNER JOIN teste ON teste.id=teste_date_de_useri.id_test
    WHERE users.functie like  '%$valoare%'";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table.php');
    //
    $mysql="SELECT DISTINCT users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', rezultat.id, rezultat.grad as 'Grad', rezultat.rezultat as 'Promovabilitate'
    FROM rezultat
    INNER JOIN users ON users.id=rezultat.id_user
    WHERE users.functie like  '%$valoare%'";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-rezultate.php');  
    }

    else { echo " <script type='text/javascript'>alert('Valoarea introdusa nu corespunde tipului de data cerut. (Functie ->  text)')</script>"; echo "<script> location.replace('cautareRezultate.php'); </script>"; }
}     
    
//Cautare dupa Linie
if($cautare==4){
    if(is_numeric($valoare)){
    $mysql="SELECT DISTINCT users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', teste_date_de_useri.id, teste.nume as 'Test', teste_date_de_useri.data_sustinere, 
    teste_date_de_useri.rezultat as 'Promovabilitate'
    FROM teste_date_de_useri
    INNER JOIN users ON users.id=teste_date_de_useri.id_user
    INNER JOIN teste ON teste.id=teste_date_de_useri.id_test
    WHERE users.id='$valoare'";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table.php');
    //
    $mysql="SELECT DISTINCT users.nume as 'Nume', users.prenume as 'Prenume' , users.functie as 'Functie', rezultat.id, rezultat.grad as 'Grad', rezultat.rezultat as 'Promovabilitate'
    FROM rezultat
    INNER JOIN users ON users.id=rezultat.id_user
    WHERE users.id like  '%$valoare%'";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-rezultate.php');  
    }

    else { echo " <script type='text/javascript'>alert('Valoarea introdusa nu corespunde tipului de data cerut. (Numar de marca ->  numar)')</script>"; echo "<script> location.replace('cautareRezultate.php'); </script>"; }
}
    
}
      

?> 