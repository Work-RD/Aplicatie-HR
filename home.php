<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <?php include ('include/library.php');
  session_start();
  if($_SESSION['user']!=1)   echo "<script> location.replace('error.php'); </script>";?>   

    <style>
    



@import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);

.jumbotron h1 {
	color: #353535;
}

span.icon {
	margin: 0 5px;
	color: #D64541;
}
h2 {
	color: #BDC3C7;
  text-transform: uppercase;
  letter-spacing: 1px;
}
.mrng-60-top {
	margin-top: 60px;
}
/* Global Button Styles */
a.animated-button:link, a.animated-button:visited {
	position: relative;
	display: block;
	margin: 30px auto 0;
	padding: 14px 15px;
	color: #111;
	font-size:15px;
	font-weight: bold;
	text-align: center;
	text-decoration: none;
	text-transform: uppercase;
	overflow: hidden;
	letter-spacing: .08em;
	border-radius: 0;
	text-shadow: 0 0 1px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(0, 0, 0, 0.2);
	-webkit-transition: all 1s ease;
	-moz-transition: all 1s ease;
	-o-transition: all 1s ease;
	transition: all 1s ease;
   /* box-shadow: 5px 5px 2px slategray ; */
    
}
a.animated-button:link:after, a.animated-button:visited:after {
	content: "";
	position: absolute;
	height: 0%;
	left: 50%;
	top: 50%;
	width: 150%;
	z-index: 0;
	-webkit-transition: all 0.75s ease 0s;
	-moz-transition: all 0.75s ease 0s;
	-o-transition: all 0.75s ease 0s;
	transition: all 0.75s ease 0s;
}
a.animated-button:link:hover, a.animated-button:visited:hover {
	color: #111;
	text-shadow: none;
}
a.animated-button:link:hover:after, a.animated-button:visited:hover:after {
	height: 450%;
}
a.animated-button:link, a.animated-button:visited {
	position: relative;
	display: block;
	margin: 30px auto 0;
	padding: 14px 15px;
	color: #111;
	font-size:15px;
	border-radius: 0;
	font-weight: bold;
	text-align: center;
	text-decoration: none;
    
	text-transform: uppercase;
	overflow: hidden;
	letter-spacing: .08em;
	text-shadow: 0 0 1px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(0, 0, 0, 0.2);
	-webkit-transition: all 1s ease;
	-moz-transition: all 1s ease;
	-o-transition: all 1s ease;
	transition: all 1s ease;
}

/* Sandy Buttons */

a.animated-button.sandy-one {
	border: 3px solid #004F9F;
	color: #111;
}
a.animated-button.sandy-one:after {
	border: 3px solid #004F9F;
	opacity: 0;
	-moz-transform: translateX(-50%) translateY(-50%);
	-ms-transform: translateX(-50%) translateY(-50%);
	-webkit-transform: translateX(-50%) translateY(-50%);
	transform: translateX(-50%) translateY(-50%);
	
}
a.animated-button.sandy-one:hover:after {
	height: 120% !important;
	opacity: 1;
	color: #FFF;
}
a.animated-button.sandy-two {
	border: 3px solid #004F9F;
	color: #111;
}
a.animated-button.sandy-two:after {
	border: 3px solid #004F9F;
	opacity: 0;
	-moz-transform: translateY(-50%) translateX(-50%) rotate(90deg);
	-ms-transform: translateY(-50%) translateX(-50%) rotate(90deg);
	-webkit-transform: translateY(-50%) translateX(-50%) rotate(90deg);
	transform: translateY(-50%) translateX(-50%) rotate(90deg);
}
a.animated-button.sandy-two:hover:after {
	height: 600% !important;
	opacity: 1;
	color: #111;
}
a.animated-button.sandy-three {
	border: 3px solid #004F9F;
	color: #111;
}
a.animated-button.sandy-three:after {
	border: 3px solid #004F9F;
	opacity: 0;
	-moz-transform: translateX(-50%) translateY(-50%) rotate(-25deg);
	-ms-transform: translateX(-50%) translateY(-50%) rotate(-25deg);
	-webkit-transform: translateX(-50%) translateY(-50%) rotate(-25deg);
	transform: translateX(-50%) translateY(-50%) rotate(-25deg);
}
a.animated-button.sandy-three:hover:after {
	height: 400% !important;
	opacity: 1;
	color: #111;
}
a.animated-button.sandy-four {
	border: 3px solid #004F9F;
	color: #111;
}
a.animated-button.sandy-four:after {
	border: 3px solid #004F9F;
	opacity: 0;
	-moz-transform: translateY(-50%) translateX(-50%) rotate(25deg);
	-ms-transform: translateY(-50%) translateX(-50%) rotate(25deg);
	-webkit-transform: translateY(-50%) translateX(-50%) rotate(25deg);
	transform: translateY(-50%) translateX(-50%) rotate(25deg);
}
a.animated-button.sandy-four:hover:after {
	height: 400% !important;
	opacity: 1;
	color: #111;
}


        body{
            background-color: #F2F2F2;

        }

    </style>    
 

    </head>
    
<body >
   <div class='container-fluid'>
        <div class='row' style="background-color:white;">
            <div class='col-lg-1 '>
                <img src='sigla.jpg'>
            </div>

		<a href='logout.php'><button class='btn btn-blue btn-border-o' style="float:right">Deconectare</button></a>   
        </div>
       </div> 
   
       
  <div class="container" >
  <div class="row" style="margin-top:20%;  padding-bottom: 5%; " >
    
    <div class="col-lg-5 col-lg-offset-1">  <?php echo '<a href="testareOperator.php" class="btn btn-sm animated-button sandy-two">Test operator</a>'?> </div>
	<div class="col-lg-5 "> <?php echo '<a href="user.php" class="btn btn-sm animated-button sandy-one">Test general</a>' ?> </div>
    </div>  
   
  </div>
  </div>
      
    
</body>
</html>