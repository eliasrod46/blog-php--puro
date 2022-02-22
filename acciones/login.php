<?php
  //conexion a la bbd
  require_once '../includes/conexion.php';

  //Recojer datos del formulario
  if(isset($_POST)){
    //borrar error de sesion antigua
    if(isset($_SESSION['error_login'])){
      unset($_SESSION['error_login']);
    }

    //recojo datos del formularios

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1){
      $usuario = mysqli_fetch_assoc($login);
      
      //comprobar contraseña
      $verify = password_verify($password, $usuario['password']);
      if($verify){
        $_SESSION['usuario'] = $usuario;

        



      }else{
        //si algo falla envar una session con el fallo
        $_SESSION['error_login'] = "Login incorrecto";

      }

    }else{
      //mensaje de error
      $_SESSION['error_login'] = "Login incorrecto";

    }


    
    
  }



  //redirigir  al index
  header("location: ../index.php");



?>