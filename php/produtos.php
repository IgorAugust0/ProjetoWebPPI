<?php
// sera usado para carregar todos os produtos do banco de dados e retornar um json em array com todos os produtos

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Product
{
  public $name;
  public $price;
  public $date;
  public $imagePath;

  function __construct($name, $price, $date, $imagePath)
  {
    $this->name = $name; 
    $this->price = $price;
    $this->date = $date;
    $this->imagePath = $imagePath;
  }
}

$sql = <<<SQL
    SELECT titulo, preco, dataHora, nomeArqFoto
    FROM anuncio INNER JOIN foto ON anuncio.codigo = foto.codAnuncio
    SQL;


    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $products = array();
        while ($row = $stmt->fetch()) {
            $products[] = new Product($row['titulo'], $row['preco'], $row['dataHora'], $row['nomeArqFoto']);
        }
        echo json_encode($products);
    } 
    catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }

    

?>