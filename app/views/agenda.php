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
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($appointments)) : ?>
                                <?php foreach ($appointments as $appointment): ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y', strtotime($appointment['appointment_date'])) ?></td>
                                        <td><?php echo htmlspecialchars($appointment['start_time']) ?></td>
                                        <td><?php echo htmlspecialchars($appointment['title']) ?>  </td>
                                        <td><?php echo htmlspecialchars($appointment['description']) ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editAppointmentModal"
                                                    data-id="<?php echo $appointment['id']; ?>"
                                                    data-title="<?php echo htmlspecialchars($appointment['title']); ?>"
                                                    data-description="<?php echo htmlspecialchars($appointment['description']); ?>"
                                                    data-date="<?php echo $appointment['appointment_date']; ?>"
                                                    data-start-time="<?php echo $appointment['start_time']; ?>"
                                                    data-end-time="<?php echo $appointment['end_time']; ?>">
                                                Editar
                                            </button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteAppointmentModal"
                                                    data-id="<?php echo $appointment['id']; ?>">
                                                Excluir
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum compromisso encontrado.</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="editAppointmentModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAppointmentModalLabel">Editar Compromisso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="agenda/editAppointment">
                    <input type="hidden" name="appointment_id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-title" class="form-label">Título</label>
                        <input type="text" class="form-control" name="title" id="edit-title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Descrição</label>
                        <textarea class="form-control" name="description" id="edit-description" rows="3"
                                  required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-date" class="form-label">Data</label>
                        <input type="date" class="form-control" name="date" id="edit-date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-start-time" class="form-label">Hora de Início</label>
                        <input type="time" class="form-control" name="start_time" id="edit-start-time" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-end-time" class="form-label">Hora de Término</label>
                        <input type="time" class="form-control" name="end_time" id="edit-end-time" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteAppointmentModal" tabindex="-1" aria-labelledby="deleteAppointmentModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAppointmentModalLabel">Excluir Compromisso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja excluir este compromisso?</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="agenda/deleteAppointment">
                    <input type="hidden" name="appointment_id" id="delete-id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let editModal = document.getElementById('editAppointmentModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        document.getElementById('edit-id').value = button.getAttribute('data-id');
        document.getElementById('edit-title').value = button.getAttribute('data-title');
        document.getElementById('edit-description').value = button.getAttribute('data-description');
        document.getElementById('edit-date').value = button.getAttribute('data-date');
        document.getElementById('edit-start-time').value = button.getAttribute('data-start-time');
        document.getElementById('edit-end-time').value = button.getAttribute('data-end-time');
    });

    let deleteModal = document.getElementById('deleteAppointmentModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        document.getElementById('delete-id').value = button.getAttribute('data-id');
    });
</script>

</body>
</html>
