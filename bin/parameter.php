<?php
   require ('conexao.php'); 

   
   $baseDir = "/";
   //$baseDir = "file:///C:/wamp64/www/";
 
    //$abreDir = ($_GET['dir'] != '' ? $_GET['dir'] : $baseDir);
    $abreDir = "../image/";
 
    $openDir = dir($abreDir);
 
    $strdir = strpos(substr($abreDir,0,-1),'/') ;
    $backdir = substr($abreDir,0,$strdir+1);
 $i=0;
 $data = array();
  
 if(isset($_POST['checkTextArchivedNames'])){

   $checkTextArchivedNames =  $_POST['checkTextArchivedNames']; 

 }

 if(isset($_POST['checkTextArchivedUrl'])){

   $checkTextArchivedUrl =  $_POST['checkTextArchivedUrl'];        
 
}

   $opcao = $_POST['opcao'];

   $json_array  = array();

   function beginsWith( $str, $sub ) {
      return ( substr( $str, 0, strlen( $sub ) ) == $sub );
  }

  if(isset($_POST['name']) && !is_numeric($_POST['name']) &&  $checkTextArchivedNames=="0" ){
   $name = trim($_POST['name']);

   $q1 = "select name FROM searchname 
   where name='$name' and filed=0
   and filed=0 limit 1";

   $result1 =  mysqli_query($conect,$q1);  
  
  while($row1 = mysqli_fetch_all($result1)){
     
    $json_array['name']  = $row1;      

   } 

// inicio popup
while($arq = $openDir -> read()):  
 
if($arq != '.' && $arq != '..'):

   for($i=0;$i<sizeof($json_array['name']);$i++){

      $imagePathTest = $json_array['name'][$i][0].".jpg";

      if(strcmp($imagePathTest,$arq)==0){

          $json_array['name'][$i][2]="image/".$arq;
         break 1;
      }else if(!isset($json_array['name'][$i][2])){
         $json_array['name'][$i][2]="";
      }      
   }
endif;

endwhile; 

$openDir->close(); 

for($i=0;$i<sizeof($json_array['name']);$i++){

if(!isset($json_array['name'][$i][2])){
   $json_array['name'][$i][2]="";
}      
}
// fim  popup

   if(count($json_array) > 0){
      $json_array['result'] = 'ok';                 
   }else{
      $json_array['message'] = 'Nenhum registro encontrado em nosso banco de dados!';           
   }
   echo json_encode($json_array);      
}

   if(isset($_POST['name']) && !is_numeric($_POST['name']) &&  $checkTextArchivedNames=="1" ){
      $name = trim($_POST['name']);

      $q1 = "select name FROM searchname 
      where name='$name' and filed=1
      and filed=1 limit 1";

      $result1 =  mysqli_query($conect,$q1);  
     
     while($row1 = mysqli_fetch_all($result1)){
        
       $json_array['name']  = $row1;      

      } 

// inicio popup
while($arq = $openDir -> read()):  
    
   if($arq != '.' && $arq != '..'):

      for($i=0;$i<sizeof($json_array['name']);$i++){

         $imagePathTest = $json_array['name'][$i][0].".jpg";

         if(strcmp($imagePathTest,$arq)==0){

             $json_array['name'][$i][2]="image/".$arq;
            break 1;
         }else if(!isset($json_array['name'][$i][2])){
            $json_array['name'][$i][2]="";
         }      
      }
   endif;
  
endwhile; 

$openDir->close(); 

for($i=0;$i<sizeof($json_array['name']);$i++){

   if(!isset($json_array['name'][$i][2])){
      $json_array['name'][$i][2]="";
   }      
}
// fim  popup

      if(count($json_array) > 0){
         $json_array['result'] = 'ok';                 
      }else{
         $json_array['message'] = 'Nenhum registro encontrado em nosso banco de dados!';           
      }
      echo json_encode($json_array);      
   }

   if(isset($_POST['url'])&& is_numeric($_POST['name']) &&  $checkTextArchivedUrl == "0" ){
      
      $url = trim($_POST['url']);

      $q1 = "select parameter from searchurl where filed=0 and idURL='$url' limit 1";
      $q2 = "select idURL from searchurl where filed=0 and idURL='$url' limit 1";

 $result1 =  mysqli_query($conect,$q1);
 $result2 =  mysqli_query($conect,$q2);

 //$json_array  = array();

while($row1 = mysqli_fetch_all($result1)){
   $json_array['parameter']  = $row1;
} 

while($row2 = mysqli_fetch_all($result2)){
   $json_array['idURL']  = $row2;
} 


if(count($json_array) > 0){
   $json_array['result'] = 'ok'; 
          
}else{
   $json_array['message'] = 'Nenhum registro encontrado em nosso banco de dados!';  
   
}
echo json_encode($json_array);

}
   
if(isset($_POST['url'])&& is_numeric($_POST['name']) &&  $checkTextArchivedUrl == "1" ){
      
      $url = trim($_POST['url']);

      $q1 = "select parameter from searchurl where filed=1 and idURL='$url' limit 1";
      $q2 = "select idURL from searchurl where filed=1 and idURL='$url' limit 1";

 $result1 =  mysqli_query($conect,$q1);
 $result2 =  mysqli_query($conect,$q2);

 //$json_array  = array();

while($row1 = mysqli_fetch_all($result1)){
   $json_array['parameter']  = $row1;
} 

while($row2 = mysqli_fetch_all($result2)){
   $json_array['idURL']  = $row2;
} 


if(count($json_array) > 0){
   $json_array['result'] = 'ok'; 
          
}else{
   $json_array['message'] = 'Nenhum registro encontrado em nosso banco de dados!';  
   
}
echo json_encode($json_array);

}

if(isset($_POST['name_Private'])){
   if($_POST['name_Private'] == 1 || $_POST['name_Private'] == 0){
   
   $name_Private = trim($_POST['name_Private']);
   $privateName = trim($_POST['name_Private']);

   if( $checkTextArchivedUrl =="0"){
         
      $sql1 = "SELECT idURL,url,parameter,urlfantasia,private FROM searchurl where filed=0 and private=$privateName order by urlfantasia";

   }else{

      $sql1 = "SELECT idURL,url,parameter,urlfantasia,private FROM searchurl where filed=1 and private=$privateName order by urlfantasia";

   }
    
   
   
   if(strcmp($opcao,"prioridade") == 0 ){

      if( $checkTextArchivedNames =="0"){
      
         $sql2 = "SELECT name,private FROM searchname where filed=0 and private=$privateName order by countOrder desc,name" ;

      }else{

         $sql2 = "SELECT name,private FROM searchname where filed=1 and  private=$privateName order by countOrder desc,name" ;

      }   
   }else if(strcmp($opcao,"name") == 0 ){
   
      if( $checkTextArchivedNames =="0"){
         
         $sql2 = "SELECT name,private FROM searchname where filed=0 and private=$privateName order by name" ;

      }else{

         $sql2 = "SELECT name,private FROM searchname where filed=1 and private=$privateName order by name" ;

      }    
   
   }
   
   
   $result1 =  mysqli_query($conect,$sql1); 
   $result2 =  mysqli_query($conect,$sql2);
   
   $json_array1  = array();
   
   while($row1 = mysqli_fetch_all($result1)){
      $json_array1['url']  = $row1;
   } 
   $i = 0;
   while($row2 = mysqli_fetch_all($result2)){
   
      $json_array1['name'] = $row2;
     
      
   } 
   // inicio popup
   if(!empty($json_array1['name'])){

      while($arq = $openDir -> read()):  
         
         if($arq != '.' && $arq != '..'):
      
      
            for($i=0;$i<sizeof($json_array1['name']);$i++){
      
               $imagePathTest = $json_array1['name'][$i][0].".jpg";
      
               if(strcmp($imagePathTest,$arq)==0){
      
                  $json_array1['name'][$i][2]="image/".$arq;
                  break 1;
               }else if(!isset($json_array1['name'][$i][2])){
                  $json_array1['name'][$i][2]="";
               }      
            }
         endif;
      
      endwhile; 
         
      $openDir->close(); 
      
      for($i=0;$i<sizeof($json_array1['name']);$i++){
      
         if(!isset($json_array1['name'][$i][2])){
            $json_array1['name'][$i][2]="";
         }      
      }
}
   // fim  popup
   
   if(count($json_array1) > 0){
      $json_array1['result'] = 'ok'; 
             
   }else{
      $json_array1['message'] = 'Nenhum registro encontrado em nosso banco de dados!';  
      
   }
   echo json_encode($json_array1);
   mysqli_close($conect);
   
   }
   }



 ?>
