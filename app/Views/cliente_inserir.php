<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>
    <!-- Adicione a referência ao Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>
<body>
    <div class="container mt-5">
        <?php echo $msg; ?>

        <h1><?php echo $tit_formulario ?></h1>
        <form method='post'>
            <!-- Campo Nome -->
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome">
            </div>

            <!-- Campo Email -->
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            </div>

            <!-- Campo Telefone -->
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(99) 99999-9999">
            </div>

            <!-- Campos de Endereço -->
            <div class="form-group">
                <label for="endereco_cep">CEP</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="endereco_cep" name="endereco_cep" placeholder="XXXXX-XXX">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="consultarViaCEP()">Consultar</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="endereco_rua">Rua</label>
                <input type="text" class="form-control" id="endereco_rua" name="endereco_rua" placeholder="Nome da Rua">
            </div>

            <div class="form-group">
                <label for="endereco_logradouro">Logradouro</label>
                <input type="text" class="form-control" id="endereco_logradouro" name="endereco_logradouro" placeholder="Logradouro">
            </div>

            <div class="form-group">
                <label for="endereco_bairro">Bairro</label>
                <input type="text" class="form-control" id="endereco_bairro" name="endereco_bairro" placeholder="Bairro">
            </div>

            <div class="form-group">
                <label for="endereco_uf">UF</label>
                <input type="text" class="form-control" id="endereco_uf" name="endereco_uf" placeholder="UF">
            </div>

            <button type="submit" class="btn btn-primary"><?php echo $acao ?></button>
            <a href="<?php echo base_url('Clientes/listagem') ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>
        </form>
    </div>

    <!-- Adicione a referência ao Bootstrap JS e ao Popper.js, necessários para alguns recursos do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function consultarViaCEP() {
            var cep = document.getElementById('endereco_cep').value;
            cep = cep.replace(/\D/g, ''); // Remove caracteres não numéricos

            if (cep.length !== 8) {
                alert('CEP inválido. Certifique-se de inserir 8 dígitos.');
                return;
            }

            // URL da API do Via CEP
            var url = 'https://viacep.com.br/ws/' + cep + '/json/';

            // Requisição AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse da resposta JSON
                        var data = JSON.parse(xhr.responseText);

                        // Preencha automaticamente os campos de endereço com os dados da resposta
                        document.getElementById('endereco_rua').value = data.logradouro || '';
                        document.getElementById('endereco_bairro').value = data.bairro || '';
                        document.getElementById('endereco_cidade').value = data.localidade || '';
                        document.getElementById('endereco_uf').value = data.uf || '';
                    } else {
                        alert('Erro ao consultar o Via CEP. Verifique o CEP inserido.');
                    }
                }
            };
            xhr.open('GET', url, true);
            xhr.send();
        }

        function exibirMensagem(mensagem, classe) {
            var mensagemElement = document.getElementById('mensagem');
            mensagemElement.innerHTML = mensagem;
            mensagemElement.className = 'alert ' + classe;
        }
    </script>
</body>
</html>
