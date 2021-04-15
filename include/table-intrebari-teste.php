<?php
echo "<style> th, td {
    text-align: center;
} </style>";

echo "
<div clas='row'>
<div class='col-lg-8 col-lg-offset-2'  >
<table class='table table-bordered' style='margin-top:2%;'>
      <thead>
      <tr>
       <th colspan='7' style='font-size:30px'>Intrebari teste generale </th>
      </tr>
      <tr > 
       <th style='vertical-align: middle;' class='col-lg-1'>Nume test </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Intrebare </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Raspuns corect </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Raspuns gresit </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Raspuns gresit </th>
      </tr>
    </thead>";
    
     
      while ($array = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC))
    {
      
        
            
        print "<tr > <td style='vertical-align: middle;'>";
        echo $array['Nume test']; 
        print "</td> <td style='vertical-align: middle;'>";
        echo $array['Intrebare']; 
        print "</td> <td style='vertical-align: middle;'>";
        echo $array['Raspuns corect']; 
        print "</td> <td style='vertical-align: middle;'>";
        echo $array['Raspuns gresit'];
        print "</td> <td style='vertical-align: middle;'>";
        echo $array['Raspuns gresit'];
    }    
            
            
            
            
   
            
       
echo "
</table>
</div>
</div>";  
 
?>