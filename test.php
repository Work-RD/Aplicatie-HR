<!DOCTYPE html>
<html class="">


<head>
    <?php require("include/library.php");
    require("include/db.php");
    session_start();
    ?>
</head>
<body>

<?php include('include/menuAdmin.php'); ?>

<div class="col-lg-8 col-lg-offset-2">
    <section>
        <hr/>
    </section>
</div>




</body>
</html>




<?php
if(isset($_POST['vezi_test']))
{

include('include\db.php');

$id=$_POST['id'];    
    
 $mysql="SELECT istoric_teste.id_test_history as 'id', intrebari_teste.intrebare  as 'Intrebare', 
            CASE WHEN istoric_teste.raspuns_ales LIKE 'varianta1' THEN intrebari_teste.varianta1
            WHEN istoric_teste.raspuns_ales LIKE 'varianta2' THEN intrebari_teste.varianta2
			WHEN istoric_teste.raspuns_ales LIKE 'varianta3' THEN intrebari_teste.varianta3
                             ELSE 'Error!!!'
       END AS 'Varianta aleasa',
intrebari_teste.varianta1 as 'Raspuns Corect'
           
FROM istoric_teste

INNER JOIN teste_date_de_useri ON teste_date_de_useri.id=istoric_teste.id_test_history
INNER JOIN intrebari_teste ON intrebari_teste.id=istoric_teste.id_intrebare

WHERE istoric_teste.id_test_history='$id' ";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\test.php');
    
    

echo "<div class='col-lg-8 col-lg-offset-2'>
    <section>
        <hr/>
    </section>
</div>";
}

if(isset($_POST['vezi_test_operator']))
{

include('include\db.php');

$id=$_POST['id'];    
    
 $mysql="SELECT istoric.id_rezultat as 'id', intrebari.intrebare  as 'Intrebare', 
 CASE WHEN istoric.raspuns_ales LIKE 'varianta1' THEN intrebari.varianta1
 WHEN istoric.raspuns_ales LIKE 'varianta2' THEN intrebari.varianta2
 WHEN istoric.raspuns_ales LIKE 'varianta3' THEN intrebari.varianta3
                  ELSE 'Error!!!'
END AS 'Varianta aleasa',
intrebari.varianta1 as 'Raspuns Corect'

FROM istoric

INNER JOIN rezultat ON rezultat.id=istoric.id_rezultat
INNER JOIN intrebari ON intrebari.id=istoric.id_intrebare

WHERE istoric.id_rezultat='$id' ";    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query( $conn, $mysql , $params, $options );
    $row_count = sqlsrv_num_rows( $result );
    if( $row_count>0 ) include ('include\test.php');
    
    

echo "<div class='col-lg-8 col-lg-offset-2'>
    <section>
        <hr/>
    </section>
</div>";
}


?> 