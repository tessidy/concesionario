<link rel="stylesheet" href="./ficheros/compartidos/ventana.css">
<script defer src="./ficheros/compartidos/ventana.js" ></script>
<div id="miModal" class="modal">
        <div class="flex" id="flex">
            <div class="contenido-modal">
                <div class="modal-header flex">
                    <h2>Atención : Eliminación de Registro</h2>
                    <span class="close" id="close">&times;</span>
                </div>
                <div class="modal-body flex">
                    <p id="textoEliminar"></p>
                </div>
                <form class="modal-footer flex" action="index.php"  method="POST">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="imagen" id="imagen">
                    <input type="submit" name="aceptarEliminar" value="Aceptar">
                    <button id=cancelarEliminar onclick="modal.style.display='none';">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

