<?php
if (isset($_GET["links"])){
	 $links=$_GET["links"];
}else{
	$links=0;
}
?>
<nav class="navbar navbar-default" style="border-color:#337ab7">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
	  <img class="navbar-brand" src="./img/logo.ico" />
	</div>
	<div class="collapse navbar-collapse" id="myNavbar">
	<ul class="nav navbar-nav">
		<li <?php if($_SESSION['menu']==1){echo 'class="active"';} ?>><a href="panel-control.php">Inicio</a></li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" <?php if($_SESSION['menu']==2){echo 'class="active"';} ?>>Pacientes<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="form_listado_pacientes.php">Listado</a></li>
				<?php
				if ($links==1){
				?>
				<li><a href="form_muestra_datos_historia.php?<?=encryptLink('links=1&id_paciente='.$id_paciente.'&check=1'); ?>">Historia clinica</a></li>
				<li><a href="form_muestra_indicaciones.php?<?=encryptLink('links=1&id_paciente='.$id_paciente.'&check=1'); ?>">Indicaciones médicas</a></li>
				<li><a href="form_muestra_datos_nutricion.php?<?=encryptLink('links=1&id_paciente='.$id_paciente.'&check=1'); ?>">Nutrición</a></li>
				<?php
				}
				if ($_SESSION['tipousuario']==1 || $_SESSION['tipousuario']==3 ){
				?>
				<li><a href="form_nuevo_paciente.php">Nuevo</a></li>
				<?
				}
				?>
			</ul>
		</li>
		<?php
		if ($_SESSION['tipousuario']==1 || $_SESSION['tipousuario']==3){
		?>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" <?php if($_SESSION['menu']==3){echo 'class="active"';} ?>>Usuarios<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="form_listado_usuarios.php">Listado</a></li>
				<li><a href="form_nuevo_usuario.php">Nuevo</a></li>
			</ul>
		</li>
		<?
		}
		?>
		
    </ul>
	<ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?= " ".$_SESSION['nombre']; ?><span class="caret"></span></a>
		  <?
		  if ($_SESSION['tipousuario']==1 || $_SESSION['tipousuario']==3){
		  ?>
		  <ul class="dropdown-menu">
			  <li><a href="form_carga_datos_usuario.php?id=<?= $_SESSION['id']; ?>">Actualizar datos</a></li>
		  </ul>
		  <?
		  }
		  ?>
	  </li>
      <li><a href=logout.php><button type="button" class="btn btn-danger btn-xs">Cerrar sesión</button></a></li>
    </ul>
	</div>
  </div>
</nav>
