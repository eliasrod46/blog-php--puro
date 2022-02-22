<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>


<!-- Caja principal -->

<div id="principal">
  <h1>Todas las Entradas</h1>

  <?php
    $entradas = conseguirEntradas($db);
    if(!empty($entradas)):
     while($entrada = mysqli_fetch_assoc($entradas)):
  ?>
  
  <article class="entradas">
  <a href="entrada.php?id=<?=$entrada['id']?>">
      <h2><?=$entrada['titulo']?></h2>
      <span class="fecha"><?=$entrada['Categoria'].' | '.$entrada['fecha']?></span>
      <p><?=substr($entrada['descripcion'], 0, 200).'...'?></p>
    </a>
  </article>
  


  <?php
      endwhile;
    endif;
  ?>
  

  
  
  
</div><!-- fin pricipal -->
    
  
    

  
<?php require_once 'includes/pie.php'; ?>