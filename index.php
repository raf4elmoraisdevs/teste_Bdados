<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Sistemas de Dessalinização</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 600px;
            margin: 0 auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-button {
            background-color: #007BFF;
            color: white;
            padding: 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Cadastro de Sistemas de Dessalinização</h2>

    <form action="processa_dados.php" method="post">
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="">Selecione o Estado</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
        </select>

        <label for="municipio">Município:</label>
        <input type="text" id="municipio" name="municipio" required>

        <label for="nome_comunidade">Nome da Comunidade:</label>
        <input type="text" id="nome_comunidade" name="nome_comunidade" required>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="À Iniciar">À Iniciar</option>
            <option value="Em Obras">Em Obras</option>
            <option value="Sistema em Operação">Sistema em Operação</option>
        </select>

        <label for="quantidade_agua">Produção de Água Dessalinizada (L/h):</label>
        <input type="number" id="quantidade_agua" name="quantidade_agua" step="0.01" required>

        <label for="pessoas_atendidas">Pessoas Atendidas:</label>
        <input type="number" id="pessoas_atendidas" name="pessoas_atendidas" required>

        <label for="tds_poco">TDS Poço (mg/L):</label>
        <input type="number" id="tds_poco" name="tds_poco" step="0.01" required>

        <label for="tds_permeado">TDS Permeado (mg/L):</label>
        <input type="number" id="tds_permeado" name="tds_permeado" step="0.01" required>

        <label for="tds_concentrado">TDS Concentrado (mg/L):</label>
        <input type="number" id="tds_concentrado" name="tds_concentrado" step="0.01" required>

        <h3>Latitude:</h3>
        Graus: <input type="number" id="lat_graus" name="lat_graus" required>
        Minutos: <input type="number" id="lat_minutos" name="lat_minutos" required>
        Segundos: <input type="number" id="lat_segundos" name="lat_segundos" step="0.01" required>

        <h3>Longitude:</h3>
        Graus: <input type="number" id="long_graus" name="long_graus" required>
        Minutos: <input type="number" id="long_minutos" name="long_minutos" required>
        Segundos: <input type="number" id="long_segundos" name="long_segundos" step="0.01" required>

        <button type="submit">Cadastrar</button>
    </form>

    <h2>Sistemas de Dessalização Cadastrados</h2>
    <table>
        <thead>
            <tr>
                <th>Estado</th>
                <th>Município</th>
                <th>Nome da Comunidade</th>
                <th>Status</th>
                <th>Produção (L/h)</th>
                <th>Pessoas Atendidas</th>
                <th>TDS Poço</th>
                <th>TDS Permeado</th>
                <th>TDS Concentrado</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $host = 'localhost'; // ou o endereço do seu servidor
            $db = 'dessalinizacao';
            $user = 'root'; // ou o seu usuário do banco de dados
            $pass = ''; // ou a sua senha do banco de dados

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM sistemas_dessalinizacao";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $lat_graus = floor($row['latitude']);
                    $lat_minutos = floor(($row['latitude'] - $lat_graus) * 60);
                    $lat_segundos = (($row['latitude'] - $lat_graus) * 3600) % 60;
                    
                    $long_graus = floor($row['longitude']);
                    $long_minutos = floor(($row['longitude'] - $long_graus) * 60);
                    $long_seg
