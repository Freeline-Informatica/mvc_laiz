<?php
class loginController extends Controller{

    public function index(){
        $data = array(
            'msg' => ''
        );

        if(!empty($_POST['number'])){
            $unumber = $_POST['number'];
            $upass = $_POST['password'];

            $users = new Users();

            if($users->verifyUser($unumber, $upass)){
                $token = $users->createToken($unumber);
                $_SESSION['token'] = $token;
            } else {
                $data['msg'] = 'Número e/ou senha errados!';
            }
        }

        $this ->loadView('login', $data);
    }

}