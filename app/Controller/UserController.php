<?php
require_once("app/model/UserModel.php");
    class UserController{
        private $vista;
        private $modelo;

        public function Index(){
            //en el index vamos a mostrar una tabla con todos los usuarios
            $vista="app/View/admin/users/IndexUserView.php";

            $modelo=new UserModel();
            $datos=$modelo->getAll();

            include_once("app/View/admin/PlantillaAdminView.php");
        }
    }
?>