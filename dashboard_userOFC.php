<?php
session_start(); //Faz a verificação 
include 'conexaoOFC.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: /PBD/Screens/Login/login.html");
    exit();
}

// Exibir dados ou processar lógica aqui, se necessário.
//echo '<script>
   // localStorage.setItem("userLoggedIn", "true");
    //window.location.href = "/PBD/Screens/UserLogado/user_logado.php";
//</script>';

//exit();