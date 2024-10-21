<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendify | Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>

<nav class="sidebar">
    <a href="dashboard">Dashboard</a>
    <a href="#">Agenda</a>
    <a href="profile">Editar Perfil</a>
    <a href="#">Configurações</a>
    <a href="logout">Sair</a>
</nav>

<div class="content">
    <div class="container mt-5">
        <h1 class="text-center">Informações do Usuário</h1>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Nome: <?php echo htmlspecialchars($profile['name']); ?></h5>
                <p class="card-text">E-mail atual: <?php echo htmlspecialchars($profile['email']); ?></p>
            </div>
        </div>

        <div class="mt-4">
            <h4>Alterar E-mail</h4>
            <?php if(isset($errorMessage)): ?>
                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
            <?php if(isset($successMessage)): ?>
                <div class="alert alert-success"><?php echo $successMessage; ?></div>
            <?php endif; ?>
            <form method="POST" action="profile">
                <div class="mb-3">
                    <label for="new_email" class="form-label">Novo E-mail</label>
                    <input type="email" class="form-control" id="new_email" name="new_email" required>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar E-mail</button>
            </form>
        </div>

        <div class="text-center mt-3">
            <a href="dashboard" class="btn btn-secondary">Voltar para o Dashboard</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
