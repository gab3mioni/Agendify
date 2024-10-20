<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger">
        <?php echo $errorMessage; ?>
    </div>
<?php endif; ?>

<?php if (isset($successMessage)): ?>
    <div class="alert alert-success">
        <?php echo $successMessage; ?>
    </div>
<?php endif; ?>

<main>
    <div class="container mt-5">
        <h1 class="text-center">Registre-se no Agendify</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="register/register" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="name" placeholder="Digite seu nome completo" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="password" placeholder="Digite sua senha" required>
                    </div>

                    <div class="form-group">
                        <label for="confirmar-senha">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmar-senha" name="confirm_password" placeholder="Confirme sua senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
