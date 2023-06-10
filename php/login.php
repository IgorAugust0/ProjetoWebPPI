<?php
require "conexaoMysql.php";

$email = $_POST["email"] ?? '';
$senha = $_POST["senha"] ?? '';

try {
  $conn = mysqlConnect();
  $stmt = $conn->prepare("SELECT hash_senha FROM anunciante WHERE email = ?");
  $stmt->execute([$email]);
  $senhaHash = $stmt->fetchColumn();

  if (!$senhaHash || !password_verify($senha, $senhaHash)) {
    $response = ['success' => false, 'detail' => '../pages/conta.html#formEntrar'];
  } else {
    session_start();
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $email;
    $response = ['success' => true, 'detail' => 'area_anunciante.php'];
  }

  header('Content-Type: application/json');
  echo json_encode($response);

  if ($response['success']) {
    header("Location: " . $response['detail']);
  } else {
    header("Location: " . $response['detail']);
  }
  exit();
} catch (PDOException $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}
