<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar se o usuário está autenticado
        $session = \Config\Services::session();
        if (!$session->has('usuario_login')) {
            // Usuário não autenticado, redirecionar para a página de login
            return redirect()->to(base_url('Usuario/login'));
        }

        // Usuário autenticado, permitir acesso à rota
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não há ações após a execução da requisição neste exemplo
    }
}
