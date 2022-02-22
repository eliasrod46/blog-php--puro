<?php

if(isset($_POST)){
  
  //conexion a la bbd
  require_once 'includes/conexion.php';

  if(!isset($_SESSION)){
    session_start();
  }

  //Recojer los valores del formulario de registro
  //%varaible% = %condicion% ? %caso verdadero% : %else%
  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false; 
  $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false; 
  $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false; 
  $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false; 
  

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

  //validar password
  if(!empty($password)){
    $password_validado = true;
  }else{
    $errores['password'] = "El password esta vacio";
    $password_validado = false;
  }

  //Verificamos si hay errores
  $guardar_usuario = false;
  if(count($errores) == 0){
    $guardar_usuario = true;
    //cifrar contraseña
    $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
    
    //INSERTAR USUARIO EN LA TABAL USUARIOS DE LA BBDD
    $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());"; 
    $guardar = mysqli_query($db, $sql);

    


    if($guardar){
      $_SESSION['completado'] = "El registro se ha completado con exito";
    }else{
      $_SESSION['errores']['general'] = "Fallo al guardar el usuario";

    }

  }else{
    $_SESSION['errores'] = $errores;
  }
  
}
header('location: index.php');



?>