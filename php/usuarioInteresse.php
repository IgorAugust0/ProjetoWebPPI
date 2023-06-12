<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem = $_POST["mensagem"];
    $contato = $_POST["contato"];
    $codAnuncio = $_POST["codAnuncio"];

    // Data e hora atuais
    $dataHora = date("Y-m-d H:i:s");

    try {
        // Preparar a declaração SQL
        $sql = "INSERT INTO interesse (mensagem, dataHora, contato, codAnuncio) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        // Executar a declaração SQL com os valores fornecidos
        $stmt->execute([$mensagem, $dataHora, $contato, $codAnuncio]);

        // Verificar se a inserção foi bem-sucedida
        if ($stmt->rowCount() > 0) {
            // Inserção bem-sucedida
            echo "Mensagem enviada com sucesso!";
        } else {
            // Inserção falhou
            echo "Falha ao enviar a mensagem. Por favor, tente novamente.";
        }
    } catch (Exception $e) {
        // Erro ao executar a declaração SQL
        exit("Ocorreu uma falha: " . $e->getMessage());
    }
}
?>
?>