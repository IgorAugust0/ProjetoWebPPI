<?php
session_start();
require "conexaoMysql.php";

if (!isset($_SESSION['loggedIn'])) {
    header("location: ../pages/conta.html");
    exit();
}

$email = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta | H&I</title>
    <!-- <script src="../js/login.js"></script> -->
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>

<body>
    <!---------- Header ----------------->
    <div class="grupo">
        <div class="navbar">
            <div class="logo">
                <a href="../index.html" aria-label="Logo"><img src="../assets/images/logo.png" width="125px" alt="logo"></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="../index.html">Início</a></li>
                    <li><a href="produtos.html">Produtos</a></li>
                    <!-- <li><a href="sobre.html">Sobre</a></li>
                        <li><a href="contato.html">Contato</a></li> -->
                    <li><a href="conta.html">Conta</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- ------------------ Página de conta (Cadastro e Login) --------- -->

    <div class="pag-conta">
        <div class="grupo">
            <div class="linha">
                <div class="coluna-2">
                    <img src="../assets/images/login.png" width="100%">
                </div>
                <div class="coluna-2">
                    <div class="form-grupo">
                        <div class="form-btn">
                            <span onclick="entrar()">Entrar</span>
                            <span onclick="cadastrar()">Cadastrar</span>
                            <hr id="indicador">
                        </div>
                        <form id="formEntrar">
                            <input type="text" id="email" name="email" placeholder="Email">
                            <input type="password" id="senha" name="senha" placeholder="Senha">
                            <button type="submit" class="btn">Entrar</button>
                            <a href="">Esqueceu a senha?</a>
                        </form>
                        <form id="formCadastrar" action="../php/cadastro.php" method="post">
                            <input type="text" id="nome" name="nome" placeholder="Nome" required>
                            <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
                            <input type="email" id="email" name="email" placeholder="Email" required>
                            <input type="tel" id="telefone" name="telefone" placeholder="Telefone" required>
                            <input type="password" id="senha" name="senha" placeholder="Senha" required>
                            <button type="submit" class="btn">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!---- Rodapé ------>
    <div class="rodape">
        <div class="grupo">
            <div class="linha">
                <div class="rodape-coluna-1">
                    <h3>Baixe nosso App</h3>
                    <p>Disponível tanto para Android quanto para iOS</p>
                    <div class="app-logo">
                        <img src="../assets/images/play-store.png" alt="play-store">
                        <img src="../assets/images/app-store.png" alt="app-store">
                    </div>
                </div>
                <div class="rodape-coluna-2">
                    <img src="../assets/images/logo-white.png" alt="logo-white">
                    <p>Nosso propósito é oferecer a melhor experência possível a um preço justo para nossos fiés
                        clientes </p>
                </div>
                <div class="rodape-coluna-3">
                    <h3>Links úteis</h3>
                    <ul>
                        <li>Cupons</li>
                        <li>Nosso blog</li>
                        <li>Política de devolução</li>
                        <li>Seja um afiliado</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">&copy; Copyright 2023 - H&I Inc.</p>
        </div>
    </div>

    <!-----------script para ativar menu em mobile (em formato burguer) ------->
    <script>
        var MenuItems = document.getElementById("MenuItems")
        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>


</body>

</html>