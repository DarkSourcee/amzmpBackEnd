<?php 

namespace App\Controllers;

use Config\Services;

class UsuarioController extends BaseController 
{
    protected $session;

    public function __construct()
    {
        $this->session = Services::session();
    }

    public function index()
    {
        $data['titulo'] = 'Login';
        $data['acao'] = 'Logar';
        $data['tit_formulario'] = 'Login';
        $data['msg'] = ''; 
    
        if ($this->request->getMethod() === 'post') {
            $login = $this->request->getPost('login');
            $senha = md5($this->request->getPost('senha'));
    
            if ($this->logar($login, $senha)) {
                // Login bem-sucedido
                $data['msg'] = 'Login bem-sucedido!';
                $data['msg_class'] = 'alert-success';
                $usuario_login = $login; 
                $this->session->set('usuario_login', $usuario_login); 
                $data['msg'] = $session_user = $this->session->get('usuario_login'); 
                echo $data['msg'];
                return redirect()->to(base_url('Clientes/listagem'));
            } else {
                // Falha no login
                $data['msg'] = 'Erro ao logar. Verifique suas credenciais.';
                $data['msg_class'] = 'alert-danger';
            }
        }
    
        echo view('usuario_login', $data);
    }
    
    public function inserir()
    {
        $data['titulo'] = 'Registrar usuário';
        $data['acao'] = 'Cadastrar';
        $data['tit_formulario'] = 'Registrar usuário';
        $data['msg'] = ''; 

        if ($this->request->getMethod() === 'post')
        {
            $usuario_inserir = new \App\Models\UsuarioModel();

            $email = $this->request->getPost('email');
            $name = $this->request->getPost('nome');
            $login = $this->request->getPost('login');

            $existingUsuario = $usuario_inserir
                ->where('email', $email)
                ->orWhere('nome', $name)
                ->orWhere('login', $login)
                ->first();

            if ($existingUsuario) {
                $data['msg'] = 'Usuário com o mesmo email, nome ou login já existe.';
                $data['msg_class'] = 'alert-warning';
            } else {
                $usuario_inserir->set('nome', $this->request->getPost('nome'));
                $usuario_inserir->set('email', $this->request->getPost('email'));
                $usuario_inserir->set('login', $this->request->getPost('login'));
                $usuario_inserir->set('senha', md5($this->request->getPost('senha')));

                if ($usuario_inserir->insert())
                {
                    $data['msg'] = 'Inserido com sucesso!';
                    $data['msg_class'] = 'alert-success';
                    $data['tipoMsg'] = 'success';
                    return $this->index();
                }else 
                {
                    // Não inseriu
                    $data['msg'] = 'Erro ao inserir: ' . $usuario_inserir->errors();
                    $data['msg_class'] = 'alert-danger';
                    $data['tipoMsg'] = 'error';
                    var_dump($data);
                }
            }
        }

        echo View('usuario_inserir',$data);

    }

    public function logar($login, $senha)
    {
        // verificar se pode logar ou não
        $usuario_logar = new \App\Models\UsuarioModel();

        $existingUsuario = $usuario_logar
            ->where('login', $login)
            ->where('senha', $senha)
            ->first();

        if ($existingUsuario) {
            return true; // Login com sucesso
        } else {
            return false; // Falha no login
        }
    }

}