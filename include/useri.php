<?php
echo "<style> th, td {
    text-align: center;
} </style>";

echo "
<div clas='row'>
<div class='col-lg-6 col-lg-offset-3'  >
<table class='table table-bordered' >
      <thead>
      <tr > 
       <th style='vertical-align: middle;' class='col-lg-1'>Id </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Cont utilizator </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Privilegii </th>
       
      </tr>
    </thead>";
    
     
      while ($array = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC))
    {
      
        
            
        print "<tr > <td style='vertical-align: middle;'>";
        echo $array['id']; 
        print "</td> <td style='vertical-align: middle;'>";
        echo $array['nume']; 
       
        print "</td> <td style='vertical-align: middle;'>";
        if($array['privilegii']==1) echo "Admin";
        if($array['privilegii']==0) echo "User";  
        print "</td>";
     
        print "</tr> ";  }    
            
            
            
            
   
            
       
echo "
</table>
</div>
</div>";  
 
?>