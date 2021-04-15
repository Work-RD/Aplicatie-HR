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
       <th colspan='7' style='font-size:30px'>Teste generale</th>
      </tr>
      <tr > 
       <th style='vertical-align: middle;' class='col-lg-1'>Nume </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Prenume </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Functie </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Nume test </th>
       <th style='vertical-align: middle;' class='col-lg-2'>Data sustinere </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Promovabilitate </th>
       <th style='vertical-align: middle;' class='col-lg-1'>Vezi raspunsuri </th>
      </tr>
    </thead>";
    
     
      while ($array = sqlsrv_fetch_Array($result,SQLSRV_FETCH_ASSOC))
    {
      
        
            
        print "<tr > <td style='vertical-align: middle;'>";
        echo $array['Nume']; 
        print "</td> <td style='vertical-align: middle;'>";
        echo $array['Prenume']; 
        print "</td> <td style='vertical-align: middle;'>";
        echo $array['Functie'];
        print "</td> <td style='vertical-align: middle;'>";
        echo $array['Test'];
        print "</td> <td style='vertical-align: middle;'>";
        if($array['data_sustinere']) echo $array['data_sustinere']->format("d-m-Y H:i:s");
        else echo "-";
        print "</td> <td style='vertical-align: middle;'>";
        if($array['Promovabilitate']==1) echo "Promovat";
        if($array['Promovabilitate']==0) echo "Nepromovat";  
        print "</td>";
        print "<td style='vertical-align: middle;'> <form  action='test.php' method='post' >    
                                                    <input type='submit' class='btn btn-default' name='vezi_test' value='Vezi raspunsuri'>  
                                                    <input type='hidden' name='id' value='".$array['id']."'>
                                                    </form> </td>
                                                    </form>  ";    
        print "</tr> ";  }    
            
            
            
            
   
            
       
echo "
</table>
</div>
</div>";  
 
?>