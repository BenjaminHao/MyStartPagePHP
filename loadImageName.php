<?php
foreach(array_map('basename', glob("./files/" . "*.*", GLOB_BRACE)) as $filename){
     $arr[] = array(         
        'name' => $filename
    ); 
 }
 echo json_encode($arr); 

 ?>