<?php include 'library/database/connection.php';
try {
  $stmt = $conn->prepare('SELECT * FROM users');
  $stmt->execute();

  $result = $stmt->fetchAll();

  if (count($result)) {
    foreach ($result as $row) {
      print_r($row);
    }
  } else {
    echo "Nennhum resultado retornado.";
  }
} catch (PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="loginStyle.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./js/bootstrap.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">
  <link rel="icon" href="assets/favicon.png" type="image/png">
  <title>Login</title>
  <?php
  $openModal = isset($_GET['openModal']) && $_GET['openModal'] == 'true';
  ?>
</head>

<body>
  <div class="custom-container">
    <div class="row justify-content-center">
      <form>
        <div class="mb-3">
          <label for="email" class="form-label">Usuário</label>
          <br>
          <input type="email" class="form-control" id="email" placeholder="Insira seu e-mail" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <br>
          <input type="password" class="form-control" id="password" placeholder="Insira sua senha" required>
        </div>
        <button type="submit" class="btn btn-info">Login</button>
        <button class="btn btn-link">Esqueci a senha</button>
        <button class="btn btn-link " id="registerButton" data-toggle="modal" data-target="#myModal">Registre-se</button>
      </form>
    </div>
  </div>

  <div id="myModal" class="modal fade<?php echo $openModal ? ' show' : ''; ?>" tabindex="-1" role="dialog" style="<?php echo !$openModal ? 'display: none;' : ''; ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registrar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nome">Nome<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
              <label for="telefone">Telefone<span class="text-danger">*</span></label>
              <input type="tel" class="form-control" id="telefone" name="telefone" required pattern="\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}">
              <small>Formato válido: (99) 99999-9999 ou (99) 9999-9999</small>
            </div>
            <div class="form-group">
              <label for="email">E-mail<span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="emailRegister" name="email" required>
            </div>
            <div class="form-group">
              <label for="senha">Senha<span class="text-danger">*</span></label>
              <input type="password" class="form-control" id="senha" name="senha" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
              <small>A senha deve conter no mínimo 8 caracteres, incluindo pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial (@$!%*?&)</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btnGeneral">Salvar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('registerButton').addEventListener('click', function() {
      document.getElementById('myModal').style.display = 'block';
    });
  </script>
</body>

</html>