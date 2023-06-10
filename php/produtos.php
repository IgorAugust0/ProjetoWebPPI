<?php
// sera usado para carregar todos os produtos do banco de dados e retornar um json em array com todos os produtos

require "conexaoMysql.php";
$pdo = mysqlConnect();

$codigoCategoria = $_GET['codCategoria'];

class Product
{
  public $name;
  public $price;
  public $date;
  public $category;
  public $imagePath;

  function __construct($name, $price, $date, $category ,$imagePath)
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

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $products = array();
        while ($row = $stmt->fetch()) {
            $products[] = new Product($row['titulo'], $row['preco'], $row['dataHora'], $row['codCategoria'] ,$row['nomeArqFoto']);
        }
        echo json_encode($products);
    } 
    catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }

    

?>