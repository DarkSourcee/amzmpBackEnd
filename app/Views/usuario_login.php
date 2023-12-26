<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>
    <!-- Adicione a referência ao Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Adicione a referência ao SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
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
        <div id="error-container"></div>

        <h1><?php echo $tit_formulario ?></h1>
        <form method="post" id="loginForm">

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

            <button type="button" class="btn btn-primary" onclick="submitForm()"><?php echo $acao ?></button>            
        </form>
        <a href="<?php echo base_url('Usuario/inserir'); ?>">
            <button class="btn btn-success w-100">Registrar-se</button>
        </a>
    </div>

    <!-- Adicione a referência ao Bootstrap JS e ao Popper.js, necessários para alguns recursos do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Adicione a referência ao SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function submitForm() {
            $.ajax({
                url: 'seu_script_php.php',
                method: 'POST',
                data: $('#loginForm').serialize(),
                success: function(response) {
                    // Verifica se a resposta contém erro
                    if (response.error) {
                        // Exibe o erro usando SweetAlert2
                        Swal.fire({
                            title: 'Erro!',
                            text: response.error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // Exemplo de uso do SweetAlert2 para sucesso
                        Swal.fire({
                            title: 'Bem-vindo!',
                            text: 'Login bem-sucedido!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(error) {
                    // Exibe erro genérico em caso de falha na requisição AJAX
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Erro ao processar a solicitação.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    </script>
</body>
</html>
