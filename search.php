<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/phones.css"media="screen and (min-width: 320px) and (orientation: portrait)">
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>

<meta charset=utf-8>
<!-- Início Local-->
<link rel="stylesheet" type="text/css" href="css/standard.css" media="screen" />
<!--fim Local-->
<!-- Início Bootstrap Sass-->
<link rel="stylesheet" type="text/css" href="css/style-min.css">
<!--fim Bootstrap Sass-->

<!-- Início semantic-->
<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
<!-- fim semantic-->
<script src="js/jquery.js" type="text/javascript" ></script>

<!--fim Local-->
<!-- Início semantic--> 

<!-- fim semantic-->

</head>
<body onload="loadCheckNameUrl()">
  
<div class=" divForm"> 
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
  

<div class="painelGeral">  

<div class="painelMarcadoDesmarcado">	
  <div class='divDesmarcado'>  
      <label class="containerRadioAll">Desmarcado
      <input class='radioDesmarcado' type='radio' name='radioDesmarcado'  value='' onclick="DesmarcarTodosCheck()" checked><span class="checkmarkRadio"></span></label>
  </div>
  <div class="divMarcado">
      <label class="containerRadioAll">Marcado
      <input class='radioMarcado' type='radio' name='radioMarcado' value='' onclick="MarcarTodosCheck()"><span class="checkmarkRadio"></span></label>
   </div>
</div> 
<!-- fim painelMarcadoDesmarcado-->
 <!-- inicio checkBuscaAleatoria-->
<div class='checkTextBuscaAleatoria'> 
     <input class="text" type='text' name='ckbname[]' id='' value=''>

     <label>Radom search:</label>
     <input class="checkText" type='checkbox' name='checkText' id=''   value='' onclick='CheckBuscaAleatoria()'>

     <label class='checkTextArchivedUrl'>Show archived url:</label>
     <input class='checkTextArchivedUrl' type='checkbox' id="IdCheckTextArchivedUrl" name='checkTextArchivedUrl' id=''   value=''>

     <label class='checkTextArchivedNames'>Show archived names:</label>
     <input class='checkTextArchivedNames' type='checkbox' id="IdCheckTextArchivedNames" name='checkTextArchivedNames' id=''   value=''>

</div> <!-- fim checkBuscaAleatoria-->
 <div  class='checkPrivate'> <!-- inicio checkPrivate-->
     <label class="selectorPrivateLabel" for="namePrivate" id="idPrivateNameLabel">Private:</label> 
      <input type="checkbox" name="privateName" id="idPrivateName" value="" class="classPrivateName" onmouseover="senha();" />   
  </div> <!-- fim checkPrivate-->

<div class="painelOrdenacao">	
    <label class="selectorOrdenacaoLabel" for="nameOrdenacao" id="idOrdenacaoNameLabel">Order Names:</label>   
    <input class='radioPrioridade' id="radioOrder" type='radio' name='radioPrioridade'  value='prioridade' onclick=" sessionStorage.setItem('radioOrderOption','prioridade'); orderName('prioridade');" checked>
    <label class="labelOrdenacao">Prioridade</label>    
    <input class='radioNome' id="radioOrder"  type='radio' name='radioNome' value='name' onclick=" sessionStorage.setItem('radioOrderOption','name'); orderName('name');">
    <label class="labelOrdenacao">Nome</label>    
</div> 

<div class="painelEsquerdo"> 
	<div class="nameDiv">	
     <div id="legendURL" class="textURL"></div>	
     <div id="checkUrlContent" class="check"></div>     
</div>  <!--nameDiv URL-->
</div><!-- fim painelEsquerdo-->
<div class="painelDireito">
<div class="nameDiv">
  <div id="legendNames" class="textName"></div>	
  <div id="checkNameContent" class="check"></div>	
 <!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">
  <img class="modal-content" id="img01"></span>
  <div id="caption"></div>
</div>

</div>  <!--nameDiv-->
</div>    <!-- fim painelDireito--> 
<div class="DivRodape"> 
 
<!--    <button  type="submit" name="deletar" class="buttonDeletar" id="deletar" value="deletar" onclick="return confirm('Tem certeza que deseja DELETAR os registros selecionados?')">Deletar</button> -->
<button  type="submit" name="deletar" class="btn btn-danger btn-left" id="deletar" value="deletar" onclick="return confirm('Tem certeza que deseja DELETAR os registros selecionados?')">Delete</button> 
    
<!--  <button  type="submit" name="search" class="button" id="search" value="Search">Search</button> -->
<button  type="submit" name="unfiled" class="btn btn-primary " id="unfiled" value="unfiled" onclick="return confirm('Tem certeza que deseja desarquivar os registros selecionados?')">Unarchive</button> 
   
<!--  <button  type="submit" name="search" class="button" id="search" value="Search">Search</button> -->
<button  type="submit" name="filed" class="btn btn-primary btn-md" id="filed" value="Filed" onclick="return confirm('Tem certeza que deseja arquivar os registros selecionados?')">Archive</button> 

<!--  <button  type="submit" name="search" class="button" id="search" value="Search">Search</button> -->
<button  type="submit" name="search" class="btn btn-success btn-right" id="search" value="Search">Search</button>  
</div>
</div> 

<script>

// TRATAMENTO PARA MARCAR O PARÂMETRO AUTOMATICAMENTE AO MARCAR A URL
  function getParameter(value_check){  

  if(!sessionStorage.getItem("checkTextArchivedNames") == "" ){
    
    var checkTextArchivedNames = sessionStorage.getItem("checkTextArchivedNames");

  }else{

    var checkTextArchivedNames = 0;

  }

  if(!sessionStorage.getItem("checkTextArchivedUrl") == "" ){

    var checkTextArchivedUrl = sessionStorage.getItem("checkTextArchivedUrl");

  }else{

    var checkTextArchivedUrl = 0;

}
 
    var radioOrderOption = $('#radioOrder').val();   
  
    
    if(radioOrderOption == null){
      radioOrderOption = "prioridade";
    }

    sessionStorage.setItem("radioOrderOption",radioOrderOption);
    sessionStorage.setItem("checkTextArchivedNames",checkTextArchivedNames);
    sessionStorage.setItem("checkTextArchivedUrl",checkTextArchivedUrl);

      $.ajax({
          url: 'bin/parameter.php',
          method: 'POST',
          dataType: 'json',
          data: {  "url": value_check ,"name": value_check,"opcao":radioOrderOption,"checkTextArchivedNames":checkTextArchivedNames,"checkTextArchivedUrl":checkTextArchivedUrl},
        }).done(function(data){
          if (data.result == 'ok'){ 
            
          if(data.idURL !== undefined){
            // trata sessão para manter os elementos já selecionados marcado ao recarregar a página  
           for(var i = 0; i<Object.keys(data.idURL).length; i++){              
             
              if($('#'+data.idURL[i][0]).is(":checked") == true ){
               sessionStorage.setItem(data.idURL[i][0],data.idURL[i][0]); 
              }
              
                if($('#'+data.idURL[i][0]).is(":checked") ==false ){
                sessionStorage.removeItem(data.idURL[i][0],data.idURL[i][0]); 
              }
           }
          }

          if(data.name !== undefined){ 

                for(var i = 0; i<Object.keys(data.name).length; i++){              
                  
                  var dataName = data.name[i][0].replace( /\s/g, '' );
                  
                  if($('#'+dataName).is(":checked") == true ){
                  sessionStorage.setItem(dataName,dataName); 
                  }
                  
                  if($('#'+dataName).is(":checked") ==false ){
                    sessionStorage.removeItem(dataName,dataName); 
                  }
              }
          }    
//  Fim trata sessão para manter os elementos já selecionados marcado ao recarregar a página
          if(data.parameter){
            for(var i = 0; i<Object.keys(data.parameter).length; i++){
              if($('#'+data.idURL[i][0]).is(":checked") && data.parameter[i][0] != ""){
                 
                  document.getElementById(data.parameter[i][0]).checked = true; 
                  sessionStorage.setItem(data.parameter[i][0],data.parameter[i][0]);

                } else if (data.parameter[i][0] != ""){
                  
                  document.getElementById(data.parameter[i][0]).checked = false;
                  sessionStorage.removeItem(data.parameter[i][0],data.parameter[i][0]); 

                }
            } //fim for  
          }         
        if(sessionStorage.getItem("textHabilidadoDesabilitado") == "true" && sessionStorage.length > 0){
        $('.text').prop('disabled', false);
          sessionStorage.setItem("textHabilidadoDesabilitado","true");
      }  else {
          $('.text').prop('disabled', true);
          sessionStorage.setItem("textHabilidadoDesabilitado","false");
      }        
        
        } else{
           alert(data.message);
        }
    }).fail(function(data){ 
        alert("Erro Search");                    
  });           
} 
</script>
<script src="js/scripts.js" type="text/javascript" charset="utf-8"></script>
<script src="semantic/dist/semantic.min.js"></script>
<!-- fim div class painelGeral--> 
</form>
</div> <!-- fim div class form--> 
</body>
</html>