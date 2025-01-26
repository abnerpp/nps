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

// Obter lista de lojas
$lojas = [];
$lojas_result = $conn->query("SELECT DISTINCT loja FROM votos");
if ($lojas_result->num_rows > 0) {
    while ($row = $lojas_result->fetch_assoc()) {
        $lojas[] = $row['loja'];
    }
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Resultados da Pesquisa de Satisfação</h1>
    <form method="GET" action="">
        <label for="loja">Filtrar por loja:</label>
        <select id="loja" name="loja">
            <option value="">Todas as lojas</option>
            <?php foreach ($lojas as $opcao_loja): ?>
                <option value="<?php echo htmlspecialchars($opcao_loja); ?>" <?php if ($loja === $opcao_loja) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($opcao_loja); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Aplicar Filtro</button>
    </form>

    <?php if (!empty($loja)): ?>
        <h2>Loja: <?php echo htmlspecialchars($loja); ?></h2>
    <?php endif; ?>

    <p>Total de Respostas: <?php echo $total; ?></p>
    <p>Promotores: <?php echo $promotores; ?> (<?php echo number_format($percent_promotores, 2); ?>%)</p>
    <p>Passivos: <?php echo $passivos; ?></p>
    <p>Detratores: <?php echo $detratores; ?> (<?php echo number_format($percent_detratores, 2); ?>%)</p>
    <h2>NPS: <?php echo number_format($nps, 2); ?></h2>

    <canvas id="npsChart" width="400" height="200"></canvas>
    <script>
        const ctx = document.getElementById('npsChart').getContext('2d');
        const npsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Promotores', 'Passivos', 'Detratores'],
                datasets: [{
                    label: 'Respostas',
                    data: [<?php echo $promotores; ?>, <?php echo $passivos; ?>, <?php echo $detratores; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
