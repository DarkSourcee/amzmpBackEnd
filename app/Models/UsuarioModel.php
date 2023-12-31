<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model {
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nome','email','login','senha'];
    protected $returnType = 'object';
}