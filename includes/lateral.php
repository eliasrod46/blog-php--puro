<!-- BARRA LATERAL -->
<aside id="sidebar">

        <div id="buscador" class="bloque">  
          <h3>Buscar</h3>

          <form action="buscar.php" method="POST">
            <input type="text" name="busqueda">
            <input type="submit" value="Buscar">
          </form>
        </div>


      <?php if(isset($_SESSION['usuario'])) :?>
        <div id="usuario-logueado" class="bloque">
          <h3><?='Bienvenido: '.$_SESSION['usuario']['nombre'].' '. $_SESSION['usuario']['apellidos']?></h3>
          <!-- botones -->
          <a class="boton boton-verde" href="crear-entrada.php">Crear entradas</a>
          <a class="boton" href="crear-categoria.php">Crear categoria</a>
          <a class="boton boton-naranja" href="mis-datos.php">Mis datos</a>
          <a class="boton boton-rojo" href="acciones/cerrar.php">Cerrar Sesion</a>
        </div>
      <?php endif;?>
      
      

      <?php if(!isset($_SESSION['usuario'])) :?>
      
        <div id="login" class="bloque">
          <h3>Identificate</h3>

          <?php if(isset($_SESSION['error_login'])) :?>
            <div class="alerta alerta-error">
              <h3><?=$_SESSION['error_login'];?></h3>
            </div>
          <?php endif;?>
          <form action="acciones/login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email">
            
            <label for="password">Password</label>
            <input type="password" name="password">
            <input type="submit" value="Entrar">
          </form>
        </div>

        <div id="Register" class="bloque">
          
          <h3>Registrarse</h3>

          <!-- Mostrar errores -->
          <?php if(isset($_SESSION['completado'])): ?>
            
            <div class="alerta alerta-exito"><?=$_SESSION['completado']?></div>

            <?php elseif(isset($_SESSION['errores']['general'])):?>
            <div class="alerta alerta-error"><?=$_SESSION['errores']['general']?></div>
            
          
          <?php endif;?>

          <form action="acciones/registro.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''?>

            <label for="Apellidos">Apellidos</label>
            <input type="text" name="apellidos">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''?>          
            
            <label for="email">Email</label>
            <input type="email" name="email">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''?>          
            
                      
            <label for="password">Password</label>
            <input type="password" name="password">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''?>          
            
            
            <input type="submit" name="submit" value="Registrarse">
          </form>
          <?php borrarErrores(); ?>

        </div>
      <?php endif;?>

    </aside>