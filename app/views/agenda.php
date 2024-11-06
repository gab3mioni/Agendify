<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda | Agendify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>

<nav class="sidebar">
    <a href="dashboard">Dashboard</a>
    <a href="agenda">Agenda</a>
    <a href="profile">Editar Perfil</a>
    <a href="#">Configurações</a>
    <a href="logout">Sair</a>
</nav>

<div class="content">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Agenda</h1>

                <div class="mt-5">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addAppointmentModal">
                        + Adicionar compromisso
                    </button>
                </div>

                <div class="modal fade" id="addAppointmentModal" tabindex="-1"
                     aria-labelledby="addAppointmentModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAppointmentModalLabel">Adicionar Compromisso</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="agenda/addAppointment">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Título</label>
                                        <input type="text" class="form-control" name="title" id="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Descrição</label>
                                        <textarea class="form-control" name="description" id="description" rows="3"
                                                  required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Data</label>
                                        <input type="date" class="form-control" name="date" id="date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_time" class="form-label">Hora de Início</label>
                                        <input type="time" class="form-control" name="start_time" id="start_time"
                                               required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_time" class="form-label">Hora de Término</label>
                                        <input type="time" class="form-control" name="end_time" id="end_time" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar
                                        </button>
                                        <button type="submit" class="btn btn-primary">Adicionar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-12">

                <div class="card bg-light my-4">
                    <div class="card-header">
                        <h4>Meus Compromissos</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Titulo</th>
                                <th>Descrição</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- NÃO MEXER NO CÓDIGO A SEGUIR -->
                            <?php if (!empty($appointments)) : ?>
                                <?php foreach ($appointments as $appointment): ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y', strtotime($appointment['appointment_date'])) ?></td>
                                        <td><?php echo htmlspecialchars($appointment['start_time']) ?></td>
                                        <td><?php echo htmlspecialchars($appointment['title']) ?>  </td>
                                        <td><?php echo htmlspecialchars($appointment['description']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Nenhuma transação encontrada.</td>
                                </tr>
                            <?php endif; ?>
                            <!-- NÃO MEXER NO CÓDIGO ACIMA -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/agenda.js"></script>

</body>
</html>
