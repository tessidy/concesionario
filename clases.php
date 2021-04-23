<?php
class ficheroJson {
    public $lista;

    public function __construct( $nombre,$objeto)
    {
        $this->lista = json_decode(file_get_contents($nombre),true)[$objeto];
    }

    public function nuevoCoche() {
        return max(array_map("compara",$this->lista))+1;
    }
    public function grabaFichero($fichero,$elemento,$coche) {
        if (gettype(array_search($coche->id, array_column($this->lista, 'id'))) != "boolean"){
            $this->lista[array_search($coche->id, array_column($this->lista, 'id'))] = $coche;
        } else{
            array_push($this->lista,$coche);
        }
        $salida = '{"'.$elemento.'":'.json_encode($this->lista,JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT).'}';
        file_put_contents($fichero,$salida);
        move_uploaded_file($_FILES['imagen_fichero']['tmp_name'],"./ficheros/imagenes/".$coche->fichero);
    }
    public function borraRegistro($fichero,$elemento,$id,$imagen) {
        $respuesta = array_search($id, array_column($this->lista, 'id')); 
        if (gettype($respuesta) != "boolean"){
            array_splice($this->lista,$respuesta,1);
        }
        $salida = '{"'.$elemento.'":'.json_encode($this->lista,JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT).'}';
        file_put_contents($fichero,$salida);
        if ($imagen != "notiene.jpg") {
            unlink("./ficheros/imagenes/".$imagen);
        }
    }

}
class COCHE {
    public $id;
    public $marca;
    public $año;
    public $kilometraje;
    public $combustible;
    public $precio;
    public $fichero;

    //Constructor
    public function __construct($id=null,$marca=null,$año=null,$kilometraje=null,$combustible=null,$precio=null,$fichero=null)
    {
        $this->id = $id;
        $this->marca = $marca;
        $this->año = $año;
        $this->kilometraje = $kilometraje;
        $this->combustible = $combustible;
        $this->precio = $precio;
        $this->fichero = $fichero;
    }
}

function compara($dato){
    return $dato["id"];
} 
?>