<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>
    <!-- Adicione a referência ao Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Adicione estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin-top: 50px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($msg)) : ?>
            <div class="alert <?php echo $msg_class; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>

        <h1><?php echo $tit_formulario ?></h1>
        <form method="post">

            <!-- Campo Login -->
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Seu login">
            </div>

            <!-- Campo Senha -->
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha ****">
            </div>

            <button type="submit" id="acao" class="btn btn-primary"><?php echo $acao ?></button>            
        </form>
        <a href="<?php echo base_url('Usuario/inserir'); ?>">
            <button class="btn btn-success w-100">Registrar-se</button>
        </a>
    </div>

    <!-- Adicione a referência ao Bootstrap JS e ao Popper.js, necessários para alguns recursos do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</body>
</html>
