let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let cerrar = document.getElementById('close');

cerrar.addEventListener('click', function(){
    modal.style.display='none';
});

window.addEventListener('click', function(e){
    if(e.target == flex){
        modal.style.display='none';
    }
});

window.addEventListener('load', function(){
    modal.style.display='none';
});


function botonEliminar(id,marca,imagen) {
    modal.style.display='block';
    document.getElementById('id').value = id;
    document.getElementById('imagen').value = imagen;
    document.getElementById('textoEliminar').innerHTML = "Esta seguro que quiere eliminar el Coche ID:"+id+" "+marca;
}