<?php 

 $serverName = "serverName"; 
 $connectionInfo = array( "Database"=>"databaseName", "UID"=>"User", "PWD"=>"Pass");
 $conn = sqlsrv_connect( $serverName, $connectionInfo);

?>