<html lang="en" class="">
<meta name="google" content="notranslate">


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
         <form class="form-inline" method="post" action="cautareIntrebari.php" >
          <div class="form-group">
         
            <select class="form-control" name="cautare" required>
              <option value="" disabled selected>Alege criteriu cautare ... </option>
              <option value="1">Tip intrebare </option>
              <option value="2">Grad </option>
              <option value="3">Linia</option>
              <option value="4">Statia</option>
              <option value="5">Nume test</option>  
            </select>
          <input type="text" name="valoare" class="form-control" required>
           <input type="submit" name="submit" value=" Submit " class='btn btn-default'>
          </div>
         </form>
    </div>  
</div>

<?php
include('include\db.php');

if(!(isset($_POST['submit']))){
    $mysql="SELECT DISTINCT TOP 10 teste.nume as 'Nume test', intrebari_teste.intrebare as 'Intrebare', intrebari_teste.varianta1 as 'Raspuns corect' , intrebari_teste.varianta2 as 'Raspuns gresit', intrebari_teste.varianta3 as 'Raspuns gresit', intrebari_teste.id
    FROM intrebari_teste
    LEFT JOIN teste ON teste.id=intrebari_teste.id_test
    ORDER BY intrebari_teste.id DESC";    
    print_r(sqlsrv_errors(),true);
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-intrebari-teste.php');    
    //
    $mysql="SELECT DISTINCT TOP 10 intrebari.general as 'Tip intrebare', intrebari.grad as 'Grad' , linie.nume as 'Linia', statie.nume as 'Statia', intrebari.intrebare as 'Intrebare', intrebari.varianta1 as 'Raspuns corect' , intrebari.varianta2 as 'Raspuns gresit', intrebari.varianta3 as 'Raspuns gresit', intrebari.id
    FROM intrebari 
    LEFT JOIN statie ON statie.id=intrebari.id_statie
    LEFT JOIN linie ON linie.id=statie.id_linie
    ORDER BY intrebari.id DESC";    
    print_r(sqlsrv_errors(),true);
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-intrebari.php');  
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

    
//Cautare dupa tipul intrebarii;    
if($cautare==1){
    if(($valoare[0] == "g") || ($valoare[0] == "G") || ($valoare[0] == "s") || ($valoare[0] == "S")) {
    if(($valoare[0] == "g") || ($valoare[0] == "G"))
    {
        $valoare = 1;
    }
    else if(($valoare[0] == "s") || ($valoare[0] == "S"))
    {
        $valoare = 0;
    }
  
    $mysql="SELECT DISTINCT intrebari.general as 'Tip intrebare', intrebari.grad as 'Grad' , linie.nume as 'Linia', statie.nume as 'Statia', intrebari.intrebare as 'Intrebare', intrebari.varianta1 as 'Raspuns corect' , intrebari.varianta2 as 'Raspuns gresit', intrebari.varianta3 as 'Raspuns gresit', intrebari.id
    FROM intrebari 
    LEFT JOIN statie ON statie.id=intrebari.id_statie
    LEFT JOIN linie ON linie.id=statie.id_linie
    WHERE intrebari.general like  '%$valoare%'";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-intrebari.php');            
    }  
    
    else { echo " <script type='text/javascript'>alert('Valoarea introdusa nu corespunde tipului de data cerut. (Tip intrebare -> generala/speciala)')</script>"; echo "<script> location.replace('cautareIntrebari.php'); </script>"; }
}
    
//Cautare dupa grad    
if($cautare==2){
    if(is_numeric($valoare)) { 

    $mysql="SELECT DISTINCT intrebari.general as 'Tip intrebare', intrebari.grad as 'Grad' , linie.nume as 'Linia', statie.nume as 'Statia', intrebari.intrebare as 'Intrebare', intrebari.varianta1 as 'Raspuns corect' , intrebari.varianta2 as 'Raspuns gresit', intrebari.varianta3 as 'Raspuns gresit', intrebari.id
    FROM intrebari 
    LEFT JOIN statie ON statie.id=intrebari.id_statie
    LEFT JOIN linie ON linie.id=statie.id_linie
    WHERE intrebari.grad='$valoare'"; 
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-intrebari.php');
    }

    else { echo " <script type='text/javascript'>alert('Valoarea introdusa nu corespunde tipului de data cerut. (Grad -> numar)')</script>"; echo "<script> location.replace('cautareIntrebari.php'); </script>"; }
}     
    
    
//Cautare dupa linie;      
if($cautare==3){
    if(!is_numeric($valoare)) { 
    
    $mysql="SELECT DISTINCT intrebari.general as 'Tip intrebare', intrebari.grad as 'Grad' , linie.nume as 'Linia', statie.nume as 'Statia', intrebari.intrebare as 'Intrebare', intrebari.varianta1 as 'Raspuns corect' , intrebari.varianta2 as 'Raspuns gresit', intrebari.varianta3 as 'Raspuns gresit', intrebari.id
    FROM intrebari 
    LEFT JOIN statie ON statie.id=intrebari.id_statie
    LEFT JOIN linie ON linie.id=statie.id_linie
    WHERE linie.nume like  '%$valoare%'";      
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-intrebari.php');  
    }

    else { echo " <script type='text/javascript'>alert('Valoarea introdusa nu corespunde tipului de data cerut. (Linia ->  text)')</script>"; echo "<script> location.replace('cautareIntrebari.php'); </script>"; }
}     
    
//Cautare dupa statie
if($cautare==4){
    if(!is_numeric($valoare)) { 
    
    $mysql="SELECT DISTINCT intrebari.general as 'Tip intrebare', intrebari.grad as 'Grad' , linie.nume as 'Linia', statie.nume as 'Statia', intrebari.intrebare as 'Intrebare', intrebari.varianta1 as 'Raspuns corect' , intrebari.varianta2 as 'Raspuns gresit', intrebari.varianta3 as 'Raspuns gresit', intrebari.id
    FROM intrebari 
    LEFT JOIN statie ON statie.id=intrebari.id_statie
    LEFT JOIN linie ON linie.id=statie.id_linie
    WHERE statie.nume like  '%$valoare%'";      
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-intrebari.php');  
    }

    else { echo " <script type='text/javascript'>alert('Valoarea introdusa nu corespunde tipului de data cerut. (Statia ->  text)')</script>"; echo "<script> location.replace('cautareIntrebari.php'); </script>"; }
}

//Cautare dupa nume test
if($cautare==5){
    if(!is_numeric($valoare)){
    $mysql="SELECT DISTINCT teste.nume as 'Nume test', intrebari_teste.intrebare as 'Intrebare', intrebari_teste.varianta1 as 'Raspuns corect' , intrebari_teste.varianta2 as 'Raspuns gresit', intrebari_teste.varianta3 as 'Raspuns gresit', intrebari_teste.id
    FROM intrebari_teste
    LEFT JOIN teste ON teste.id=intrebari_teste.id_test
    WHERE teste.nume like  '%$valoare%'";       
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\table-intrebari-teste.php');
    }

    else { echo " <script type='text/javascript'>alert('Valoarea introdusa nu corespunde tipului de data cerut. (Nume test ->  text)')</script>"; echo "<script> location.replace('cautareIntrebari.php'); </script>"; }
}
    
}
      

?> 