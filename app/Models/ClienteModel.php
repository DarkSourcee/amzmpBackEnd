<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model {
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    protected $allowedFields = ['nome','email','telefone','endereco_rua','endereco_cep','endereco_logradouro','endereco_bairro','endereco_uf'];
    protected $returnType = 'object';
}