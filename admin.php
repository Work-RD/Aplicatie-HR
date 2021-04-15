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

<?php


include('include\db.php');


  
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
      

?> 

<div class="col-lg-8 col-lg-offset-2">
    <section>
        <hr/>
    </section>
</div>

</body>
</html>




