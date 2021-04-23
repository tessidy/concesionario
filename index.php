<?php require_once "ficheros/compartidos/clases.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include_once "ficheros/compartidos/encabezado.php";?>
    <h2>Listado de Vehículos a la venta</h2>
    <form method="POST" action="formulario.php">
        <input type="submit" name="nuevo" value="Nuevo Vehículo">  
    </form>
    <div class="contenedor">
            <div class="elemento">Imagen</div>
            <div class="elemento">Id</div>
            <div class="elemento">Marca</div>
            <div class="elemento">Año</div>
            <div class="elemento">Kilometraje</div>
            <div class="elemento">Combustible</div>
            <div class="elemento">Precio</div>
            <div class="elemento">Métodos</div>
    <?php
        $listado = new ficheroJson('ficheros/coches.json','coches');
        if (isset($_POST["aceptarEliminar"])) {
            $listado->borraRegistro('./ficheros/coches.json','coches',$_POST["id"],$_POST["imagen"]); 
            header('Location: index.php');
        }
        foreach ($listado->lista as $coche) {
            $objeto = (object)($coche);?>
            <div class="elemento">
                <?php if(isset($objeto->fichero)) {?>
                    <img class="imagen" src="<?php echo 'ficheros/imagenes/'.$objeto->fichero?>" >
                <?php }; ?>
            </div>
            <div class="elemento"><?= $objeto->id ?></div>
            <div class="elemento"><?= $objeto->marca ?></div>
            <div class="elemento"><?= $objeto->año ?></div>
            <div class="elemento"><?= $objeto->kilometraje ?></div>
            <div class="elemento"><?= $objeto->combustible ?></div>
            <div class="elemento"><?= $objeto->precio ?></div>
            <div class="elemento">
                <form method="POST" action="formulario.php">
                    <input type="hidden" name="fichero" value="<?php echo $objeto->fichero ?>">
                    <input type="hidden" name="id" value="<?php echo $objeto->id ?>">    
                    <input type="hidden" name="marca" value="<?php echo $objeto->marca ?>">
                    <input type="hidden" name="año" value="<?php echo $objeto->año ?>">
                    <input type="hidden" name="kilometraje" value="<?php echo $objeto->kilometraje ?>">
                    <input type="hidden" name="combustible" value="<?php echo $objeto->combustible ?>">
                    <input type="hidden" name="precio" value="<?php echo $objeto->precio ?>">
                    <input type="submit" name="actualizar" value="Actualizar">
                    <button type="button" name="eliminar" id="eliminar" onclick="botonEliminar('<?php echo $objeto->id ?>','<?php echo $objeto->marca ?>','<?php echo $objeto->fichero ?>')">Eliminar</button>
                </form>
            </div>   
            <?php }  ?>
            <?php include_once "ficheros/compartidos/ventana.php"?>
    <?php include_once "ficheros/compartidos/pie.php"?>
</body>
</html>

