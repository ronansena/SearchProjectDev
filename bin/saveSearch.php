

<?php
/*
session_start();
	
if ($_POST) //se o botão de submit for clicado
{		
	if (isset($_POST['idURLSearch'])) {
	$_SESSION['idURLSearch'] = $_POST['idURLSearch'];
	}
	if (isset($_POST['ckbname'])) {
	$_SESSION['ckbname']  = $_POST['ckbname']; 
	} 

}
*/
function get_post_action($name)
{
	$params = func_get_args();
	
    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}

switch (get_post_action('save', 'search','deletar','filed','unfiled')) {

	case 'unfiled':

		require ('conexao.php');  
	
		//arquivar name
	
			if (empty($_POST['ckbname'])) {
	
				echo "<script>window.alert('Nenhum nome foi selecionado para desarquivar!');</script>";
	
			}else{
	
				 $name = $_POST['ckbname'];
	
				foreach($name as $row){
	
						$query= "update searchname set filed=0 where name='$row'";
						$result = $conect->query($query);
						$result =  mysqli_query($conect,$query);
						echo "<script>window.alert('Nome selecionado desarquivado com sucesso!');</script>";
	
				}
					
			}
			//fim arquivar name
	
			//inicio arquivar searchname
	
	
			if (empty($_POST['idURLSearch'])) {
	
				echo "<script>window.alert('Nenhuma url foi selecionado para desarquivar!');</script>";
	
			}else{
	
				$URL = $_POST['idURLSearch'];
				
				if(!empty($_POST['parameter'])){
				
					$idparameter = $_POST['parameter'];
	
				}
	
				foreach($URL as $row1)
					{	
						if(!empty($idparameter)){
							
							foreach($idparameter as $row2)
							{
								$query1= "update searchurl set filed=0 where idURL='$row1' and parameter='$row2'";
								$result1 = $conect->query($query1);
								$result1 =  mysqli_query($conect,$query1);	
							
								if($result1){
								echo "<script>window.alert('URL selecionada desarquivada com sucesso!');</script>";
								//echo '<br><input  type="button" name="voltar" class="buttonVoltar" id="voltar" value="Voltar" onclick="location.href=\'../search.php\';" />';
								}else{
									echo "Falha na operação!";
								}
	
							}
						}else{
								$query1= "update searchurl set filed=0  where idURL='$row1'";
								$result1 = $conect->query($query1);
								$result1 =  mysqli_query($conect,$query1);	
								
								if($result1){
								echo "<script>window.alert('URL selecionada desarquivada com sucesso!');</script>";
							//	echo '<br><input  type="button" name="voltar" class="buttonVoltar" id="voltar" value="Voltar" onclick="location.href=\'../search.php\';" />';
								}else{
									echo "<script>window.alert('Falha na operação!');</script>";
								}
						}
					}	
				}	
	
					//fim arquivar searchname
	
			echo "<script>window.history.back()</script>";
	
			$conect->close();
	
		break;	


	case 'filed':

	require ('conexao.php');  

	//arquivar name

		if (empty($_POST['ckbname'])) {

			echo "<script>window.alert('Nenhum nome foi selecionado para Arquivar!');</script>";

		}else{

			 $name = $_POST['ckbname'];

			foreach($name as $row){

					$query= "update searchname set filed=1 where name='$row'";
					$result = $conect->query($query);
					$result =  mysqli_query($conect,$query);
					echo "<script>window.alert('Nome selecionado arquivado com sucesso!');</script>";

			}
				
		}
		//fim arquivar name

		//inicio arquivar searchname


		if (empty($_POST['idURLSearch'])) {

			echo "<script>window.alert('Nenhuma url foi selecionado para Arquivar!');</script>";

		}else{

			$URL = $_POST['idURLSearch'];
			
			if(!empty($_POST['parameter'])){
			
				$idparameter = $_POST['parameter'];

			}

			foreach($URL as $row1)
				{	
					if(!empty($idparameter)){
						
						foreach($idparameter as $row2)
						{
							$query1= "update searchurl set filed=1 where idURL='$row1' and parameter='$row2'";
							$result1 = $conect->query($query1);
							$result1 =  mysqli_query($conect,$query1);	
						
							if($result1){
							echo "<script>window.alert('URL selecionada arquivada com sucesso!');</script>";
							//echo '<br><input  type="button" name="voltar" class="buttonVoltar" id="voltar" value="Voltar" onclick="location.href=\'../search.php\';" />';
							}else{
								echo "Falha na operação!";
							}

						}
					}else{
							$query1= "update searchurl set filed=1  where idURL='$row1'";
							$result1 = $conect->query($query1);
							$result1 =  mysqli_query($conect,$query1);	
							
							if($result1){
							echo "<script>window.alert('URL selecionada arquivada com sucesso!');</script>";
						//	echo '<br><input  type="button" name="voltar" class="buttonVoltar" id="voltar" value="Voltar" onclick="location.href=\'../search.php\';" />';
							}else{
								echo "<script>window.alert('Falha na operação!');</script>";
							}
					}
				}	
			}	

				//fim arquivar searchname

		echo "<script>window.history.back()</script>";

		$conect->close();

	break;	

    case 'save':
        
			require ('conexao.php'); 
					
 			$url = trim($_POST['url']);
 			$nameSite = trim($_POST['site']);
 			$name = trim($_POST['name']);
			 $parametro = trim($_POST['parametro']);
		

			 if (isset($_POST['privateName'])){
				 $privateName = trim($_POST['privateName']);	
			 } else {
				$privateName= 0;
			}

			if (isset($_POST['imageName'])){
				$imageName = trim($_POST['imageName']);	
			} else {
			    $imageName= 0;
		   }

			 if (isset($_POST['privateSite'])){
				$privateSite = trim($_POST['privateSite']);
			 } else {
				$privateSite= 0;
			}

 				if($url <>""){	
 					//falta testar a execução do  mysqli_query

					$search1 = mysqli_query($conect,"SELECT * FROM searchurl WHERE idurl = '$url'	and parameter='$parametro'");
				
					if(mysqli_num_rows($search1) > 0){
						echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Essa URL já existe!'); </SCRIPT>");
						echo "<script>window.history.back()</script>"; 			
					}

					if(mysqli_num_rows($search1) === 0){
					$q1 = "INSERT INTO searchurl (url,parameter,urlfantasia,private)
						VALUES ('$url','$parametro','$nameSite',$privateSite);";
						$result1 =  mysqli_query($conect,$q1);

						if ($result1) { // If it ran OK.
								$conect->commit(); 
								echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.alert('URL incluída com sucesso!');</SCRIPT>");
								if ($nameSite <>""){
									echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.alert('Nome do site incluído com sucesso!');</SCRIPT>");
								}
								//End of SUCCESSFUL SECTION
						} else { // If the form handler or database table contained errors 
						// Display any error message
							echo ('<script>window.alert("System Error: 
									You could not be registered due to a system error. We apologize for any inconvenience.")</script>');
									echo "<script>window.history.back()</script>"; 
							
							$conect->rollback();
						} // End of if clause ($result)
					}	
				} // fim if($url <>"")

				if($name <>""){	
					$search2 = mysqli_query($conect,"SELECT * FROM searchname WHERE name = '$name'");

					if((int)mysqli_num_rows($search2) > 0){

						echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.alert('Esse nome já existe no banco de dados!');</SCRIPT>");			
							echo "<script>window.history.back()</script>"; 
						}

					if((int)mysqli_num_rows($search2) === 0 && $name != ""){
						// faz inserção
						if( $imageName == 1){
							$q = "INSERT INTO searchname (name,private,imagePath)
							VALUES ('$name','$privateName','image/$name.jpg');"; 
							$conect->autocommit(FALSE);
							$result =  mysqli_query($conect,$q); // Run the query. 
						}else{
							$q = "INSERT INTO searchname (name,private,imagePath)
							VALUES ('$name','$privateName','');"; 
							$conect->autocommit(FALSE);
							$result =  mysqli_query($conect,$q); // Run the query.
						}		

						
										
						if ($result) { // If it ran OK.
							
							$conect->commit(); 
							echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.alert('Nome incluído com sucesso!');</SCRIPT>");						
						//End of SUCCESSFUL SECTION
						} else { // If the form handler or database table contained errors 
						// Display any error message
								echo ('<script>window.alert("System Error: 
									You could not be registered due to a system error. We apologize for any inconvenience.")</script>');
									echo "<script>window.history.back()</script>"; 
							$conect->rollback();
						} // End of if clause ($result)
					} //fim serach2
				} //fim if ($name <>"")
				if($url == "" && $parametro <> "" || $url == "" && $nameSite <> ""){
					echo ("<SCRIPT>window.alert('Parâmetro não pode ser configurado sem a URL!');</SCRIPT>");
					echo "<script>window.history.back()</script>"; 
				}

				if ($url == "" && $nameSite == "" && $name == "" && $parametro == ""){
					echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.alert('Deve ser preenchido pelo menos um campo para salvar a configuração!');</SCRIPT>");	
							echo "<script>window.history.back()</script>"; 
				}					
				echo "<script>window.close();</script>";
				echo "<script>window.setTimeout(function(){location.href = '../config.php';},1000);</script>";

$conect->close(); 
break;

	case 'search':
		
		require ('conexao.php'); 
		
		if (empty($_POST['idURLSearch'])) {
			echo "<script>window.alert('Nenhuma URL foi selecionada para Pesquisar!');</script>";
		
			
		}else{
			 $idURL = $_POST['idURLSearch'];	
			 
				if (empty($_POST['ckbname'])) {
					echo "<script>window.alert('Nenhum nome foi selecionado para Pesquisar!');</script>";

		}else{
				
			$name = $_POST['ckbname'];		
								
				foreach($idURL as $row2)
				{				

					$sql = "select parameter,url from searchurl where idUrl='$row2'";

					if ($stmt = $conect->prepare($sql)) {
							/* execute statement */
							$stmt->execute();
						
							/* bind result variables */
							$stmt->bind_result($parameterTemp,$urlTemp);
						
							/* fetch values */
							while ($stmt->fetch()) {
								$parameterTemp;
								$urlTemp;
							}				
							if($parameterTemp == ""){	
							
						


					foreach($name as $row)
					{
						// Início implementação incrementa Names mais pesquisados;		
						$queryOrderSearchCount = "select countOrder from searchname where name='$row'";
						$result = mysqli_query($conect,$queryOrderSearchCount);
						$countQuery = mysqli_fetch_array($result);
						$newCount = $countQuery['countOrder'] + 1;
						mysqli_query($conect,"update searchname set countOrder='$newCount' where name='$row'");
						// Fim implementação incrementa Names mais pesquisados;	
						
						echo "<script>window.open('".$urlTemp.$row."');</script>";
						//echo 'Pesquisa concluída com sucesso!<br>';
					//	echo "<script>window.history.back()</script>";
						//echo "<script>window.location='../index.php';</script>";
						//echo "<script>alert('Pesquisa concluída com sucesso!');</script>";
					}
				}}
				}
		
		
		if(isset($_POST['parameter'])){
			$idparameter = $_POST['parameter'];
		foreach($idURL as $row2)
		{
					
				foreach($idparameter as $row3){
					$sql = "select url,parameter,idURL from searchurl where parameter='$row3'";

						if ($stmt = $conect->prepare($sql)) {
								/* execute statement */
								$stmt->execute();
							
								/* bind result variables */
								$stmt->bind_result($urlTemp,$parameterTemp,$idUrlTemp);
							
								/* fetch values */
								while ($stmt->fetch()) {
								$urlTemp;
								$parameterTemp;
								$idUrlTemp;
								}				
								if($idUrlTemp == $row2 && $parameterTemp == $row3){					
									foreach($name as $row)
									{
										// Início implementação incrementa Names mais pesquisados;		
										$queryOrderSearchCount = "select countOrder from searchname where name='$row'";
										$result = mysqli_query($conect,$queryOrderSearchCount);
										$countQuery = mysqli_fetch_array($result);
										$newCount = $countQuery['countOrder'] + 1;
										mysqli_query($conect,"update searchname set countOrder='$newCount' where name='$row'");
										// Fim implementação incrementa Names mais pesquisados;	
										echo "<script>window.open('".$urlTemp.$row.$row3."');</script>";								
									}									
									
								}
							
						}
				} //fim for parameter
			
			} // fim for url
				$stmt->close();	
		}}
			}
			
			
	
			//echo "<script>window.history.back()</script>";
			//echo "<script> openedWindow = window.open('../search.php');</script>";
			echo "<script>window.history.back()</script>";
		//	echo "<script>window.openedWindow.focus() ;</script>";
		//	echo "<script>window.close();</script>";
						
			/* free result set */
			
			/* close connection */
		
			
							//	echo '<input  type="button" name="voltar" class="buttonVoltar" id="voltar" value="Voltar" onclick="location.href=\'../index.php\';" />';
								 #10
			//echo "<script> openedWindow = window.open('../index.php');</script>";
			//echo "<script> openedWindow1 = window.open('bin/saveSearch.php');</script>";
			//echo "<script>window.openedWindow.focus() ;</script>";
			//echo "<script>window.openedWindow1.close() ;</script>";
			//echo "<script>window.close();</script>";
			//echo "<script> window.opener.location.reload(); window.close();</script>";
			//echo "<script> openedWindow = window.open('localhost/SearchProject/bin/saveSearch.php');</script>";
			//echo "<script> openedWindow.close();</script>";
			//echo "<script>window.open('http://localhost/SearchProject/index.php');</script>";
			 //exit;
			
			//sleep(1);
			//header ("location: ../index.php");

			//save article and redirect
			 break;  
			 $conect->close();


	case 'deletar':

 		require ('conexao.php');  
		
		
		if (empty($_POST['ckbname'])) {
			echo "<script>window.alert('Nenhum nome foi selecionado para deletar!');</script>";

		}else{
			 $name = $_POST['ckbname'];
			foreach($name as $row)
				{
					$query= "delete from searchname where name='$row'";
					$result = $conect->query($query);
					$result =  mysqli_query($conect,$query);
					echo "<script>window.alert('Nome selecionado deletado com sucesso!');</script>";
				}
				
		}
		   if (empty($_POST['idURLSearch'])) {
			echo "<script>window.alert('Nenhuma URL foi selecionada para deletar!');</script>";
			//echo '<br><input  type="button" name="voltar" class="buttonVoltar" id="voltar" value="Voltar" onclick="location.href=\'../search.php\';" />';
		}else{
/*
			if (!empty($_POST['idURLSearch'])) {					
			    $URL = $_POST['idURLSearch'];
			  }else {
				echo "<script>window.alert('Nenhuma URL foi selecionada para deletar!');</script>";
			  }			   

			if (!empty($_POST['parameter'])) {					
			    $idparameter = $_POST['parameter'];
			  }else {
				echo "<script>window.alert('Nenhum parâmetro foi selecionado para deletar!');</script>";
			  }	
*/	
			$URL = $_POST['idURLSearch'];

			if(!empty($_POST['parameter'])){
			
				$idparameter = $_POST['parameter'];
				
			}
			
			foreach($URL as $row1)
				{	
					if(!empty($idparameter)){
						
						foreach($idparameter as $row2)
						{
							$query1= "delete from searchurl where idURL='$row1'	and parameter='$row2'";
							$result1 = $conect->query($query1);
							$result1 =  mysqli_query($conect,$query1);	
						
							if($result1){
							echo "<script>window.alert('URL selecionada deletada com sucesso!');</script>";
							//echo '<br><input  type="button" name="voltar" class="buttonVoltar" id="voltar" value="Voltar" onclick="location.href=\'../search.php\';" />';
							}else{
								echo "Falha na operação!";
							}

						}
					}else{
							$query1= "delete from searchurl where idURL='$row1'";
							$result1 = $conect->query($query1);
							$result1 =  mysqli_query($conect,$query1);	
							
							if($result1){
							echo "<script>window.alert('URL selecionada deletada com sucesso!');</script>";
						//	echo '<br><input  type="button" name="voltar" class="buttonVoltar" id="voltar" value="Voltar" onclick="location.href=\'../search.php\';" />';
							}else{
								echo "<script>window.alert('Falha na operação!');</script>";
							}
					}
				}	
			}
		
			echo "<script>window.history.back()</script>";
			echo "<script>window.openedWindow.focus() ;</script>";
		//	echo "<script> openedWindow = window.open('../search.php');</script>";
		//	echo "<script>window.close();</script>";
		//	echo "<script>window.openedWindow.focus() ;</script>";	 
			
			$conect->close();

		 break;
	
   		 default:
         //no action sent
   		 exit();
} //fim swicht
?>

	



