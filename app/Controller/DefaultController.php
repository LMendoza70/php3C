<?php
//definimos la clase controlador por default que se invoca al inicio de la app
    class DefaultController{
        //el controlador tiene un atributo llmado vista 
        private $vista;
        
        // definimos el metodo index de nuestro controlador 
        public function index(){
            //inicializamos a vista con lo que vamos a mostrar en la plantilla 
            $vista="app/View/admin/IndexAdminView.php";
            //incluimos a la plantilla 
            //iniciamos la sesion
            session_start();
            //preguntamos si esta logueado
            if(isset($_SESSION['logedin']) && $_SESSION['logedin']==true){
                include_once("app/View/admin/PlantillaAdminView.php");
            }else{
                include_once("app/View/admin/Plantilla2AdminView.php");
            }
            
        }

    }
