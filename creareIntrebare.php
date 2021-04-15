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
        <?php
        //redefinirea functiilor pentru afisare
        function afiseaza_raspuns2($valoare2, $valoare3){
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

        function afiseaza_raspuns_c2($valoare2, $valoare3){
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

        echo "<form method='post' action='creareIntrebare.php'>";
        echo "
        <div class='container-fluid'>
                <div class='row'>
                <div class='col-lg-3 col-lg-offset-2'>
                <select style='margin-top:10px;' id='tipProces' class='form-control' name='proces' required > 
                    <option value='' disabled selected>Selecteaza tip intrebare... </option>
                    <option value='0'> Intrebare generala </option>
                    <option value='1'> Intrebare speciala </option>
                </select> 
                </div>
                    <div class='col-lg-1 '>
                        <input type='submit'style='margin-top:10px;' class='btn btn-default'  name='submit' value='Afiseaza formular intrebare' >
                    </div>
                </div>
            </div>
           ";    
        echo "
        </form>";
        echo"<div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
            <section>
                <hr/>
            </section>
        </div>
    </div>
</div>";
        ?>




        <?php
        if(isset($_POST['submit'])){
            if(isset($_POST['proces']))
                $_SESSION['proces']=$_POST['proces'];
            echo '<script>  document.getElementsByName("proces")[0].value='.$_SESSION['proces'].'</script>';
            echo "<div class='col-lg-8 col-lg-offset-2'>
                                            <p style='font: italic bold 18px/30px Arial, serif'>Tip intrebare : ";if($_SESSION['proces']==0) echo "Generala"; else echo"Speciala"; echo "</p>
                                            </div>";

            if($_SESSION['proces']==0){
                echo"    
            <form method='post' action='creareIntrebare.php'>
             <div class='container-fluid'>
                <div class='row'>       
                    <div class='col-lg-8 col-lg-offset-2'>
                        <div class='intrebare' style='color:white'>
                            <input name='1' 'id='myText'  placeholder='Intrebare' type='text' style='border:none; background: transparent; outline: 0;'  />
                        </div>
                    </div>
                </div>
            </div>";
                afiseaza_raspuns_c2('1',"A");
                afiseaza_raspuns2('1',"B");   
                afiseaza_raspuns2('1',"C");
                echo "<div class='col-lg-2 col-lg-offset-2 '>
                        <input type='submit'style='margin-top:10px;' class='btn btn-default'  name='salveaza_intr' value='Salveaza' >
                    </div> </form>";

            }
            if($_SESSION['proces']==1){

                $result =sqlsrv_query($conn,"select distinct nume from grad;");
                $n="nume";

                echo "<form method='post' action='creareIntrebare.php'>";
                echo "
                <div class='container-fluid'>
                <div class='row'>
                <div class='col-lg-2 col-lg-offset-2'>";
                echo"
                <select id='grad' class='form-control' name='grad' style='margin-top:10px;' required > 
                <option value='' disabled selected>Selecteaza grad ... </option>
                <option value='1'>1 </option>
                <option value='2'>2 </option>
                <option value='3'>3</option>
                ";

                echo"</select>";
                echo"
                </div>
                <div class='col-lg-2'>
                    <input type='text' name='linia' placeholder='Linia' required /> 
                </div>
                <div class='col-lg-2'>
                    <input type='text' name='statia' placeholder='Statie de lucru' required /> 
                </div>
                </div>
            </div>
           ";
                echo"    
            <form method='post' action='creareIntrebare.php'>
             <div class='container-fluid'>
                <div class='row'>       
                    <div class='col-lg-8 col-lg-offset-2'>
                        <div class='intrebare' style='color:white'>
                            <input name='1' 'id='myText'  placeholder='Intrebare' type='text' style='border:none; background: transparent; outline: 0;'  />
                        </div>
                    </div>
                </div>
            </div>";
                afiseaza_raspuns_c2('1',"A");
                afiseaza_raspuns2('1',"B");   
                afiseaza_raspuns2('1',"C");
                echo "<div class='col-lg-2 col-lg-offset-2 '>
                        <input type='submit' style='margin-top:10px;' class='btn btn-default'  name='salveaza_intr_s' value='Salveaza' >
                    </div> </form>";
                echo "
        </form>";


            }
            echo"<div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
            <section>
                <hr/>
            </section>
        </div>
    </div>
</div>";    
        }
        if(isset($_POST['salveaza_intr'])){
            $intr=$_POST['1'];
            $vA=$_POST['A1'];
            $vB=$_POST['B1'];
            $vC=$_POST['C1'];
            $err=0;
            if(strlen($intr)>0 && strlen($vA)>0 && strlen($vB)>0 && strlen($vC)>0) { 
                $mysql2 = "INSERT INTO intrebari (general,intrebare, varianta1, varianta2, varianta3) VALUES (1,'$intr', '$vA', '$vB', '$vC')";
                $result3 = sqlsrv_query($conn,$mysql2);
                $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    $txt = $result3 . " - " .  $result3 . "\n";
                    fwrite($myfile, $txt);
                    fclose($myfile); 
                if( $result3 === false ) {
                    $err=1;
                }

            }
            
            if(!(strlen($intr)>0 && strlen($vA)>0 && strlen($vB)>0 && strlen($vC)>0)) echo "<script> confirm('Introduceti intrebarea si cele 3 variante de raspuns.'); </script>";
            else if($err==0) echo "<script> confirm('Intrebarea a fost adaugata cu succes.'); </script>";
        }
        if(isset($_POST['salveaza_intr_s'])){
            $intr=$_POST['1'];
            $vA=$_POST['A1'];
            $vB=$_POST['B1'];
            $vC=$_POST['C1'];
            $grad=$_POST['grad']; 
            $linia=$_POST['linia']; 
            $statia=$_POST['statia']; 
            $err=0;
            if(strlen($intr)>0 && strlen($vA)>0 && strlen($vB)>0 && strlen($vC)>0) {
            $linia_q="IF (NOT EXISTS(SELECT * FROM linie WHERE UPPER(nume) like UPPER('$linia')) ) 
                    BEGIN 
                    INSERT INTO linie(nume) OUTPUT INSERTED.id as 'ID' VALUES('$linia') 
                    END 
                    ELSE 
                    BEGIN 
                    SELECT id as ID from linie where UPPER(nume) like UPPER('$linia')
                    END";
            $linia_result = sqlsrv_query($conn,$linia_q);
            if( $linia_result === false ) {
                die( print_r( sqlsrv_errors(), true));}

            while($row = sqlsrv_fetch_Array($linia_result,SQLSRV_FETCH_ASSOC)){  
                $liniaId=$row['ID'];
            }  
            //echo $liniaId;
            $statia_q="IF (NOT EXISTS(SELECT * FROM statie WHERE UPPER(nume) like UPPER('$statia') AND id_linie=$liniaId) ) 
                    BEGIN 
                    INSERT INTO statie (id_linie, nume) OUTPUT INSERTED.id as 'ID_S' VALUES ('$liniaId','$statia')
                    END 
                    ELSE 
                    BEGIN 
                    SELECT id as ID_S from statie where UPPER(nume) like UPPER('$statia') and id_linie=$liniaId
                    END";

            // $statia_query = "INSERT INTO statie (id_linie, nume) OUTPUT INSERTED.id as 'ID' VALUES ('$liniaId','$statia')";
            $statia_result = sqlsrv_query($conn,$statia_q);
            while($row = sqlsrv_fetch_Array($statia_result,SQLSRV_FETCH_ASSOC)){  
                $statiaId=$row['ID_S'];
            } 
            //echo $statiaId;
            }

            if(strlen($intr)>0 && strlen($vA)>0 && strlen($vB)>0 && strlen($vC)>0) { 
                $mysql2 = "INSERT INTO intrebari (general,grad, id_statie, intrebare, varianta1, varianta2, varianta3) VALUES (0,'$grad','$statiaId','$intr', '$vA', '$vB', '$vC')";
                $result3 = sqlsrv_query($conn,$mysql2);
                if( $result3 === false ) {
                    die( print_r( sqlsrv_errors(), true));
                    $err=1;
                }

            }


            if(!(strlen($intr)>0 && strlen($vA)>0 && strlen($vB)>0 && strlen($vC)>0)) echo "<script> confirm('Introduceti intrebarea si cele 3 variante de raspuns.'); </script>";
            else if($err==0) echo "<script> confirm('Intrebarea a fost adaugata cu succes.'); </script>";        
        }
        ?>



    </body>
</html>



