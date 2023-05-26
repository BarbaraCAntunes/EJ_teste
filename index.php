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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="styles.css" />
  <link rel="icon" href="../assets/favicon.png" type="image/png" />
  <title>Home</title>
</head>

<body>

  <nav class="navbar navbar-expand-md fixed-top">
    <a class="navbar-brand" href="#">
      <img src="./assets/home.png" alt="Home" title="Home">
    </a>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="./assets/profile.png" alt="User Photo">
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Sair</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h2 class="mt-5 font-weight-bold">Dashboard</h2>

    <?php
    function getStatusCount($status, $tarefas)
    {
      $count = 0;
      foreach ($tarefas as $tarefa) {
        if ($tarefa[4] === $status) {
          $count++;
        }
      }
      return $count;
    }

    $tarefas = [
      ["Embargos de Declaração", "Eds omissão honorários", "24/05/2023", "27/05/2023", "Concluído"],
      ["Réplica", "Réplica abono de permanência", "2023-05-02", "2023-05-10", "Atrasado"],
      ["Agravo de Instrumento", "AI AJG", "2023-05-03", "-", "Em Andamento"]
    ];

    $doneCount = getStatusCount("Concluído", $tarefas);
    $inProgressCount = getStatusCount("Em Andamento", $tarefas);
    $pastDueDateCount = getStatusCount("Atrasado", $tarefas);
    ?>

    <div class="row mt-4">
      <div class="col-sm-3">
        <div class="card rounded" id="done">
          <div class="card-body">
            <div class="card-item">
              <p class="card-text text-right"><?php echo $doneCount; ?></p>
            </div>
            <div class=card-item>
              <h5 class="card-title font-weight-bold">Tarefa(s) Concluída(s)</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card rounded" id="inProgress">
          <div class="card-body">
            <div class="card-item">
              <p class="card-text text-right"><?php echo $inProgressCount; ?></p>
            </div>
            <div class="card-item">
              <h5 class="card-title font-weight-bold">Tarefa(s) Pendente(s)</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card rounded" id="pastDueDate">
          <div class="card-body">
            <div class="card-item">
              <p class="card-text text-right"><?php echo $pastDueDateCount; ?></p>
            </div>
            <div class="card-item">
              <h5 class="card-title font-weight-bold">Tarefa(s) Atrasada(s)</h5>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="button-container">

    <button class="btn btn-info" data-toggle="modal" data-target="#myModal">Criar tarefa</button>

    <div id="myModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Criar Tarefa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="seu_arquivo_php.php" method="POST">
              <div class="form-group">
                <label for="nomeTarefa">Nome da Tarefa<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nomeTarefa" name="nomeTarefa" required />
              </div>
              <div class="form-group">
                <label for="descricaoTarefa">Descrição da Tarefa<span class="text-danger">*</span></label>
                <textarea class="form-control" id="descricaoTarefa" name="descricaoTarefa" rows="5" required></textarea>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <button class="btn btn-info">Imprimir PDF</button>
    <button class="btn btn-info">Imprimir Excel</button>
  </div>

  <div class="tasksTitle">
    <h2 class="mt-5 font-weight-bold">Tarefas</h2>
  </div>

  <div id="taskModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detalhes da Tarefa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nomeTarefa">Nome da Tarefa<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="nomeTarefa" name="nomeTarefa" required />
            </div>
            <div class="form-group">
              <label for="descricaoTarefa">Descrição da Tarefa<span class="text-danger">*</span></label>
              <textarea class="form-control" id="descricaoTarefa" name="descricaoTarefa" rows="5" required></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger">Excluir Tarefa</button>
              <button type="button" class="btn btn-primary">Salvar Edições</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class=table-container>
    <table class="table table-bordered mt-5">
      <thead class="thead-light">
        <tr class="text-center">
          <th>Nome da Tarefa</th>
          <th>Descrição da Tarefa</th>
          <th>Data de Criação</th>
          <th>Data de Conclusão</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php
        function getStatusColor($status)
        {
          switch ($status) {
            case 'Concluído':
              return 'success';
            case 'Atrasado':
              return 'danger';
            case 'Em Andamento':
              return 'warning';
            default:
              return 'primary';
          }
        }

        $tarefas = [
          ["Embargos de Declaração", "Eds omissão honorários", "24/05/2023", "27/05/2023", "Concluído"],
          ["Réplica", "Réplica abono de permanência", "2023-05-02", "2023-05-10", "Atrasado"],
          ["Agravo de Instrumento", "AI AJG", "2023-05-03", "-", "Em Andamento"]
        ];

        foreach ($tarefas as $tarefa) {
          $nomeTarefa = $tarefa[0];
          $descricaoTarefa = $tarefa[1];
          $dataCriacao = $tarefa[2];
          $dataConclusao = $tarefa[3];
          $status = $tarefa[4];
          echo '<tr class="text-center table-row-clickable">';
          echo '<td>' . $nomeTarefa . '</td>';
          echo '<td>' . $descricaoTarefa . '</td>';
          echo '<td>' . $dataCriacao . '</td>';
          echo '<td>' . $dataConclusao . '</td>';
          echo '<td><span class="badge badge-' . getStatusColor($status) . '">' . $status . '</span></td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.table-row-clickable').click(function() {
        $('#taskModal').modal('show');
      });
    });
  </script>
</body>

</html>