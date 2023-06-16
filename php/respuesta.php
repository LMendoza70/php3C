<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta ....</title>
</head>
<body>
    <?php
    //definimos variables
        $us="luis";
        $ps="1111";
        $respuesta="";
    //rescatamos valores del formulario
        $usuario=$_POST['user'];
        $contrasenia=$_POST['password'];
    //verficaamos que las credenciales coincidan
        if($us==$usuario && $ps==$contrasenia){
            $respuesta="Correcto";
        }else{
            $respuesta="Incorrecto";
        }
    ?>

    <h1>Respuesta...</h1>
    <h2>Hola : <?php echo($usuario) ?> </h2>
    <h2>Tu logueo fue : <?= $respuesta ?> </h2>
</body>
</html>