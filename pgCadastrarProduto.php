<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastrar - E-co Gram</title>
<link rel="stylesheet" href="pgCadastrar.css">
</head>
<body>
<div class="header">
    <div>Novo Cadastro</div>
    <div>E-co Gram</div>
</div>
<div class="container">
    <form action="cadastrarProduto.php" method="post" enctype="multipart/form-data">
    
    <div class="campo">
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao">
    </div>

    <div class="campo">
    <label for="grupo">Grupo:</label>
    <select id="grupo" name="grupo">
        <option value="">Selecione o Grupo</option>
        <?php
            include('db.php');
  
            $result = $conn->query("SELECT id, nome FROM categoria ORDER BY nome");
                
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
            }
        ?>
    </select>
</div>

<div class="campo">
    <label for="usuario">Usuário:</label>
    <select id="usuario" name="usuario">
        <option value="">Selecione o Usuário</option>
        <?php
            include('db.php');
  
            $result = $conn->query("SELECT id, nome FROM usuario ORDER BY nome");
                
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
            }
        ?>
    </select>
</div>

    <div class="campo">
        <label for="data">Data:</label>
        <input type="date" id="data" name="data">
    </div>

    <div class="campo">
        <label for="imagem">Adicionar Imagens:</label>
        <input type="file" id="imagem" name="imagem" multiple onchange="exibirImagemPreview(event)">
    </div>

    <div class="imagem-preview" id="imagemPreview">
    </div>

    <input type="submit" value="Cadastrar" id="botao-cadastrar">
</form>
</div>

<script>
    function exibirImagemPreview(event) {
        var imagemPreview = document.getElementById('imagemPreview');
        imagemPreview.innerHTML = '';
    
        var files = event.target.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
    
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                imagemPreview.appendChild(img);
            }
    
            reader.readAsDataURL(file);
        }
}
</script>
</body>
</html>