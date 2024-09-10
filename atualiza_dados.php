<?php
$host = 'localhost'; // ou o endereço do seu servidor
$db = 'dessalinizacao';
$user = 'root'; // ou o seu usuário do banco de dados
$pass = ''; // ou a sua senha do banco de dados

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recebendo dados do formulário
$id = $_POST['id'];
$estado = $_POST['estado'];
$municipio = $_POST['municipio'];
$nome_comunidade = $_POST['nome_comunidade'];
$status = $_POST['status'];
$quantidade_agua = $_POST['quantidade_agua'];
$pessoas_atendidas = $_POST['pessoas_atendidas'];
$tds_poco = $_POST['tds_poco'];
$tds_permeado = $_POST['tds_permeado'];
$tds_concentrado = $_POST['tds_concentrado'];
$lat_graus = $_POST['lat_graus'];
$lat_minutos = $_POST['lat_minutos'];
$lat_segundos = $_POST['lat_segundos'];
$long_graus = $_POST['long_graus'];
$long_minutos = $_POST['long_minutos'];
$long_segundos = $_POST['long_segundos'];

$latitude = $lat_graus + ($lat_minutos / 60) + ($lat_segundos / 3600);
$longitude = $long_graus + ($long_minutos / 60) + ($long_segundos / 3600);

$sql = "UPDATE sistemas_dessalinizacao SET estado='$estado', municipio='$municipio', nome_comunidade='$nome_comunidade', status='$status', quantidade_agua='$quantidade_agua', pessoas_atendidas='$pessoas_atendidas', tds_poco='$tds_poco', tds_permeado='$tds_permeado', tds_concentrado='$tds_concentrado', latitude='$latitude', longitude='$longitude' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
} else {
    echo "Erro: " . $sql . "<br>" .
