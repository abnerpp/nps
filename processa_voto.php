<?php
$servername = "localhost";
$username = "superuser";
$password = "SuperSenha@123";
$dbname = "fribal_nps";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Filtrar por loja, se necessário
$loja = isset($_GET['loja']) ? $conn->real_escape_string($_GET['loja']) : '';

$sql = "SELECT nota FROM votos";
if (!empty($loja)) {
    $sql .= " WHERE loja = '$loja'";
}

$result = $conn->query($sql);

$total = $promotores = $passivos = $detratores = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nota = (int) $row['nota'];
        $total++;
        if ($nota >= 9) $promotores++;
        elseif ($nota >= 7) $passivos++;
        else $detratores++;
    }
}

$percent_promotores = ($total > 0) ? ($promotores / $total) * 100 : 0;
$percent_detratores = ($total > 0) ? ($detratores / $total) * 100 : 0;
$nps = $percent_promotores - $percent_detratores;

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - NPS</title>
</head>
<body>
    <h1>Resultados da Pesquisa de Satisfação</h1>
    <?php if (!empty($loja)): ?>
        <h2>Loja: <?php echo htmlspecialchars($loja); ?></h2>
    <?php endif; ?>
    <p>Total de Respostas: <?php echo $total; ?></p>
    <p>Promotores: <?php echo $promotores; ?> (<?php echo number_format($percent_promotores, 2); ?>%)</p>
    <p>Passivos: <?php echo $passivos; ?></p>
    <p>Detratores: <?php echo $detratores; ?> (<?php echo number_format($percent_detratores, 2); ?>%)</p>
    <h2>NPS: <?php echo number_format($nps, 2); ?></h2>
</body>
</html>

<?php
$servername = "localhost";
$username = "superuser";
$password = "SuperSenha@123";
$dbname = "fribal_nps";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $conn->real_escape_string($_POST['nome']);
    $loja = $conn->real_escape_string($_POST['loja']);
    $nota = (int) $_POST['nota'];

    if (!empty($nome) && !empty($loja) && $nota >= 0 && $nota <= 10) {
        $sql = "INSERT INTO votos (nome, loja, nota) VALUES ('$nome', '$loja', $nota)";
        if ($conn->query($sql) === TRUE) {
            echo "Voto registrado com sucesso!";
        } else {
            echo "Erro ao registrar voto: " . $conn->error;
        }
    } else {
        echo "Todos os campos são obrigatórios e a nota deve estar entre 0 e 10.";
    }
}

$conn->close();
?>
