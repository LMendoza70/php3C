<?php
    class UserModel{
        //creamos un atributo para manipular los datos en la bd
        private $UserConnection;

        //definimos el contructor de la clase usermodel
        public function __construct(){
            //requiero la clase dbconnection 
            require_once('app/config/DBConnection.php');
            //instranciamos userconnection con dbconnection 
            $this->UserConnection=new DBConnection();
        }

        //a partir de esto vienen los metodos logicos de la app

        //metodo para obtener todos los usuarios
        public function getAll(){
            //paso 1 creo la consulta
            $sql="SELECT * FROM user";
            //paso 2 llamo a la conneccion 
            $connection =$this->UserConnection->getconnection();
            //paso 3 ejecuto la consulta
            $result=$connection->query($sql);
            //paso 4 verifico y acomodo datos 
            //paso 4.1 creo un arreglo para almacenar los usuarios de la bd 
            $users=array();
            //tengo que recorrer $result para ir extrayendo los renglones (registros de usuarios)
            //ocupare un while y la instruccion fetch_assoc
            while($user=$result->fetch_assoc()){
                $users[]=$user;
            }
            //paso 5 cierro la coneccion 
            $this->UserConnection->closeConecction();
            //paso 6 arrojo resultados
            return $users;
        }

        //getById metodo que extrae un usuario por su id
        public function getById($id){
            //creamos consulta
            $sql="SELECT * FROM user WHERE IdUser='".$id."'";
            //obtenemos la coneccion 
            $connection=$this->UserConnection->getConnection();
            //ejecutamos la consulta
            $reslt=$connection->query($sql);
            //verificamos que traiga datos y los sacamos a una variable
            if($reslt && $reslt->num_rows > 0){
                $user=$reslt->fetch_assoc();
            }else{
                $user=false;
            }
            //cerramos la coneccion
            $this->UserConnection->closeConecction();
            //arrojamos resultados
            return $user;
        }

        //metodo para verificar credenciales de logeo
        public function getCredentials($us,$ps){
            //paso 1 creamos la consulta
            $sql="SELECT * FROM user WHERE Usuario = '".$us."' AND Password = '".$ps."'";
            //paso 2 obtenemos la coneccion
            $connection =$this->UserConnection->getconnection();
            //paso 3 ejecutamos la consulta
            $result=$connection->query($sql);
            //paso 4 verificamos que existan resultados
            if($result && $result->num_rows >0){
                $user=$result->fetch_assoc();                
            }else{
                $user=false;
            }
            //paso 5 cerramos la coneccion
            $this->UserConnection->closeConecction();
            //paso 6 arrojamos el resultado
            return $user;
        }

        //metodo para insertar usuarios
        public function insert($user){
            //paso1 creamos la consulta
            $sql="INSERT INTO user(Nombre, ApPaterno, ApMaterno, Usuario, Password, Sexo, FchNacimiento,Avatar) 
            VALUES('".$user['Nombre']."','".$user['ApPaterno']."','".$user['ApMaterno']."',
            '".$user['Usuario']."','".$user['Password']."','".$user['Sexo']."','".$user['FchNacimiento']."','".$user['Avatar']."')";
            //paso 2 conectamos a la base de datos
            $connection =$this->UserConnection->getConnection();
            //paso 3 ejecutamos la consulta
            $reslt = $connection->query($sql);
            //paso 4 preparamos la respuesta
            if($reslt){
                $res=true;
            }else{
                $res=false;
            }
            //paso 5 cerramos la coneccion
            $this->UserConnection->closeConecction();
            //paso 6 arrojamos resultados
            return $res;
        }

        //metodo para editar usuarios
        public function update($user){
            //paso1 creamos la consulta
            $sql="UPDATE user SET Avatar='".$user['Avatar']."',Nombre='".$user['Nombre']."', ApPaterno='".$user['ApPaterno']."', 
            ApMaterno='".$user['ApMaterno']."', Usuario='".$user['Usuario']."', Password='".$user['Password']."', 
            Sexo='".$user['Sexo']."', FchNacimiento='".$user['FchNacimiento']."' WHERE IdUser=".$user['IdUser'];
            //paso 2 conectamos a la base de datos
            $connection =$this->UserConnection->getconnection();
            //paso 3 ejecutamos la consulta
            $reslt = $connection->query($sql);
            //paso 4 preparamos la respuesta
            if($reslt){
                $res=true;
            }else{
                $res=false;
            }
            //paso 5 cerramos la coneccion
            $this->UserConnection->closeConecction();
            //paso 6 arrojamos resultados
            return $res;
        }

        //metodo para eliminar usuarios
        //metodo para eliminar un usuario por su ID
        public function delete($id){
            //paso1 creamos la consulta
            $sql="DELETE FROM user WHERE IdUser=$id";
            //paso 2 conectamos a la base de datos
            $connection =$this->UserConnection->getConnection();
            //paso 3 ejecutamos la consulta
            $reslt = $connection->query($sql);
            //paso 4 preparamos la respuesta
            if($reslt){
                $res=true;
            }else{
                $res=false;
            }
            //paso 5 cerramos la coneccion
            $this->UserConnection->closeConecction();
            //paso 6 arrojamos resultados
            return $res;
        }
            


    }
?>