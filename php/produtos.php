<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();

$codigoCategoria = $_GET['codCategoria'] ?? '';
$nome = $_GET['nome'] ?? '';

$page = $_GET['page'] ?? 1; // Página atual
$itemsPerPage = 6; // Número de itens por página
$offset = ($page - 1) * $itemsPerPage; // Cálculo do offset

class Product
{
    public $name;
    public $price;
    public $date;
    public $category;
    public $imagePath;

    function __construct($name, $price, $date, $category, $imagePath)
    {
        $this->name = $name;
        $this->price = $price;
        $this->date = $date;
        $this->category = $category;
        $this->imagePath = $imagePath;
    }
}

$sql = <<<SQL
    SELECT titulo, preco, dataHora, codCategoria, nomeArqFoto
    FROM anuncio
    INNER JOIN foto ON anuncio.codigo = foto.codAnuncio
SQL;

if (!empty($codigoCategoria)) {
    $sql .= " WHERE anuncio.codCategoria = $codigoCategoria";
}

if (!empty($nome)) {
    if (!empty($codigoCategoria)) {
        $sql .= " AND";
    } else {
        $sql .= " WHERE";
    }
    $sql .= " anuncio.titulo LIKE '%$nome%'";
}

$sql .= " ORDER BY anuncio.dataHora DESC"; // Ordenar em ordem decrescente da data do anúncio
$sql .= " LIMIT $itemsPerPage OFFSET $offset"; // Aplicar LIMIT e OFFSET para a paginação

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $products = array();
    while ($row = $stmt->fetch()) {
        $products[] = new Product($row['titulo'], $row['preco'], $row['dataHora'], $row['codCategoria'], $row['nomeArqFoto']);
    }
    echo json_encode($products);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>