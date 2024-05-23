<?php
    include ('db.php');
    include('proteger.php');

    // Inicialize as variáveis de pesquisa
    $pesquisaId = isset($_GET['busca_id']) ? $conn->real_escape_string($_GET['busca_id']) : '';
    $pesquisaDescricao = isset($_GET['busca_descricao']) ? $conn->real_escape_string($_GET['busca_descricao']) : '';
    $pesquisaGrupo = isset($_GET['busca_grupo']) ? $conn->real_escape_string($_GET['busca_grupo']) : '';

    $result = null; // Inicializa $result como null

    // Verifica se o botão de pesquisa foi clicado
    if (isset($_GET['busca_id']) || isset($_GET['busca_descricao']) || isset($_GET['busca_grupo'])) {
        // Se algum critério de pesquisa for especificado, construa a consulta SQL
        $sql = "SELECT * FROM produto WHERE 1"; // Inicializa a consulta com 1 para garantir que sempre haverá uma condição

        // Adiciona condições à consulta com base nos campos preenchidos
        if (!empty($pesquisaId)) {
            $sql .= " AND id = '$pesquisaId'";
        }
        if (!empty($pesquisaDescricao)) {
            $sql .= " AND descricao LIKE '%$pesquisaDescricao%'";
        }
        if (!empty($pesquisaGrupo)) {
            $sql .= " AND grupo_id LIKE '%$pesquisaGrupo%'";
        }

        // Executa a consulta SQL
        $result = $conn->query($sql);

        // Verifica se ocorreu um erro na execução da consulta
        if (!$result) {
            die("ERRO ao Consultar! " . $conn->error);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="pgPesquisar.css">
<title>Pesquisar - E-co Gram</title>

</head>
<body>
    <a href="pgInicial.php" class="botao-voltar">&#8592; Voltar</a>

    <div class="header">
        <div id="logo">E-co Gram</div>
        <div id="gerenciador">Gerenciador de Imagens</div>
    </div>
    <div class="container">
        <form action="" method="get">
            <div class="campo">
                <label for="id">Código:</label>
                <input type="text" placeholder="Digite os Códigos" name="busca_id" class="campo-input">
            </div>
            <div class="campo">
                <label for="descricao">Descrição:</label>
                <input type="text" placeholder="Digite a Descrição" name="busca_descricao" class="campo-input">
            </div>
            <div class="campo">
                <label for="grupo">Grupo:</label>
                <input type="text" placeholder="Digite o Grupo" name="busca_grupo" class="campo-input">
            </div>
            <button type="submit" class="botao-pesquisar">Pesquisar</button>
        </form>
        </div>
    <div class="resultado-pesquisa">
    <?php if ($result && ($result->num_rows > 0 || empty($pesquisaId) && empty($pesquisaDescricao) && empty($pesquisaGrupo))): ?>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Grupo</th>
                <th>Usuário</th>
                <th>Data</th>
                <th>Imagem</th>
            </tr>
        </thead>
        <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['descricao']; ?></td>
                        <td><?php echo $row['grupo_nome']; ?></td>
                        <td><?php echo $row['usuario_nome']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($row['data'])); ?></td>
                        <td><img height="80" src="<?php echo $row['imagem']; ?>" alt=""></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php elseif (!empty($pesquisaId) && $result && $result->num_rows === 0): ?>
        <p>Nenhum resultado encontrado.</p>
    <?php endif; ?>
</div>
</body>
</html>