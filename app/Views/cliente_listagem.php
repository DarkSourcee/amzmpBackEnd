<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1><?php echo $titulo ?></h1>
        <p><a href="<?php echo base_url('Clientes') ?>"><button class="btn btn-primary">Novo cliente</button></a></p>

        <!-- Bootstrap Table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Rua</th>
                    <th scope="col">Logradouro</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">UF</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clientes as $cliente) : ?>
                    <tr>
                        <td><?php echo $cliente->id_cliente?></td>
                        <td><?php echo $cliente->nome?></td>
                        <td><?php echo $cliente->email?></td>
                        <td><?php echo $cliente->telefone?></td>
                        <td><?php echo $cliente->endereco_cep?></td>
                        <td><?php echo $cliente->endereco_rua?></td>
                        <td><?php echo $cliente->endereco_logradouro?></td>
                        <td><?php echo $cliente->endereco_bairro?></td>
                        <td><?php echo $cliente->endereco_uf?></td>
                        <td><a href="<?php echo base_url('Clientes/editar/' . $cliente->id_cliente) ?>"><button class="btn btn-primary">Editar</button></a></td>
                        <td><a href="#" class="btn btn-danger btn-excluir" data-url="<?php echo base_url('Clientes/excluir/' . $cliente->id_cliente) ?>">Excluir</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optional, for certain components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Adiciona um listener para os botões de excluir
            const buttons = document.querySelectorAll('.btn-excluir');

            buttons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    const url = this.getAttribute('data-url');

                    // Exibe uma janela de confirmação com SweetAlert
                    Swal.fire({
                        title: 'Tem certeza?',
                        text: 'Esta ação não poderá ser desfeita!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sim, excluir!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Se o usuário confirmar, redirecione para a URL de exclusão
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
