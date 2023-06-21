<?php
class loginController{
    private userInstance;

    //creamos nuestro constructor
    public function __construct(){
        require_once("../Model/UserModel.php");
        $this->userInstance=new UserModel();
    }

    public function index(){
        //verificamos que se esta llamndo desde post
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $user=$_POST['user'];
            $pass=$_POST['password'];
            $respuesta= $this->userInstance->getCredencials($user,$pass);
            if(!$respuesta){
                //hago algo
            }else{
                //hago algo
            }
        }
    }

}
?>