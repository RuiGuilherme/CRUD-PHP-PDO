<!DOCTYPE html> 
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
</head>
	<body>

	</body>
</html> 
<?php
//PHP View Chamadas:
require_once ('php/Controller/controller.php');
$POST = filter_input_array(INPUT_POST, FILTER_DEFAULT); //Evitar acesso direito a super global
$SERVER = filter_input_array(INPUT_SERVER, FILTER_DEFAULT); 
if (isset($POST['submit'])){ 
    $User = new Usuario();
    $User->idnome = $POST['inputNome']; 
    $User->idmail = $POST['inputMail'];
	$User->idsenha = $POST['inputSenha'];
    //$User->Insert($User);
	//$User->Select($User);
	//$User->Update($User);
	//$User->Delete($User);
}
?>
