<html>
    <head>
        <?php require("include/library.php");
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


                <div style='border-width: 1px 1px 1px 1px; border-color: #3498db;'>
                    <div class="col-lg-1 col-lg-offset-8" style="color:black;margin-top: 20px; text-align: right;font-weight: bolder;" >
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
<?php
require("include/library.php");
        require("include/db.php");
        session_start();

if(isset($_POST['submit2'])){
    $k=$_SESSION['k'];
    $intrebari=$_SESSION['intrebari'];
    $gresite=0;
   
    //echo "ID " . $_SESSION['id'];
    //echo "PROCES " . $_SESSION['proces'];
    //echo "GRAD " . $_SESSION['grad'];
    //echo "LINIE " . $_SESSION['linie'];
    
    //echo "STATIE1 " . $_SESSION['statie1'];
    
    
    $id_user=$_SESSION['id'];
    $grad=$_SESSION['grad'];
    $id_linie=$_SESSION['linie'];
    $id_statie=$_SESSION['statie'];
    $obs=$_SESSION['obs'];
    
    //echo $gresite . "gresite"; 
    
    if($gresite>2){
        $val=0;
    }
    else{
        $val=1;
    }
    
    if((isset($_SESSION['grad']) && $_SESSION['grad']==1)){
        $rezultat = "INSERT INTO rezultat (id_user, grad, id_linie, id_statie, rezultat, data_sustinere, observatii) OUTPUT INSERTED.id as 'ID' VALUES ('$id_user', '$grad', '$id_linie' ,'$id_statie', '0', GetDate(),'$obs')";
    }
    if((isset($_SESSION['grad']) && $_SESSION['grad']==2)){
        $rezultat = "INSERT INTO rezultat (id_user, grad, id_linie, id_statie, rezultat, data_sustinere, observatii) OUTPUT INSERTED.id as 'ID' VALUES ('$id_user', '$grad', '$id_linie','$id_statie', '0', GetDate(),'$obs')";
    }
    if((isset($_SESSION['grad']) && $_SESSION['grad']==3)){
         $rezultat = "INSERT INTO rezultat (id_user, grad, id_linie, id_statie, rezultat, data_sustinere, observatii) OUTPUT INSERTED.id as 'ID' VALUES ('$id_user', '$grad', '$id_linie','$id_statie', '0', GetDate(),'$obs')";
    }
    
    
     $result3 = sqlsrv_query($conn,$rezultat);
    
            if( $result3 === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
     while($row = sqlsrv_fetch_Array($result3,SQLSRV_FETCH_ASSOC)){  
            $_SESSION['id_t']=$row['ID'];
     } 
    
     
     $id_t=$_SESSION['id_t'];
    
    for($i=0;$i<$k;$i++){
        //echo " " . $_SESSION['intrebari'][$i] ." " . $_POST[$_SESSION['intrebari'][$i]];
        
        $intr=$_SESSION['intrebari'][$i];
        $raspuns3=$_POST[$_SESSION['intrebari'][$i]];
        
        $mysql2 = "INSERT INTO istoric (id_rezultat, id_intrebare, raspuns_ales) VALUES ('$id_t', '$intr', '$raspuns3')";
            $result3 = sqlsrv_query($conn,$mysql2);
            if( $result3 === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
        if($_POST[$_SESSION['intrebari'][$i]]!="varianta1") $gresite++;
    }
    
    
    if((isset($_SESSION['grad']) && $_SESSION['grad']==1)){
        if($gresite>2) 
        { 
            echo "<div class='container-fluid'><div class='row'><div class='col-lg-8 col-lg-offset-2'><div class='alert alert-warning' style='height:30%;font-size: 250%; text-           align:center; background-color:#ff0000; color: white ;'>
                    <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <div style='text-align:center;margin-top:6%;'> <strong>NU</strong> ai trecut testul! </div>
                  </div></div></div></div>";
            
            $rezultat=0;
        }
    
        else  
        {   
              echo "<div class='container-fluid'><div class='row'><div class='col-lg-8 col-lg-offset-2'><div class='alert alert-success' style='height:30%;font-size: 250%; text-              align:center; background-color:#00cc00; color: white ;'>
                    <a href='#' class='close' data-dismiss='alert'>&times;</a>
                    <div style='text-align:center;margin-top:6%;'> <strong>Felicitari!</strong> Ai trecut testul! </div>
                </div></div></div></div>";
            $rezultat=1;
        }
    }
    if((isset($_SESSION['grad']) && $_SESSION['grad']==2)){
        if($gresite>1) 
        { 
            echo "<div class='container-fluid'><div class='row'><div class='col-lg-8 col-lg-offset-2'><div class='alert alert-warning' style='height:30%;font-size: 250%; text-           align:center; background-color:#ff0000; color: white ;'>
                    <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <div style='text-align:center;margin-top:6%;'> <strong>NU</strong> ai trecut testul! </div>
                  </div></div></div></div>";
            
            $rezultat=0;
        }
    
        else  
        { 
              echo "<div class='container-fluid'><div class='row'><div class='col-lg-8 col-lg-offset-2'><div class='alert alert-success' style='height:30%;font-size: 250%; text-              align:center; background-color:#00cc00; color: white ;'>
                    <a href='#' class='close' data-dismiss='alert'>&times;</a>
                    <div style='text-align:center;margin-top:6%;'> <strong>Felicitari!</strong> Ai trecut testul! </div>
                </div></div></div></div>";
            $rezultat=1;
        }    
    }
    if((isset($_SESSION['grad']) && $_SESSION['grad']==3)){
        if($gresite>0) 
        { 
            echo "<div class='container-fluid'><div class='row'><div class='col-lg-8 col-lg-offset-2'><div class='alert alert-warning' style='height:30%;font-size: 250%; text-           align:center; background-color:#ff0000; color: white ;'>
                    <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <div style='text-align:center;margin-top:6%;'> <strong>NU</strong> ai trecut testul! </div>
                  </div></div></div></div>";
            
            $rezultat=0;
        }
    
        else  
        {  
              echo "<div class='container-fluid'><div class='row'><div class='col-lg-8 col-lg-offset-2'><div class='alert alert-success' style='height:30%;font-size: 250%; text-              align:center; background-color:#00cc00; color: white ;'>
                    <a href='#' class='close' data-dismiss='alert'>&times;</a>
                    <div style='text-align:center;margin-top:6%;'> <strong>Felicitari!</strong> Ai trecut testul! </div>
                </div></div></div></div>";
            $rezultat=1;
        }    
    }

    
        $mysql2 = "UPDATE rezultat SET rezultat='$rezultat' WHERE id='".$_SESSION['id_t']."'";
        $result3 = sqlsrv_query($conn,$mysql2);
          if( $result3 === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
    
    
 
    
}
?>
    </body>
</html>