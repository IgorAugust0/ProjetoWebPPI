<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();

$codAnunciante = $_GET['codAnunciante'] ?? '';

class Message
{
    public $code;
    public $message;
    public $dateTime;
    public $contact;
    public $adCode;
    public $adTitle;

    function __construct($code, $message, $dateTime, $contact, $adCode, $adTitle)
    {
        $this->code = $code;
        $this->message = $message;
        $this->dateTime = $dateTime;
        $this->contact = $contact;
        $this->adCode = $adCode;
        $this->adTitle = $adTitle;
    }
}

try {
    // Consulta SQL para obter as mensagens recebidas pelo anunciante
    $sql = <<<SQL
        SELECT interesse.codigo, interesse.mensagem, interesse.dataHora, interesse.contato, interesse.codAnuncio, anuncio.titulo
        FROM interesse
        INNER JOIN anuncio ON interesse.codAnuncio = anuncio.codigo
        WHERE anuncio.codAnunciante = :codAnunciante
        ORDER BY interesse.dataHora DESC
    SQL;

    // Preparar a declaração SQL
    $stmt = $pdo->prepare($sql);

    // Executar a declaração SQL com os parâmetros fornecidos
    $stmt->execute([':codAnunciante' => $codAnunciante]);

    // Obter os resultados da consulta
    $messages = array();
    while ($row = $stmt->fetch()) {
        $messages[] = new Message(
            $row['codigo'],
            $row['mensagem'],
            $row['dataHora'],
            $row['contato'],
            $row['codAnuncio'],
            $row['titulo']
        );
    }

    // Retornar as mensagens em formato JSON
    echo json_encode($messages);
} catch (Exception $e) {
    // Erro ao executar a consulta SQL
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>