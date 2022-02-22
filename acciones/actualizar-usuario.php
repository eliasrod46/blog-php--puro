<?php

if(isset($_POST)){
  
  //conexion a la bbd
  require_once '../includes/conexion.php';

 

  //Recojer los valores del formulario de actualizacion
  //%varaible% = %condicion% ? %caso verdadero% : %else%
  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false; 
  $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false; 
  $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false; 
  
  //array de errores
  $errores = array();


  //validar los datos antes de guardarlos en la bbdd

  //validar nombre
  if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
    $nombre_validado = true;
  }else{
    $errores['nombre'] = "El nombre no es valido";
    $nombre_validado = false;
  }

  //validar apellidos
  if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
    $apellidos_validado = true;
  }else{
    $errores['apellidos'] = "Los apellidos no son validos";
    $apellidos_validado = false;
  }

  //validar email
  if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
    $email_validado = true;
  }else{
    $errores['email'] = "El email no es valido";
    $email_validado = false;
  }

  
  //Verificamos si hay errores
  $guardar_usuario = false;
  if(count($errores) == 0){
    $usuario = $_SESSION['usuario'];
    $guardar_usuario = true;

    //Comprobar que no existe el mail en la bbdd
    $sql = "SELECT id, email FROM usuarios WHERE email = '$email';";
    $isset_email = mysqli_query($db, $sql);
    $isset_user = mysqli_fetch_assoc($isset_email);

    if($isset_user['id'] == $usuario['id'] || empty($isset_user)){

      //ACTUALIZAR EL USUARIO EN LA TABAL USUARIOS DE LA BBDD
      

      $sql = "UPDATE usuarios SET ".
      "nombre = '$nombre', ".
      "apellidos = '$apellidos', ".
      "email = '$email' ".
      "WHERE id = ".$usuario['id'];

      $guardar = mysqli_query($db, $sql);

      if($guardar){
        $_SESSION['usuario']['nombre'] = $nombre;
        $_SESSION['usuario']['apellidos'] = $apellidos;
        $_SESSION['usuario']['email'] = $email;
        $_SESSION['completado'] = "Tus datos se han actualizado con exito";
      }else{
        $_SESSION['errores']['general'] = "Fallo al guardar el actualizar tus datos";

      }

    }else{
      $_SESSION['errores']['general'] = "El usuario ya existe";

    }

  }else{
    $_SESSION['errores'] = $errores;
  }
  
}
header('location: ../mis-datos.php');



?>
