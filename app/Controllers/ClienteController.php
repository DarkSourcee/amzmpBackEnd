<?php 

namespace App\Controllers;

class ClienteController extends BaseController 
{

    public function index()
    {
        $cliente_listagem = new \App\Models\ClienteModel();
        $data['titulo'] = 'Listagem de clientes';
        $data['clientes'] = $cliente_listagem->findAll();

        echo view('cliente_listagem',$data);
    }

    public function inserir()
    {
        $data['titulo'] = 'Registrar cliente';
        $data['acao'] = 'Cadastrar';
        $data['tit_formulario'] = 'Registrar Cliente';
        $data['msg'] = ''; 

        if ($this->request->getMethod() === 'post')
        {
            $cliente_inserir = new \App\Models\ClienteModel();

            $email = $this->request->getPost('email');
            $name = $this->request->getPost('nome');

            $existingCliente = $cliente_inserir
                ->where('email', $email)
                ->orWhere('nome', $name)
                ->first();

            if ($existingCliente) {
                $data['msg'] = 'Cliente com o mesmo email ou nome já existe.';
                $data['msg_class'] = 'alert-warning';
            } else {
                $cliente_inserir->set('nome', $this->request->getPost('nome'));
                $cliente_inserir->set('email', $this->request->getPost('email'));
                $cliente_inserir->set('telefone', $this->request->getPost('telefone'));
                $cliente_inserir->set('endereco_rua', $this->request->getPost('endereco_rua'));
                $cliente_inserir->set('endereco_cep', $this->request->getPost('endereco_cep'));
                $cliente_inserir->set('endereco_logradouro', $this->request->getPost('endereco_logradouro'));
                $cliente_inserir->set('endereco_bairro', $this->request->getPost('endereco_bairro'));
                $cliente_inserir->set('endereco_uf', $this->request->getPost('endereco_uf'));

                if ($cliente_inserir->insert())
                {
                    $data['msg'] = 'Inserido com sucesso!';
                    $data['msg_class'] = 'alert-success';
                    $data['tipoMsg'] = 'success';
                }else 
                {
                    // Não inseriu
                    $data['msg'] = 'Erro ao inserir: ' . $cliente_inserir->errors();
                    $data['msg_class'] = 'alert-danger';
                    $data['tipoMsg'] = 'error';
                    var_dump($data);
                }
            }
        }

        echo View('cliente_inserir',$data);

    }

    public function editar($id)
    {
        $data['titulo'] = 'Editar cliente';
        $data['acao'] = 'Editar';
        $data['tit_formulario'] = 'Editar Cliente';
        $data['msg'] = ''; 

        $cliente_editar = new \App\Models\ClienteModel();

        $cliente = $cliente_editar->find($id);

        if ($this->request->getMethod() === 'post')
        {
            $cliente->nome = $this->request->getPost('nome');
            $cliente->email = $this->request->getPost('email');
            $cliente->telefone = $this->request->getPost('telefone');
            $cliente->endereco_rua = $this->request->getPost('endereco_rua');
            $cliente->endereco_cep = $this->request->getPost('endereco_cep');
            $cliente->endereco_logradouro = $this->request->getPost('endereco_logradouro');
            $cliente->endereco_bairro = $this->request->getPost('endereco_bairro');
            $cliente->endereco_uf = $this->request->getPost('endereco_uf');

            if ($cliente_editar->update($id, $cliente))
            {
                $data['msg'] = 'Cliente atualizado com sucesso!';
                // return $this->response->redirect(site_url('Clientes/index'));
                return $this->index();
            }
            else 
            {
                $data['msg'] = 'Erro ao editar o cliente!';
            }
        }

        $data['clientes'] = $cliente;
        echo View('cliente_editar',$data);
    } 

    public function excluir($id)
    {
        $cliente_deletar = new \App\Models\ClienteModel();

        if ($cliente_deletar->delete($id))
        {
            $data['msg'] = 'Cliente deletado com sucesso!';
        }
        else 
        {
            $data['msg'] = 'Erro ao deletar o cliente!';
        }

        $this->index();
    }
}