<?php
require_once("app/model/UserModel.php");
class UserController
{
    private $vista;
    private $modelo;

    public function Index()
    {
        //en el index vamos a mostrar una tabla con todos los usuarios


        $modelo = new UserModel();
        $datos = $modelo->getAll();
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            $vista = "app/View/admin/users/IndexUserView.php";
            include_once("app/View/admin/PlantillaAdminView.php");
        } else {
            $vista = "app/View/admin/IndexAdminView.php";
            include_once("app/View/admin/Plantilla2AdminView.php");
        }
    }

    //creamos el metodo para llamar a la vista de agregar usuario
    public function CallFormAdd()
    {
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            $vista = "app/View/admin/users/AddUserView.php";
            include_once("app/View/admin/PlantillaAdminView.php");
        } else {
            $vista = "app/View/admin/IndexAdminView.php";
            include_once("app/View/admin/Plantilla2AdminView.php");
        }
    }

    public function CallFormLogin()
    {
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            $vista = "app/View/admin/LoginView.php";
            include_once("app/View/admin/PlantillaAdminView.php");
        } else {
            $vista = "app/View/admin/LoginView.php";
            include_once("app/View/admin/Plantilla2AdminView.php");
        }
    }
    //creamos el metodo para agregar un usuario
    public function Add()
    {
        //verificamos si el metodo de envio de datos es POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //almacenamos los datos enviados por el formulario en un arreglo
            $datos = array(
                'Nombre' => $_POST['nombre'],
                'ApPaterno' => $_POST['apaterno'],
                'ApMaterno' => $_POST['amaterno'],
                'Usuario' => $_POST['user'],
                'Password' => $_POST['password'],
                'Sexo' => $_POST['sexo'],
                'FchNacimiento' => $_POST['fchnac']
            );

            //comenzamos a procesar la imagen 
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                //obtenemos la informacion necesaria del archivo que estamos cargando
                $nombreArchivo = $_FILES['avatar']['name'];
                $tipoArchivo = $_FILES['avatar']['type'];
                $tamanoArchivo = $_FILES['avatar']['size'];
                $rutaTemporal = $_FILES['avatar']['tmp_name'];
                //validamos que tipo de imagen puedo subir
                $extenciones = array('jpg', 'jpeg', 'png');
                $extencion = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if (!in_array($extencion, $extenciones)) {
                    echo "Formato de archivo no valido";
                    exit;
                }
                //validamos el tamaño del archivo a cargar
                $tamanomaximo = 2 * 1024 * 1024;
                if ($tamanoArchivo > $tamanomaximo) {
                    echo "ya mejor sube un video o una lona";
                    exit;
                }
                //generamos el numbre del archivo
                $nombreArchivo = uniqid('Avatar_') . '.' . $extencion;
                $rutaDestino = "app/src/img/avatars/" . $nombreArchivo;
                //copiamos el archivo a nuestro servidor
                if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    echo "Error al cargar el archivo";
                    exit;
                }
                $datos['Avatar'] = $nombreArchivo;
            }

            //llamamos al metodo del modelo que agrega al usuario a la base de datos
            $modelo = new UserModel();
            $res = $modelo->insert($datos);
            //podria poner una consicion en la que si el elemnto fue insertado correctamente
            //llamaria al index de usuarios y si no llamaria al formulario de agregar
            //redireccionamos al index de usuarios
            header("Location:http://localhost/php3c/?C=UserController&M=index");
        }
    }

    //Creamos el metodo para llamar a la vista de editar usuario
    public function CallFormEdit()
    {
        //verificamos que el metodo de envio de datos sea GET
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //obtenemos el id del usuario a editar
            $id = $_GET['id'];
            //llamamos al metodo del modelo que obtiene los datos del usuario a editar
            $modelo = new UserModel();
            $datos = $modelo->getById($id);
            //llamamos a la vista de editar usuario
            session_start();
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                $vista = "app/View/admin/users/EditUserView.php";
                include_once("app/View/admin/PlantillaAdminView.php");
            } else {
                $vista = "app/View/admin/IndexAdminView.php";
                include_once("app/View/admin/Plantilla2AdminView.php");
            }
        }
    }
    //creamos el metodo para editar un usuario
    public function Edit()
    {
        //verificamos que el metodo de envio de datos sea POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //almacenamos los datos enviados por el formulario en un arreglo
            $datos = array(
                'IdUser' => $_POST['id'], //agregamos el id del usuario a editar
                'Nombre' => $_POST['nombre'],
                'ApPaterno' => $_POST['apaterno'],
                'ApMaterno' => $_POST['amaterno'],
                'Usuario' => $_POST['user'],
                'Password' => $_POST['password'],
                'Sexo' => $_POST['sexo'],
                'FchNacimiento' => $_POST['fchnac'],
                'Avatar' => $_POST['ava']
            );

            //comenzamos a procesar la imagen 
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                //obtenemos la informacion necesaria del archivo que estamos cargando
                $nombreArchivo = $_FILES['avatar']['name'];
                $tipoArchivo = $_FILES['avatar']['type'];
                $tamanoArchivo = $_FILES['avatar']['size'];
                $rutaTemporal = $_FILES['avatar']['tmp_name'];
                //validamos que tipo de imagen puedo subir
                $extenciones = array('jpg', 'jpeg', 'png');
                $extencion = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if (!in_array($extencion, $extenciones)) {
                    echo "Formato de archivo no valido";
                    exit;
                }
                //validamos el tamaño del archivo a cargar
                $tamanomaximo = 2 * 1024 * 1024;
                if ($tamanoArchivo > $tamanomaximo) {
                    echo "ya mejor sube un video o una lona";
                    exit;
                }
                //generamos el numbre del archivo
                $nombreArchivo = uniqid('Avatar_') . '.' . $extencion;
                $rutaDestino = "app/src/img/avatars/" . $nombreArchivo;
                //copiamos el archivo a nuestro servidor
                if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    echo "Error al cargar el archivo";
                    exit;
                }
                $this->modelo = new UserModel();
                $anterior = $this->modelo->getById($_POST['id']);
                if (!empty($anterior['Avatar'])) {
                    unlink("app/src/img/avatars/" . $anterior['Avatar']);
                }

                //tengo que ver si se toco o no se toco el input_file
                $datos['Avatar'] = $nombreArchivo;
            } else {
                $datos['Avatar'] = $_POST['ava'];
            }
            //llamamos al metodo del modelo que actualiza los datos del usuario
            $modelo = new UserModel();
            $modelo->update($datos);
            //redireccionamos al index de usuarios
            header("Location:http://localhost/php3c/?C=UserController&M=index");
        }
    }

    //Creamos el metodo para eliminar un usuario de la base de datos, este metodo se llamara una vez que 
    //se haya confirmado la eliminacion del usuario en la vista de index mediante un confirm de javascript
    public function Delete()
    {
        //verificamos que el metodo de envio de datos sea GET
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //obtenemos el id del usuario a eliminar
            $id = $_GET['id'];
            //llamamos al metodo del modelo que elimina al usuario de la base de datos
            //creo un segundo modelo para rescatar el registro con el nombre
            $this->modelo = new UserModel();
            $usuario = $this->modelo->getById($id);
            $modelo = new UserModel();
            $modelo->delete($id);
            //eliminamos el registro
            unlink("app/src/img/avatars/" . $usuario['Avatar']);
            //redireccionamos al index de usuarios
            header("Location:http://localhost/php3c/?C=UserController&M=index");
        }
    }

    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->modelo = new UserModel();
            $usuario = $this->modelo->getCredentials($_POST['user'], $_POST['password']);
            $vista = "app/View/admin/IndexAdminView.php";
            if ($usuario == false) {
                include_once("app/View/admin/Plantilla2AdminView.php");
            } else {
                session_start();
                $_SESSION['logedin'] = true;
                $_SESSION['foto'] = $usuario['Avatar'];
                $_SESSION['nombre'] = $usuario['Nombre'] . ' ' . $usuario['ApPaterno'] . ' ' . $usuario['ApMaterno'];
                include_once("app/View/admin/PlantillaAdminView.php");
            }
        }
    }
}
