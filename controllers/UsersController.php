<?php

namespace Controllers;

use Models\User;

class UsersController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(): void
    {
        $users = $this->user->get();
        $title = 'Usuários';
        $view_path = '/users/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function create()
    {
        $validation = $this->validate($_POST);

        if(isset($validation['error']) && $validation['error']){
            echo json_encode($validation);
            return;
        }

        $request = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
        ];

        $new_user = $this->user->insert($request);

        $response = [
            'success' => true,
            'user' => $new_user,
            'message' => 'Usuário adicionado com sucesso!',
            'model' => 'users',
        ];

        echo json_encode($response);
        return;
    }

    public function update($id)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT'){
            $validation = $this->validate($_POST);

            if(isset($validation['error']) && $validation['error']){
                echo json_encode($validation);
                return;
            }

            $request = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
            ];
    
            $update_user = $this->user->update($request, $id);
    
            $response = [
                'success' => true,
                'user' => $update_user,
                'message' => 'Usuário atualizado com sucesso!',
                'model' => 'users',
            ];
        }else{
            $response = [
                'error' => true,
                'message' => 'Metodo não permitido!',
            ];
        }

        echo json_encode($response);
        return;
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
            try {
                $this->user->delete($id);

                $response = [
                    'success' => true,
                    'message' => 'Usuário removido com sucesso!',
                    'model' => 'users',
                ];
                
            } catch (\Throwable $th) {
                $response = [
                    'error' => true,
                    'message' => 'Erro ao excluir usuário: '. $th->getMessage(),
                ];
            }
        }else{
            $response = [
                'error' => true,
                'message' => 'Metodo não permitido!',
            ];
        }

        echo json_encode($response);
        return;
    }

    public function ajax()
    {
        $users = $this->user->get();

        echo json_encode($users);
        return;
    }

    public function validate($request)
    {
        if(empty($request['name']) || empty($request['email'])){
            $message = empty($request['name']) ? 'O campo Nome é obrigatório! <br>' : '';
            $message .= empty($request['email']) ? 'O campo Email é obrigatório!' : '';

            $response = [
                'error' => true,
                'message' => $message,
            ];

            return $response;
        }

        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.?([a-zA-Z]{1,})?$/", $request['email'])) {
            $response = [
                'error' => true,
                'message' => 'Endereço de Email precisa ser válido!',
            ];

            return $response;
        }

        return true;
    }
}