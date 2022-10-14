$(document).ready(function(){  
  //alert('loaded');
  $('.ui.dropdown').dropdown();
 

  if(sessionStorage.getItem("checkText") == "null"){
    $('.text').prop('disabled', true);      
  }
  // anula o comportamento padrão que ao acionar o enter aciona os botões de submit  
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      //event.preventDefault();
      $('#search').click();// e aciona apenas o botão de pesquisa
      return false;
    }
  }); // fim

    //$('.checkText').prop( "checked", false);
   //$('.classPrivateName').prop('checked',true);    


});
// fim document.ready carrega URL e Names Seach Page
  

// indentifica se o botão privado foi acionado e atribui valor ao mesmo
$('#idPrivateName').click(function(){	
  
  var radioOrderOption =  sessionStorage.getItem("radioOrderOption");  

  if(radioOrderOption == null){
    radioOrderOption = "prioridade";
  }

  if ($(this).prop( "checked")){
    sessionStorage.clear();  
      $(this).attr('value', 1);
      sessionStorage.setItem("checkPrivate",1); 
      sessionStorage.setItem("radioOrderOption",radioOrderOption);
  }else{
    sessionStorage.clear();  
      $(this).attr('value', 0);
      sessionStorage.setItem("checkPrivate",0); 
      sessionStorage.setItem("radioOrderOption",radioOrderOption);
  }
  loadCheckNameUrl(radioOrderOption);
}); // fim 	

// indentifica se o botão checkTextArchivedNames foi acionado e atribui valor ao mesmo
$('#IdCheckTextArchivedNames').click(function(){	 
  
  var radioOrderOption =  sessionStorage.getItem("radioOrderOption");  

  if(radioOrderOption == null){
    radioOrderOption = "prioridade";
  }
  
  if ($(this).prop( "checked")){
    
      $(this).attr('value', 1);
      sessionStorage.setItem("checkTextArchivedNames",1); 
      
  }else{
     
      $(this).attr('value', 0);
      sessionStorage.setItem("checkTextArchivedNames",0); 
      
  }

  loadCheckNameUrl(radioOrderOption);

}); // fim 

// indentifica se o botão IdCheckTextArchivedUrl foi acionado e atribui valor ao mesmo
$('#IdCheckTextArchivedUrl').click(function(){	

    var radioOrderOption =  sessionStorage.getItem("radioOrderOption");  

  if(radioOrderOption == null){
    radioOrderOption = "prioridade";
  }  
  
  if ($(this).prop( "checked")){
    
      $(this).attr('value', 1);
      sessionStorage.setItem("checkTextArchivedUrl",1); 
      
  }else{
     
      $(this).attr('value', 0);
      sessionStorage.setItem("checkTextArchivedUrl",0); 
      
  }

  loadCheckNameUrl(radioOrderOption);

}); // fim 



$('.text').blur(function(){
    sessionStorage.setItem("textReturn",$('.text').val()); 
});

function loadCheckNameUrl(opcao){  

  // tratamento do campo de busca aleatória no load da página com tratamento de sessão
  // deve deixar habilitado caso tenha sido feita uma pesquisa que recarrega a página, mas esse campo permanecerá marcado, mantendo a pesquisa anterior
 

  if(sessionStorage.getItem("text") == "true" ||sessionStorage.getItem("text") == "false"  ){
    if(sessionStorage.getItem("text") == "true"){
        $('.text').prop('disabled', true);
        sessionStorage.setItem("textHabilidadoDesabilitado","false");
    }else{    
        $('.text').prop('disabled', false);
       sessionStorage.setItem("textHabilidadoDesabilitado","true"); 
       $('.checkText').prop( "checked", true); 
          if(sessionStorage.getItem("textReturn") != "null"){
              $('.text').val(sessionStorage.getItem("textReturn")); 
        }
        // mantém dados de busca aleatória mesmo que troque de aba, só irá perde a informação se fechar o navegador, ou se eu desmarcar a busca alertória
  }     


} // fim tratamento 

  // Carrage Url e Name Search Page
  let htmlContent1 = ``, htmlContent2 = ``,htmlContentLegendName = ``,htmlContentLegendUrl= ``;	
  
  if(!sessionStorage.getItem("checkPrivate") == "" )
  var checkPrivate = sessionStorage.getItem("checkPrivate");

  if(!sessionStorage.getItem("checkTextArchivedNames") == "" )
  var checkTextArchivedNames = sessionStorage.getItem("checkTextArchivedNames");
  else 
  checkTextArchivedNames=0;

  if(!sessionStorage.getItem("checkTextArchivedUrl") == "" )
  var checkTextArchivedUrl = sessionStorage.getItem("checkTextArchivedUrl");
  else 
  checkTextArchivedUrl=0;
  
  if(sessionStorage.length == 0){

    checkPrivate=0;    
    checkTextArchivedNames=0;    
    checkTextArchivedUrl=0;    
    
    sessionStorage.setItem("checkPrivate",checkPrivate); 
    sessionStorage.setItem("checkTextArchivedNames",checkTextArchivedNames); 
    sessionStorage.setItem("checkTextArchivedUrl",checkTextArchivedUrl); 

    $('.text').prop('disabled', true);
    sessionStorage.setItem("textHabilidadoDesabilitado","false");
  } 

  if(checkPrivate ==1){

    $('#idPrivateName').prop( "checked", true);

  }

  opcao  = sessionStorage.getItem("radioOrderOption");
  
  if(opcao == null){
    opcao = "prioridade";
  }

  sessionStorage.setItem("radioOrderOption",opcao);

  $.ajax({
  url: 'bin/parameter.php',
  method: 'POST',
  dataType: 'json',
  data: {name_Private:checkPrivate,opcao:opcao,checkTextArchivedNames:checkTextArchivedNames,checkTextArchivedUrl:checkTextArchivedUrl},
  }).done(function(data){
  if (data.result == 'ok'){
        //console.log(Object.keys(data).length);

if(data.url !== undefined){

      for(var i = 0; i<Object.keys(data.url).length; i++){        
        
        htmlContentLegendUrl=`<legend class='textURL'>URL - (${i+1})</legend>  `;
    
        htmlContent1+=`<div class="itemCheck"> <label class="container">
    <input class="checkURl" type='checkbox' name='idURLSearch[]'  id='${data.url[i][0]}' value='${data.url[i][0]}' onclick="getParameter(this.value)"'>
    <span class="checkmark"></span>${data.url[i][3]}
    </label></div>`;
    $('#checkUrlContent').html(htmlContent1);
    if(data.url[i][2] != ""){
      htmlContent1+=`<div class="itemCheck"> <label class="container">
      <input class="checkParameter" type='checkbox' name='parameter[]'  id='${data.url[i][2]}' value='${data.url[i][2]}'>
      <span class="checkmark"></span>${data.url[i][2]}    
      </label></div>`;
          $('#checkUrlContent').html(htmlContent1);
      }
    } 
}else{

  alert("Nenhum registro de url arquivado foi encontrado!");

}
  $('#legendURL').html(htmlContentLegendUrl);

if(data.name !== undefined){

    for(var i = 0; i<Object.keys(data.name).length; i++){ 
      
      htmlContentLegendName=`<legend class='textName'>Names - (${i+1}) </legend>`;  
    
    if(data.name[i][2] != ""){

      htmlContent2+=`<div class="itemCheck"> <label class="container">
      <input class="checkName" type='checkbox' name='ckbname[]'  id='${data.name[i][0].replace( /\s/g, '' )}' value='${data.name[i][0]}' onclick="getParameter(this.value);"
      '><span class="checkmark"></span>${data.name[i][0]} - (${i+1})
      <img id="myImg" src='${data.name[i][2]}' alt="${data.name[i][0]}" style="width:10%;height:20px" onmouseover="imgClick('${data.name[i][2]}','${data.name[i][0]}');">
      </label></div>`;

    }else{

      htmlContent2+=`<div class="itemCheck"> <label class="container">
      <input class="checkName" type='checkbox' name='ckbname[]'  id='${data.name[i][0].replace( /\s/g, '' )}' value='${data.name[i][0]}' onclick="getParameter(this.value);"
      '><span class="checkmark"></span>${data.name[i][0]} - (${i+1})
      </label></div>`;

    }

      $('#checkNameContent').html(htmlContent2);
    }  
}else{

  alert("Nenhum registro de url arquivado foi encontrado!");  

}     
  
  $('#legendNames').html(htmlContentLegendName);
          } else{
             alert(data.message);
     //         $("#txtHint3").html(data.message);
          }
     
      }).fail(function(data){ 
          alert("Erro aqui 1");    
 //      $("#checkNameContent").html(JSON.stringify(data));                  
    });   
   
  }// fim function loadCheckNameUrl

  
  // Início Pop up
function imgClick(image,caption){
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
//var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");


  modal.style.display = "block";
  modalImg.src = image;
  captionText.innerHTML = caption;


// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("modal")[0];

// When the user clicks on <span> (x), close the modal
modal.onclick = function() { 
  modal.style.display = "none";
}

}
//fim Pop up

function MarcarTodosCheck(){
    $('.checkName').each(
        function(){
            if ($(this).prop( "checked", false))
                $(this).prop("checked", true);
               $('.radioDesmarcado').prop( "checked", false);
        }
    );

    $('.checkURl').each(
      function(){
          if ($(this).prop( "checked", false))
              $(this).prop("checked", true);
             $('.radioDesmarcado').prop( "checked", false);
      }
  );

  $('.checkParameter').each(
    function(){
        if ($(this).prop( "checked", false))
            $(this).prop("checked", true);
           $('.radioDesmarcado').prop( "checked", false);
    }
);
};


function DesmarcarTodosCheck(){  
  //ao desmarcar limpa a sessão, porém mantém alguns dados que eu desejo manter

  var privateTemp = sessionStorage.getItem("checkPrivate");
  var buscaAleatoriaCheckText = sessionStorage.getItem("checkText");
  var buscaAleatoriaTextHabilitado = sessionStorage.getItem("text");
  var buscaAleatoriaText = sessionStorage.getItem("textReturn");
  var checkTextArchivedNames = sessionStorage.getItem("checkTextArchivedNames");
  var checkTextArchivedUrl = sessionStorage.getItem("checkTextArchivedUrl");
  
  sessionStorage.clear();

  sessionStorage.setItem("checkPrivate",privateTemp);  
  sessionStorage.setItem("checkText",buscaAleatoriaCheckText); 
  sessionStorage.setItem("text",buscaAleatoriaTextHabilitado);
  sessionStorage.setItem("textReturn",buscaAleatoriaText); 
  sessionStorage.setItem("checkTextArchivedNames",checkTextArchivedNames); 
  sessionStorage.setItem("checkTextArchivedUrl",checkTextArchivedUrl); 

    $('.checkName').each(
        function(){
            if ($(this).prop( "checked"))
                $(this).prop("checked", false);
                $('.radioMarcado').prop( "checked", false);
        }
    );

    $('.checkURl').each(
        function(){
            if ($(this).prop( "checked"))
                $(this).prop("checked", false);
                $('.radioMarcado').prop( "checked", false);
        }
    );

    $('.checkParameter').each(
      function(){
          if ($(this).prop( "checked"))
              $(this).prop("checked", false);
              $('.radioMarcado').prop( "checked", false);
      }
  );
};

function CheckBuscaAleatoria(){
    $('.checkText').each(
        function(){
            if ($(this).prop( "checked")){
              $('.text').prop('disabled', false);              
              sessionStorage.setItem("text",false);
              sessionStorage.setItem("textHabilidadoDesabilitado","true");
              sessionStorage.setItem("checkText",true); 
            } else {
               $('.text').prop('disabled', true);
              sessionStorage.setItem("text", true);
              sessionStorage.setItem("textHabilidadoDesabilitado","false");
              sessionStorage.setItem("checkText",false); 
              }
                $('.text').val("");               
        }
    );
};

function orderName(opcao){  

  if(opcao =="prioridade"){
      $('.radioNome').prop( "checked", false);
  }else{
    $('.radioPrioridade').prop( "checked", false);
  }    

   loadCheckNameUrl(opcao);

};

function senha() {
  var txt; 
  var checkPrivate = sessionStorage.getItem("checkPrivate");

  if( $('.classPrivateName').val() == 0 && checkPrivate == 0){    
    
      var senha = prompt("Digite sua senha:");
    if(senha == 1){
    // window.alert("If");
      document.getElementById("idPrivateName").onmouseover="";

      $('.classPrivateName').prop('checked',true);
      $('.classPrivateName').trigger('click');  
      $('.classPrivateName').trigger('click');   
      
    } 
  
  }

};
//função para testar se a string possui somente números
var  isNumeric = function(value) {
        return /^\d+(?:\.\d+)?$/.test(value);
    };

String.prototype.isNumeric = function() {
    return isNumeric(this);
};
// FIM função para testar se a string possui somente números

//  Início da segunda parte do tratamento de sessão para manter os elementos já selecionados marcado ao recarregar a página
$(document).ajaxComplete(function() {  
  //alert("window is loaded");  
 if(sessionStorage.length > 0){
      for (var key in sessionStorage) { 
        if(isNumeric(key)){
            document.getElementById(sessionStorage.getItem(key)).checked = true;  
        } else if(document.getElementById(sessionStorage.getItem(key))){
            document.getElementById(sessionStorage.getItem(key)).checked = true;  
        }
      }


      if(sessionStorage.getItem("textHabilidadoDesabilitado") == "true" && sessionStorage.length > 0){
        $('.text').prop('disabled', false);
          sessionStorage.setItem("textHabilidadoDesabilitado","true");
      }  else {
          $('.text').prop('disabled', true);
          sessionStorage.setItem("textHabilidadoDesabilitado","false");
      }  

    } 
    
    //  Fim trata sessão para manter os elementos já selecionados marcado ao recarregar a página



  
});

