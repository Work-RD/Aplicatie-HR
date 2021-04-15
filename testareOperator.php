<html>
    <head>
        <?php require("include/library.php");
        require("include/db.php");
        session_start();
        function afiseaza_raspuns($valoare,$valoare2,$valoare3){
            echo "
        <div class='container-fluid'>
        <div class='row'>
        <div class='col-lg-7 col-lg-offset-2'>
        <div class='raspuns' style='color:grey'>
        <input type='text' name='rasp' value='".$valoare."' style='border:none; background: transparent; outline: 0;' disabled>
        </div>
        </div>
        <div class='col-lg-1 '>
        <input style='margin-top:20%;' type='radio' required  name='".$valoare2."' value='".$valoare3."' >
        </div> 
        </div>
        </div>";
        }
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



                <div class='col-lg-2 col-lg-offset-3'>
                    <?php if(isset($_POST['submit'])&&$_SESSION['test']!=null) echo "<p style='margin-top: 20px; text-align: right;font-weight: bolder;'>".$_SESSION['test']."</p>"; ?>
                </div>
                <div class="col-lg-2 ">
                    <?php 
                    $count="SELECT COUNT(id) as 'Nr' FROM rezultat";
                    $result = sqlsrv_query($conn,$count);
                    while($row = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){ 
                        $nr=$row['Nr'];   
                    }
                    $nr=$nr+1;
                    echo "<p style='margin-top: 20px; text-align: right;font-weight: bolder;'>Numar test : ".$nr."</p>";
                    ?>
                </div>    
                <div style='border-width: 1px 1px 1px 1px; border-color: #3498db;'>
                    <div class="col-lg-1" style="color:black;margin-top: 20px; text-align: right;font-weight: bolder;" >
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
        <div class='container-fluid'>
            <div class='row'>
                <div class="col-lg-2 col-lg-offset-2"> 
                    <form id="myform" method="post" action="testareOperator.php" id="form">
                        <select id="teste" class='form-control' name="grad" required > 
                            <option value="" disabled selected>Selecteaza grad ... </option>
                            <option value='1'>1 </option>
                            <option value='2'>2 </option>
                            <option value='3'>3 </option>
                        </select> 
                        </div>
                    <?php 
                    $result =sqlsrv_query($conn,"SELECT * FROM linie");
                    ?>
                    <div class='col-lg-2'>
                        <select id='linie' class='form-control' name='linie' required > 
                            <option value="" disabled selected>Selecteaza linia ... </option>
                            <?php while($row1 = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){ ?>
                            <option value="<?php echo $row1['id'];?>"><?php echo $row1['nume'];?></option>
                            <?php } ?>
                        </select>
                    </div>   
                    <div class="col-lg-2">
                        <input style="margin-top:0px" class="btn btn-default" id="myText" value="Continua" name="continua" type="submit" />
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



        <form id='myform-2' method='post' action='testareOperator.php' class="hidden">
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-lg-2 col-lg-offset-2'> 
                        <input required type='text' value="<?php echo (isset($_POST['prenume']) ? $_POST['prenume']:''); ?>" id='prenume' name='prenume' placeholder='Prenume '>
                    </div>
                    <div class='col-lg-2'> 
                        <input required type='text' value="<?php echo (isset($_POST['nume']) ? $_POST['nume']:''); ?>"  id='nume' name='nume' placeholder='Nume '> 
                    </div>
                    <div class='col-lg-2'> 
                        <input required type='text'  value="<?php echo (isset($_POST['functie']) ? $_POST['functie']:''); ?>" id='functie' name='functie' placeholder='Functie '> 
                    </div>
                    <div class='col-lg-2'> 
                        <input required type='text'  value="<?php echo (isset($_POST['nr_marca']) ? $_POST['nr_marca']:''); ?>"id='nr_marca' name='nr_marca' placeholder='Numar de marca '> 
                    </div>
                </div>
            </div>

            <div class='container-fluid'>
                <div class='row'>

                    <?php
                    if((isset($_POST['linie'])) || (isset($_SESSION['linie']))) {
                        if(isset($_POST['linie']))
                        {
                            $linie=$_POST['linie'];
                            $_SESSION['linie']=$linie;
                        }
                        $result =sqlsrv_query($conn,"SELECT * FROM statie where id_linie=".$_SESSION['linie']);}
                    if((isset($_SESSION['grad']) && ($_SESSION['grad']==1 || $_SESSION['grad']==2 || $_SESSION['grad']==3)) || (isset($_POST['grad']) && ($_POST['grad']==1 || $_POST['grad']==2 || $_POST['grad']==3))){ 
                         /*
                         $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                         $txt = $_SESSION['grad'] . " - " .  $_SESSION['linie'] . "\n";
                         fwrite($myfile, $txt);
                         fclose($myfile);
                         */     
                        echo"
                        <div class='col-lg-2 col-lg-offset-2'>
                        <select id='statie' class='form-control' name='statie' required > 
                            <option value='' disabled selected>Selecteaza statia ... </option>";
                        while($row1 = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC)){ 
                            echo "<option value=".$row1['id'].">".$row1['nume']."</option>";
                        } 
                        echo" 
                        </select>
                    </div>

            ";
                    }

                    echo"<div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
            <div class='observatii2'>
                <input id='myText' placeholder='Observatii ' type='text' style='border:none; background: transparent; outline: 0;' name='obs'>
            </div>
        </div>
    </div>
</div>

<div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-1 col-lg-offset-2'>
            <input class='btn btn-default' id='myText' value='Incepe testul!' name='incepe_testul' type='submit' >
        </div>
    </div>    
</div>
</form>
<div class='container-fluid'>
<div class='row'>
    <div class='col-lg-8 col-lg-offset-2'>
        <section>
            <hr/>
        </section>
    </div>
</div>
</div>
";?>
                    <?php



                    if(isset($_POST['continua']) ){
                        $_SESSION['grad']=$_POST['grad'];
                        echo '<script>
                        var element = document.getElementById("myform-2");
                        element.classList.remove("hidden");
                        document.getElementsByName("grad")[0].disabled=true;
                        document.getElementsByName("grad")[0].value='.$_POST['grad'].'
                        document.getElementsByName("linie")[0].disabled=true;
                        document.getElementsByName("linie")[0].value='.$_POST['linie'].'
                        document.getElementsByName("continua")[0].disabled=true</script>';
                    }

                    if(isset($_POST['incepe_testul'])){
                        echo '<script>
                        var element = document.getElementById("myform-2");
                        element.classList.remove("hidden")</script>';
                        
                        $nume=$_POST['nume']; 
                        $prenume=$_POST['prenume'];
                        $functie=$_POST['functie'];
                        $id=$_POST['nr_marca'];
                        $_SESSION['obs']=$_POST['obs'];
                        $obs=$_SESSION['obs'];
                        $grad=$_SESSION['grad'];
                        $_SESSION["id"]=$id; 
                        $statie=$_POST['statie'];
                        $_SESSION['statie']=$statie;

                        $n=0;
                        $p=0;
                        $f=0;
                        $nr=0;
                        if(is_numeric($nume)) $n=1;
                        if(is_numeric($prenume)) $p=1;
                        if(is_numeric($functie)) $f=1;
                        if(!is_numeric($id) || $id>9999999) $nr=1;


                        if($n==0 && $p==0 && $f==0 && $nr==0) { 
                            $verify="IF NOT EXISTS ( SELECT 1 FROM Users WHERE id = '$id' )
                BEGIN
                    INSERT INTO users (id, nume, prenume, functie) VALUES ('$id', '$nume', '$prenume', '$functie')
                END";    
                            $result2 = sqlsrv_query($conn,$verify);



                            if($grad==1){ $nrIntrebariGenerale=5; $nrIntrSpeciale=5;}
                            if($grad==2) { $nrIntrebariGenerale=20; $nrIntrSpeciale=5;}
                            if($grad==3) { $nrIntrebariGenerale=20;$nrIntrSpeciale=5;}
                            

                            $result_g =sqlsrv_query($conn,"SELECT TOP $nrIntrebariGenerale * FROM intrebari where general=1 order by newid()");
                            $result_s =sqlsrv_query($conn,"SELECT TOP $nrIntrSpeciale * FROM intrebari where general=0 and grad=$grad and id_statie='$statie' order by newid()");


                            $intrebari=array();
                            $k=0;

                            while($row = sqlsrv_fetch_Array($result_g,SQLSRV_FETCH_ASSOC)){  
                                echo "<form method='post' action='rezultat.php' id='myform' >";
                                echo "
            <div class='container-fluid'>
            <div class='row'>       
                <div class='col-lg-8 col-lg-offset-2'>
                    <div class='intrebare' style='color:white'>
                        <input name='raspuns' 'id='myText' . value='". $row['intrebare'] . "' type='text' style='border:none; background: transparent; outline: 0;' disabled disabled />
                    </div>
                </div>
            </div>
            </div>";

                                $intrebari[$k]=$row['id'];
                                $k++;
                                $numbers = range(1, 3);
                                shuffle($numbers);
                                foreach ($numbers as $number) {
                                    if($number==1) afiseaza_raspuns($row['varianta1'],$row['id'],"varianta1");
                                    else if($number==2) afiseaza_raspuns($row['varianta2'],$row['id'],"varianta2");
                                    else if($number==3)   afiseaza_raspuns($row['varianta3'],$row['id'],"varianta3");
                                }
                            }
                            while($row = sqlsrv_fetch_Array($result_s,SQLSRV_FETCH_ASSOC)){  
                                echo "
            <div class='container-fluid'>
            <div class='row'>       
                <div class='col-lg-8 col-lg-offset-2'>
                    <div class='intrebare' style='color:white'>
                        <input name='raspuns' 'id='myText' . value='". $row['intrebare'] . "' type='text' style='border:none; background: transparent; outline: 0;' disabled disabled />
                    </div>
                </div>
            </div>
            </div>";

                                $intrebari[$k]=$row['id'];
                                $k++;
                                $numbers = range(1, 3);
                                shuffle($numbers);
                                foreach ($numbers as $number) {
                                    if($number==1) afiseaza_raspuns($row['varianta1'],$row['id'],"varianta1");
                                    else if($number==2) afiseaza_raspuns($row['varianta2'],$row['id'],"varianta2");
                                    else if($number==3)   afiseaza_raspuns($row['varianta3'],$row['id'],"varianta3");
                                }
                            }
                            echo "
    <div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
            <section>
                <hr/>
            </section>
        </div>
    </div>
    </div>";

                            echo "<script>
        function myFunction() {
            if (window.confirm('Esti sigur ca vrei sa finalizezi testul?')) { 
                document.getElementById('submit2').click();
                ". $_SESSION['var']=1 . "    
            }
        }
    </script>";

                            echo "
    <div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-1 col-lg-offset-2'>
            <input style='margin-buttom:20px;' onclick='myFunction()' class='btn btn-default'  value='Finalizeaza!' name='submit3'  >
            <input type='submit' id='submit2' style='visibility: hidden;' name='submit2'>
    </div>
    </form>
</div></div>";

                            echo "<script>
        document.getElementsByName('nume')[0].readOnly=true;
        document.getElementsByName('prenume')[0].readOnly=true;
        document.getElementsByName('functie')[0].readOnly=true;
        document.getElementsByName('nr_marca')[0].readOnly=true;
        document.getElementsByName('obs')[0].readOnly=true;
        document.getElementsByName('incepe_testul')[0].disabled=true;
        </script>";
                            echo '<script>
        document.getElementsByName("grad")[0].disabled=true;
        document.getElementsByName("grad")[0].value='.$_SESSION['grad'].'
        document.getElementsByName("linie")[0].disabled=true;
        document.getElementsByName("linie")[0].value='.$_SESSION['linie'].'
        document.getElementsByName("statie")[0].disabled=true;
        document.getElementsByName("statie")[0].value='.$_SESSION['statie'].'
        document.getElementsByName("obs")[0].value="'.$_SESSION['obs'].'"
        document.getElementsByName("continua")[0].disabled=true</script>';

                        }

                        else {
                            if($n==1) echo "<script type='text/javascript'>alert('Nume invalid!')</script>";
                            if($p==1) echo "<script type='text/javascript'>alert('Prenume invalid!')</script>";;
                            if($f==1) echo "<script type='text/javascript'>alert('Functie invalida!')</script>";
                            if($nr==1) echo "<script type='text/javascript'>alert('Nr. marca invalid!')</script>";
                            if($count!=0) echo "<script type='text/javascript'>alert('Testul nu este disponibil inca.')</script>";
                        }        


                        $_SESSION['intrebari']=$intrebari;
                        $_SESSION['k']=$k;




                    }
                    
                    

                    ?>





                    </body>
                </html>