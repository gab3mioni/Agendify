<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendify | Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <h1 class="text-center">Informações do Usuário</h1>

        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>
        <?php if (isset($successMessage)) : ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Nome: <?php echo htmlspecialchars($profile['name']); ?></h5>
                <p class="card-text">Telefone: <?php echo htmlspecialchars($profile['phone_number']); ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editPhoneModal">
                        <i class="fas fa-edit ms-2"></i>
                    </a>
                </p>
                <p class="card-text">E-mail: <?php echo htmlspecialchars($profile['email']); ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editEmailModal">
                        <i class="fas fa-edit ms-2"></i>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPhoneModal" tabindex="-1" aria-labelledby="editPhoneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPhoneModalLabel">Editar Telefone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="profile/updatePhone">
                    <div class="mb-3">
                        <label for="new_phone" class="form-label">Novo Telefone</label>
                        <input type="text" class="form-control" id="new_phone" name="new_phone" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar Telefone</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmailModalLabel">Editar E-mail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="profile/updateEmail">
                    <div class="mb-3">
                        <label for="new_email" class="form-label">Novo E-mail</label>
                        <input type="email" class="form-control" id="new_email" name="new_email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar E-mail</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
