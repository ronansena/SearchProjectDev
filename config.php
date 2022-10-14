<!DOCTYPE html>
<html>
<head>
<script src="js/jquery.js" type="text/javascript" ></script>
<script src="js/scripts.js" type="text/javascript" charset="utf-8"></script>
<!-- Início Bootstrap Sass-->
<link rel="stylesheet" type="text/css" href="css/style-min.css">
<!--fim Bootstrap Sass-->
<link rel="stylesheet" type="text/css" href="css/standard.css" media="screen" />
<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">


<title>Search Project - Configuration</title>
<?php
require ('bin/conexao.php'); 
?>
</head>
<body>  

 <div class="form">    

<form action="bin/saveSearch.php" method="post"> 
<div class="ui inverted large menu">
  <a class="item" href="index.html">Home</a>
  <a class="item" href="config.php" target="_parent">Setting</a>
  <a class="item" href="search.php" target="_parent">Search</a>
  <div class="right menu">	  
		<div class="ui dropdown item">
				Sistemas <i class="dropdown icon"></i>
				<div class="menu"> 
        <a  class="item" href="http://localhost/LearningPHP_EnglishApplication/sentencetestparam.php" target="_parent">English Now</a >
        <a  class="item" href="http://localhost/SearchProjectDev/search.php" target="_parent">Search Project</a >
        <a  class="item" href="http://localhost/controlmoney/index.html" target="_parent">Control Money</a >
<a  class="item" href="http://localhost/controlhealth/searchPreco.php" target="_parent">Control Health</a >
    <a  class="item" href="http://localhost/controlreader/index.html" target="_parent">Control Reader</a >
    <a  class="item" href="http://localhost/controlpass/index.php" target="_parent">Control Pass</a >
				</div>
			</div>
			<a class="item active">Sign Up</a>
	  </div>
	  </div>
<fieldset>
   <legend class='textName'>Configuration</legend>
  <div class="input-list">
   <label class='textName' for="nameLabel" id="idNameLabel">Enter an URL:</label>  <br>
  <input  list="url" name="url">
  <datalist  id="url">
  
<?php
$sql = "SELECT idURL,url,parameter,urlfantasia FROM searchURL";

$query = mysqli_query($conect, $sql);

while ($rows = mysqli_fetch_array($query)) {
$id = $rows['url'];
?>
 <option  style='margin-right:auto width:100%' value='<?php echo $id;?>'>
<?php
;}
?>  
</datalist>    
  </div>
<div class="text-input">
    <br>
    <label class='textName' for="nameLabel" id="idNameLabel">Enter a name of the site:</label> 
    <input type="text" name="site" id="idSite" value="" class="text-input" />

    <br>
      <input type="checkbox" name="privateSite" id="idPrivateSite" value="1" class="check-input" />   
      <label class="check-input" for="namePrivateSite" id="idPrivateSiteLabel">Private</label> 
      <br>
      <br>

     <label class='textName' for="nameLabel" id="idNameLabel">Enter a name:</label>    
      <input type="text" name="name" id="idName" value="" class="text-input" />
      <br>
      <input type="checkbox" name="privateName" id="idPrivateName" value="1" class="check-input" />   
      <label class="check-input" for="namePrivate" id="idPrivateNameLabel">Private</label> 
      <input type="checkbox" name="imageName" id="idImageName" value="1" class="check-input" />   
      <label class="check-input" for="nameImage" id="idImageNameLabel">Image</label> 
      <br>
      <br>

     <label class='textName' for="nameLabel" id="idNameLabel">Enter parameter:</label>  

    <input type="text" name="parametro" id="idParametro" value="" class="text-input" />
    
</div>
<div class="buttonConfig">
    <br />
    <input type="submit" name="save" class="btn btn-primary" id="idSave" value="Save" />  
</div>
</fieldset> 
</form>
</div> 
<script src="semantic/dist/semantic.min.js"></script>
</body>
</html>