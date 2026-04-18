<?php
function load_body($name){
    if ($name === "Formulário de Cadastro") {
        return '<p class="text-muted">
      Preencha os dados abaixo. O formulário será utilizado para demonstrar validação em PHP.
</p>

<form method="post" action="resposta.php">

    <div class="mb-3">
        <label for="nome" class="form-label">Nome completo</label>
        <input type="text" class="form-control" id="nome" name="nome" value="">
        <div class="text-danger small"></div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="">
        <div class="text-danger small"></div>
    </div>

    <div class="mb-3">
        <label for="idade" class="form-label">Idade</label>
        <input type="number" class="form-control" id="idade" name="idade" value="" min=0>
        <div class="text-danger small"></div>
    </div>

    <div class="mb-3">

        <label for="curso" class="form-label">Curso</label>

        <select class="form-select" id="curso" name="curso">
            <option value="">Selecione um curso</option>
            <option value="sistemas">Analise de Informação</option>
            <option value="direito">Direito</option>
            <option value="medicina">Medicina</option>
        </select>

        <div class="text-danger small"></div>

    </div>

    <button type="submit" class="btn btn-success">Enviar cadastro</button>


</form>';
} elseif ($name === "Dados cadastrais") {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = htmlspecialchars($_POST["nome"]); //aqui estamos usando a função htmlspecialchars para prevenir ataques de injeção de HTML, convertendo caracteres especiais em entidades HTML
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $idade = filter_input(INPUT_POST, "idade", FILTER_VALIDATE_INT);

    // $nome = $_POST["nome"]; (ésse código é vulnerável a ataques de injeção de HTML, por isso é recomendado usar a função htmlspecialchars para prevenir isso)
    // $nome = htmlspecialchars($_POST["nome"]); //PREVINE HTML INJETADO NO FORMULÁRIO
    /*
        echo "<p>Dados recebidos: Nome: $nome - Email: $email - Idade: $idade</p>";


        if (empty($nome)) { //AQUI ESTAMOS VERIFICANDO SE O CAMPO NOME ESTÁ VAZIO, SE ESTIVER VAI EXIBIR A MENSAGEM DE ERRO
            echo "<p> O campo nome deve ser preenchido</p>";
        }
        if (empty($email)) {
            echo "<p> O campo email deve ser preenchido com um email válido</p>";
        }
        if (empty($idade)) {
            echo "<p> O campo idade deve ser preenchido com um número inteiro</p>";
        }
    */
    foreach ($_POST as $key => $value) { //aqui estamos percorrendo o array $_POST para exibir os dados recebidos do formulário 
        if ($key === "nome") {
            $nome = htmlspecialchars($_POST["nome"]); //PREVINE HTML INJETADO NO FORMULÁRIO / TROUXE PRA VARIÁVEL $nome PARA DENTRO DO FOREACH PARA PODER VER SE O CAMPO NOME ESTÁ VAZIO}
            if (empty($nome)) {
                echo "<p> O campo nome deve ser preenchido</p>";
            } else {
                echo "<p> $key: $value </p>";
            }
        } elseif ($key === "email") {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL); //VALIDA SE O EMAIL É VÁLIDO
            if (empty($email)) {
                echo "<p> O campo email deve ser preenchido </p>";
            } else {
                echo "<p> $key: $email </p>"; //aqui estamos exibindo o valor do email validado
            }
        } elseif ($key === "idade") {
            $idade = filter_input(INPUT_POST, "idade", FILTER_VALIDATE_INT); //VALIDA SE A IDADE É UM NÚMERO INTEIRO
            if (!empty($idade) && $idade > 0 && $idade <=150) {
                echo "<p> $key: $idade </p>";
            } elseif (empty($idade)) {
                echo "<p> O campo idade deve ser preenchido com um valor numérico entre 1 e 110 </p>";
            } 
        }elseif ($key === "curso") {
            if (empty($value)) {
                echo "<p> Selecione um curso válido! </p>";
            } elseif($value === "Medicina" || $value === "Analise de Informação" || $value === "Direito") { //aqui estamos verificando se o valor do curso é um dos valores válidos, se for vai exibir o valor do curso, caso contrário vai exibir a mensagem de erro
                echo "<p> $key: $value </p>";
            }
        }
    }
}
}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema Acadêmico - Burtan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Cadastro</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Consultas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Relatórios</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h1 class="h4 mb-0"><?php echo $page_name; ?></h1>
            </div>
             <div class="card-body">

             <?php echo load_body($page_name); ?>

                
            
            
            </div>
        </div>
    </div>

    </body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>