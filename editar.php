<?php
$host = 'localhost'; // ou o endereço do seu servidor
$db = 'dessalinizacao';
$user = 'root'; // ou o seu usuário do banco de dados
$pass = ''; // ou a sua senha do banco de dados

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM sistemas_dessalinizacao WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Nenhum dado encontrado.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Dados de Dessalinização</title>
    <style>
        /* Estilo semelhante ao usado no formulário de inserção */
    </style>
</head>
<body>
    <h2>Editar Dados do Sistema de Dessalinização</h2>

    <form action="atualiza_dados.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="">Selecione o Estado</option>
            <option value="AC" <?php if($row['estado'] == 'AC') echo 'selected'; ?>>Acre</option>
            <option value="AL" <?php if($row['estado'] == 'AL') echo 'selected'; ?>>Alagoas</option>
            <option value="AP" <?php if($row['estado'] == 'AP') echo 'selected'; ?>>Amapá</option>
            <option value="AM" <?php if($row['estado'] == 'AM') echo 'selected'; ?>>Amazonas</option>
            <option value="BA" <?php if($row['estado'] == 'BA') echo 'selected'; ?>>Bahia</option>
            <option value="CE" <?php if($row['estado'] == 'CE') echo 'selected'; ?>>Ceará</option>
            <option value="DF" <?php if($row['estado'] == 'DF') echo 'selected'; ?>>Distrito Federal</option>
            <option value="ES" <?php if($row['estado'] == 'ES') echo 'selected'; ?>>Espírito Santo</option>
            <option value="GO" <?php if($row['estado'] == 'GO') echo 'selected'; ?>>Goiás</option>
            <option value="MA" <?php if($row['estado'] == 'MA') echo 'selected'; ?>>Maranhão</option>
            <option value="MT" <?php if($row['estado'] == 'MT') echo 'selected'; ?>>Mato Grosso</option>
            <option value="MS" <?php if($row['estado'] == 'MS') echo 'selected'; ?>>Mato Grosso do Sul</option>
            <option value="MG" <?php if($row['estado'] == 'MG') echo 'selected'; ?>>Minas Gerais</option>
            <option value="PA" <?php if($row['estado'] == 'PA') echo 'selected'; ?>>Pará</option>
            <option value="PB" <?php if($row['estado'] == 'PB') echo 'selected'; ?>>Paraíba</option>
            <option value="PR" <?php if($row['estado'] == 'PR') echo 'selected'; ?>>Paraná</option>
            <option value="PE" <?php if($row['estado'] == 'PE') echo 'selected'; ?>>Pernambuco</option>
            <option value="PI" <?php if($row['estado'] == 'PI') echo 'selected'; ?>>Piauí</option>
            <option value="RJ" <?php if($row['estado'] == 'RJ') echo 'selected'; ?>>Rio de Janeiro</option>
            <option value="RN" <?php if($row['estado'] == 'RN') echo 'selected'; ?>>Rio Grande do Norte</option>
            <option value="RS" <?php if($row['estado'] == 'RS') echo 'selected'; ?>>Rio Grande do Sul</option>
            <option value="RO" <?php if($row['estado'] == 'RO') echo 'selected'; ?>>Rondônia</option>
            <option value="RR" <?php if($row['estado'] == 'RR') echo 'selected'; ?>>Roraima</option>
            <option value="SC" <?php if($row['estado'] == 'SC') echo 'selected'; ?>>Santa Catarina</option>
            <option value="SP" <?php if($row['estado'] == 'SP') echo 'selected'; ?>>São Paulo</option>
            <option value="SE" <?php if($row['estado'] == 'SE') echo 'selected'; ?>>Sergipe</option>
            <option value="TO" <?php if($row['estado'] == 'TO') echo 'selected'; ?>>Tocantins</option>
        </select>

        <label for="municipio">Município:</label>
        <input type="text" id="municipio" name="municipio" value="<?php echo $row['municipio']; ?>" required>

        <label for="nome_comunidade">Nome da Comunidade:</label>
        <input type="text" id="nome_comunidade" name="nome_comunidade" value="<?php echo $row['nome_comunidade']; ?>" required>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="À Iniciar" <?php if($row['status'] == 'À Iniciar') echo 'selected'; ?>>À Iniciar</option>
            <option value="Em Obras" <?php if($row['status'] == 'Em Obras') echo 'selected'; ?>>Em Obras</option>
            <option value="Sistema em Operação" <?php if($row['status'] == 'Sistema em Operação') echo 'selected'; ?>>Sistema em Operação</option>
        </select>

        <label for="quantidade_agua">Produção de Água Dessalinizada (L/h):</label>
        <input type="number" id="quantidade_agua" name="quantidade_agua" step="0.01" value="<?php echo $row['quantidade_agua']; ?>" required>

        <label for="pessoas_atendidas">Pessoas Atendidas:</label>
        <input type="number" id="pessoas_atendidas" name="pessoas_atendidas" value="<?php echo $row['pessoas_atendidas']; ?>" required>

        <label for="tds_poco">TDS Poço (mg/L):</label>
        <input type="number" id="tds_poco" name="tds_poco" step="0.01" value="<?php echo $row['tds_poco']; ?>" required>

        <label for="tds_permeado">TDS Permeado (mg/L):</label>
        <input type="number" id="tds_permeado" name="tds_permeado" step="0.01" value="<?php echo $row['tds_permeado']; ?>" required>

        <label for="tds_concentrado">TDS Concentrado (mg/L):</label>
        <input type="number" id="tds_concentrado" name="tds_concentrado" step="0.01" value="<?php echo $row['tds_concentrado']; ?>" required>

        <h3>Latitude:</h3>
        Graus: <input type="number" id="lat_graus" name="lat_graus" value="<?php echo floor($row['latitude']); ?>" required>
        Minutos: <input type="number" id="lat_minutos" name="lat_minutos" value="<?php echo floor(($row['latitude'] - floor($row['latitude'])) * 60); ?>" required>
        Segundos: <input type="number" id="lat_segundos" name="lat_segundos" step="0.01" value="<?php echo (($row['latitude'] - floor($row['latitude'])) * 3600) % 60; ?>" required>

        <h3>Longitude:</h3>
        Graus: <input type="number" id="long_graus" name="long_graus" value="<?php echo floor($row['longitude']); ?>" required>
        Minutos: <input type="number" id="long_minutos" name="long_minutos" value="<?php echo floor(($row['longitude'] - floor($row['longitude'])) * 60); ?>" required>
        Segundos: <input type="number" id="long_segundos" name="long_segundos" step="0.01" value="<?php echo (($row['longitude'] - floor($row['longitude'])) * 3600) % 60; ?>" required>

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
