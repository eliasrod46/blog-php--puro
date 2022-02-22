<?php

if(isset($_POST)){
  
  //conexion a la bbd
  require_once '../includes/conexion.php';

  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']): false;

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

  if(count($errores) == 0){
    $sql = "INSERT INTO categorias VALUES(NULL, '$nombre');";
    $guardar = mysqli_query($db, $sql);
  }


}

header("Location: ../index.php");

  



?>