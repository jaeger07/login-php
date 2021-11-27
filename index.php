<?php
  require_once 'classes/usuarios.php';
  $u = new Usuario;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <title>Projeto Login</title>
</head>
<body>
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="email"  name="email" placeholder="Email">
            <input type="password"  name="senha" placeholder="Senha">
            <input type="submit" value="ACESSAR" >
            <a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se</strong></a>
        </form>
    </div>
    <?php
	if(isset($_POST['email']))
	{
		$email = addslashes($_POST['email']);
		$senha = addslashes($_POST['senha']);
		//verificando se todos os campos nao estao vazios
		if(!empty($email) && !empty($senha))
		{
			$u->conectar("projeto_login","localhost","root",""); //conectando ao banco
			if($u->msgErro=="") // caso a mensagem esteja vazia, login ok
			{
				if ($u->logar($email, $senha))
				{
					header("location: areaPrivada.php"); //encaminhado para proxima area apos verificar usuario e senha
				}
				else
				{
					?>
					<div class="msg_erro">
						Email e/ou senha estão incorretos!
					</div>
					<?php
				}
			}
			else
			{
				?>
				<div class="msg_erro">
					<?php echo "Erro: ".$u->msgErro; ?>
				</div>
				<?php
			}
		}
		else
		{
      ?>
			<div class="msg_erro">
				Preencha todos os campos!
			</div>
			<?php
		}
	}
	?>
</body>
</html>