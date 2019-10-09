
<?php


$host = "localhost:3306"; 
$username = "alugapp_root"; 
$password = "eclenice123@"; 
$db = "alugapp_alug";

/*

$host = "localhost:8080"; 
$username = "root"; 
$password = ""; 
$db = "alug"; 
*/

session_start();


$login = $_POST['email'];
$senha = $_POST['cpf'];

mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); 

@mysql_select_db($db) or die("Impossível conectar ao banco"); 
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

$result=mysql_query("SELECT * FROM cliente where email = '$login' and cpf = '$senha'") or die("Impossível executar a query"); 

if(mysql_num_rows($result) > 0){
	$row=mysql_fetch_object($result);
	$_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    $_SESSION['idcliente'] = $row->idcliente;
    $_SESSION['nome'] = $row->nome;
    echo "<script> window.location.replace('area-assinante/index.php') </script>";

}
else{
    unset ($_SESSION['login']);
    unset ($_SESSION['senha']);
    echo "<script> window.location.replace('login.html') </script>";
}

?>