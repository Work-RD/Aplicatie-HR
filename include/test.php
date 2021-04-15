<?php
echo "<style> th, td {
    text-align: center;
} </style>";
echo "
<div clas='row'>
<div class='col-lg-6 col-lg-offset-3'  >
<table class='table table-bordered' style='margin-top:2%; text-align:center'>
      <thead>
      <tr > 
       <th style='vertical-align: middle; text-align: center;' class='col-lg-1'>Intrebare</th>
       <th style='vertical-align: middle; text-align: center;' class='col-lg-1'>Raspuns ales</th>
       <th style='vertical-align: middle; text-align: center;' class='col-lg-1'>Raspuns corect</th>
      </tr>
    </thead>";
    
     
      while ($array = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC))
    {
      
        

        print "</td> <td style='vertical-align: middle;text-align: center;'>";
        echo $array['Intrebare'];
        
        print "</td> <td style='vertical-align: middle;text-align: center;'>";
        echo $array['Varianta aleasa'];
       
        print "</td>";
        print "<td style='vertical-align: middle;text-align: center;'> ";    
        echo $array['Raspuns Corect'];  
        print "</td></tr> ";  }    
            
            

   
            
       
echo "
</table>
</div>
</div>";  
 
?>