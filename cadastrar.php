<?php
    require_once 'classes/usuarios.php';
    $u = new Usuario ;
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
    <div id="corpo-form-cad">
        <h1>Cadastrar</h1>
        <form method="POST" >
            <input type="text" name="nome" placeholder="Nome Completo" maxlenght="30">
            <input type="text" name="telefone" placeholder="Telefone" maxlenght="30">
            <input type="email" name="email" placeholder="Email" maxlenght="40">
            <input type="password" name="senha" placeholder="Senha" maxlenght="32">
            <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlenght="32">
            <input type="submit" value="CADASTRAR" >
        </form>
        <a href="index.php">Já tem Cadastro? <strong>Faça login!</strong></a>
    </div>
    <?php
//verificar se clicou no botao
if(isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']); //addslashes remove codigos de possiveis hackers
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha  = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confSenha']);
    //verificar se esta preenchido
    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){
        $u->conectar("projeto_login","localhost","root",""); 
        if($u->msgErro == ""){
            if($senha == $confirmarSenha){
                if($u->cadastrar($nome,$telefone,$email,$senha)){
                    ?>
					<div id='msg_sucesso'>
						Cadastrado com sucesso!
					</div>
					<?php
                }else {
                    ?>
					<div class="msg_erro">
						Email já cadastrado, retorne e faça login.
					</div>
					<?php
                }
            }else {
                ?>
				<div class="msg_erro">
					Senhas não conferem!
				</div>
				<?php
            }
        }else{
            ?>
				<div class="msg_erro">
					<?php echo "Erro: ".$u->msgErro;?>
				</div>
				<?php
        }
    }else{
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