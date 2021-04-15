 <?php
require ('include\db.php');  

if(isset($_POST['exportGeneral'])){

$start = $_POST['startDate'];
$end = $_POST['endDate'];
$err=0;
if($start>$end) $err=1;

if($err==0){
header("Content-Disposition: attachment; filename=exportTesteGenerale.csv");
header("Content-Type: text/csv");
header("Pragma: no-cache");
header("Expires: 0");

$output='';    

//interogare sql pentru export test general
    
$sql="SELECT users.nume as 'Nume', users.prenume as 'Prenume',users.id, users.functie as 'Functie', teste.nume as 'Test', convert(varchar,teste_date_de_useri.data_sustinere,120), teste_date_de_useri.observatii as 'obs',
CASE WHEN teste_date_de_useri.rezultat=1 THEN 'Promovat'
     WHEN teste_date_de_useri.rezultat=0  THEN 'Nepromovat'
ELSE 'Error!!!'
END AS 'Promovabilitate' 
FROM teste_date_de_useri
INNER JOIN users ON users.id=teste_date_de_useri.id_user
INNER JOIN teste ON teste.id=teste_date_de_useri.id_test
WHERE teste_date_de_useri.data_sustinere >= '".$start." 00:00:01' AND '".$end." 23:59:59' >= teste_date_de_useri.data_sustinere";

$result = sqlsrv_query($conn,$sql);

$out = fopen("php://output", 'w');
$header = array("Nume", "Prenume", "Numar marca", "Functie", "Test", "Data sustinere", "Observatii", "Promovabilitate"); 
fputcsv($out, $header);

while ($row = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){
    fputcsv($out, $row);
}

}
else{
    echo "<script type='text/javascript'>alert('Data de inceput trebuie sa fie mai mica sau egala cu data finala')</script>";
    echo "<script> location.replace('exportPage.php'); </script>";
}
}

if(isset($_POST['exportOperator'])){

$start = $_POST['startDate'];
$end = $_POST['endDate'];
$err=0;
if($start>$end) $err=1;

if($err==0){
header("Content-Disposition: attachment; filename=exportTesteOperatori.csv");
header("Content-Type: text/csv");
header("Pragma: no-cache");
header("Expires: 0");

$output='';    

//interogare sql pentru export operator
    
$sql="SELECT users.nume as 'Nume', users.prenume as 'Prenume',users.id, users.functie as 'Functie', rezultat.grad as 'Grad', linie.nume as 'Linia', statie.nume as 'Statia', convert(varchar,rezultat.data_sustinere,120), rezultat.observatii as 'obs',
CASE WHEN rezultat.rezultat=1 THEN 'Promovat'
     WHEN rezultat.rezultat=0  THEN 'Nepromovat'
ELSE 'Error!!!'
END AS 'Promovabilitate' 
FROM rezultat
INNER JOIN users ON users.id=rezultat.id_user
INNER JOIN linie ON linie.id=rezultat.id_linie
INNER JOIN statie ON statie.id=rezultat.id_statie
WHERE rezultat.data_sustinere >= '".$start." 00:00:01' AND '".$end." 23:59:59' >= rezultat.data_sustinere";

$result = sqlsrv_query($conn,$sql);    

$out = fopen("php://output", 'w');
$header = array("Nume", "Prenume", "Numar marca", "Functie", "Grad", "Linia", "Statia", "Data sustinere", "Observatii", "Promovabilitate");
fputcsv($out, $header);

while ($row = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){
    fputcsv($out, $row);
}

}
else{
    echo "<script type='text/javascript'>alert('Data de inceput trebuie sa fie mai mica sau egala cu data finala')</script>";
    echo "<script> location.replace('exportPage.php'); </script>";
}
}
?>


