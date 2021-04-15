<html>
<head>
    <link rel='stylesheet' href='css/bootstrap.css'>

    <?php
    require('include\db.php');
    session_start();
    
    ?>
    <style>
        body{
            background-color: #F2F2F2;

        }
        #login{
            background-color:#3498db;
            text-align: center; 
        }
        form{
            margin-top: 5%;
            margin-bottom: 10%;
            text-align: center;   
        }
        label{
            color: black;
            margin-right: 5px;
        }
        
        hr{
            width: 75%;
        }
        input[type=text], input[type=password] {
            width: 75%;
            height: 6%;        
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 75%;
            height: 4%;    
            
            
        }
        

    
    </style>    
</head>
<body>
        <div class='container-fluid'>
        <div class='row' style="background-color:white;">
            <div class='col-lg-1 '>
                <img src='sigla.jpg'>
            </div>
            
        </div>
       </div> 
       <div class='container-fluid'>
        <div class="col-lg-4 col-lg-offset-4" id="login" style="color:white;margin-top:10%;"><h4><strong>Conectare la aplicatia
TestareHR</strong></h4></div>
        <div class="col-lg-4 col-lg-offset-4" style="background-color: white">
        
        <form method="post" action="">
            <input type="text" name="username" placeholder="Cont utilizator..."> 
            <input type="password" name="password" placeholder="Parola..."> <br>
            <div style="margin-top:10px; text-align:center;">
            
            <input class='btn btn-primary' type="submit" name="submit" value="Trimite"> <br>
            </div>
        </form>
    </div>
        </div>
        
        
    
</body>
</html>




<?php
    if(isset($_POST['submit'])){
      
        $result =sqlsrv_query($conn,"SELECT * FROM login WHERE nume like '".$_POST['username']."' AND parola like '".$_POST['password']."' ",array(), array( "Scrollable" => 'static' ));
        $row_count = sqlsrv_num_rows( $result );
        if($row_count!=0) {
        while ($array = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC))
        {    
        
        $privilegii=$array['privilegii'];
            
        }
        if($privilegii=='1')  { echo "<script> location.replace('admin.php'); </script>";
                                $_SESSION['admin']=1;
                              }
        else if($privilegii=='0')  {echo "<script> location.replace('home.php'); </script>";
                                     $_SESSION['admin']=0;
                                   }
        }
        else {
            echo "<script>alert('User sau parola gresite!');</script>";
             $_SESSION['admin']=0;
        }
    }
?>