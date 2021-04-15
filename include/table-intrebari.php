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
       <th colspan='8' style='font-size:30px'>Intrebari generale </th>
      </tr>
      <tr > 
       <th style='vertical-align: middle;' class='col-lg-1'>Tip intrebare </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Grad </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Linia </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Statia </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Intrebare </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Raspuns corect </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Raspuns gresit </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Raspuns gresit </th>
      </tr>
    </thead>";
    
     
      while ($array = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC))
    {
      
        
        
        print "<tr > <td style='vertical-align: middle;'>";
        if($array['Tip intrebare']==1) echo "Generala";
        if($array['Tip intrebare']==0) echo "Speciala";  
        print "</td> <td style='vertical-align: middle;'>";
        if($array['Grad']) echo $array['Grad'];
        else echo "-";
        print "</td> <td style='vertical-align: middle;'>";
        if($array['Linia']) echo $array['Linia'];
        else echo "-";
        print "</td> <td style='vertical-align: middle;'>";
        if($array['Statia']) echo $array['Statia'];
        else echo "-";
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