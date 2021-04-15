<?php
require("include/library.php");
session_start();
$id=$_SESSION['teste'];
                $id_i=$id_in;
                require("include/db.php");
                $result =sqlsrv_query($conn,"SELECT * FROM istoric_teste WHERE id_test=".$id." AND id_intrebare=".$id_i."",array(), array( "Scrollable" => 'static' ));
                if( $result === false ) {
                die( print_r( sqlsrv_errors(), true));
                }
                $row_count = sqlsrv_num_rows( $result );
      
                if($row_count==0) { 
                            $result3 =sqlsrv_query($conn,"DELETE FROM intrebari_teste WHERE id_test=".$id." AND id=".$id_i.";");
                            if( $result3 === false ) {
                                die( print_r( sqlsrv_errors(), true));
                            }
                            else echo "<script> confirm('Intrebarea a fost stersa.'); </script>"; 
                          }
               else {  
                    $result3 =sqlsrv_query($conn,"UPDATE intrebari_teste SET indisponibil=1 WHERE id=".$id_i.";");
                    if( $result3 === false ) {
                    die( print_r( sqlsrv_errors(), true));
                    }
                    else echo "<script> confirm('Intrebarea a fost stersa.'); </script>";
               }


?>