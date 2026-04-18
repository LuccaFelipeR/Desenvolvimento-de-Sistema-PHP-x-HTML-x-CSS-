<?php
$page_name = "Dados cadastrais";
//objetivo é jogar as informações no HTML e estilizar agora. 
include ('component.php'); //aqui estamos incluindo o arquivo component.php para exibir o cabeçalho e o rodapé do site, além de estilizar a página com Bootstrap
// verificar se a pagina foi carregada via POST
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
?>