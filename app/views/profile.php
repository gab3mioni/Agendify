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
                <p class="card-text">E-mail: <?php echo htmlspecialchars($profile['email']); ?></p>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="dashboard" class="btn btn-primary">Voltar para o Dashboard</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
