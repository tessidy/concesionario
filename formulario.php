<?php ob_start()?>
<?php require_once "ficheros/compartidos/clases.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulario.css">
    <title>Document</title>
</head>
<body>
<?php
    $listado = new ficheroJson('./ficheros/coches.json','coches');
    $coche = new COCHE();
    foreach ($_POST as $clave => $valor ) {
        if (array_key_exists($clave, get_object_vars($coche))) {
            if (is_numeric($valor)) {
                $coche->$clave = intval($valor);
            } else{
                $coche->$clave = $valor;
            }
        }
    }
    if (isset($_POST["aceptar"])) {
        $listado->grabaFichero('./ficheros/coches.json','coches',$coche); 
        header('Location: index.php');

    }

?>

<?php include_once "ficheros/compartidos/encabezado.php"?>
<form id= "formulario" name="formulario" method="POST" 
enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div id="cuerpo">
    <div id="datos">
           
            <?php 
                if (isset($_POST["nuevo"])) {
                    $coche->id = $listado->nuevoCoche();
                    $coche->fichero = "notiene.jpg";
                }
            ?>
            <input type="hidden" name="id" value="<?php echo $coche->id ?>">
            
            <div id="cocheId">
                <label for="id">Identificador</label>
                <input type="text" value="<?php 
                echo $coche->id ?>" disabled>
            </div>
            <div id="cochemarca">
                <label for="marca">Marca</label>
                <input type="text" name="marca" value="<?php echo $coche->marca; ?>">
            </div>
            <div id="cocheAño">
                <label for="año">Año</label>
                <input type="text" name="año" value="<?php echo $coche->año; ?>">
            </div>
            <div id="cocheKilometraje">
                <label for="kilometraje">Kilometraje</label>
                <input type="number" name="kilometraje" value="<?php echo $coche->kilometraje; ?>">
            </div>
            <div id="cocheCombustible">
                <label for="combustible">Combustible</label>
                <input type="text" name="combustible"  value="<?php echo $coche->combustible ?>">            
            </div>
            <div id="cochePrecio">
                <label for="precio">Precio</label>
                <input type="number" name="precio" value="<?php echo $coche->precio ?>">            
            
            </div>    
            <input type="hidden" id="fichero" name="fichero" value="<?php echo $coche->fichero ?>">
            <div id="botones">
                <input type="submit" name="aceptar" value="Aceptar">
                <input type="reset" name="cancelar" value="Cancelar">
            </div>
            
    </div>
    <div id="seccionFoto">
        <div class="marco">
            <img id="foto" src="<?php echo 'ficheros/imagenes/'.$coche->fichero; ?>" alt="Foto del Coche">
        </div>   
        <label class="ficheroFoto">
            <input type="file"  id="imagen_fichero" name="imagen_fichero" accept="image/png , image/jpeg" onchange="cargafoto()">
            Seleccione Foto
            </label> 
        <label id="nombre_foto"><?php echo $coche->fichero;?></label>
        <script>
            function cargafoto(){
                document.getElementById('foto').src = 
                window.URL.createObjectURL(document.getElementById("imagen_fichero").files[0]);
                document.getElementById('fichero').value = 
                document.getElementById('nombre_foto').innerHTML = 
                document.getElementById("imagen_fichero").files[0].name;
            }
        </script>            
    </div>
</div>
</form>
<?php include_once "ficheros/compartidos/pie.php"?>
</body>
</html>
<?php ob_end_flush();?>