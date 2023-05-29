<?php
require_once("templates/header.php");
?>



<!-- Page Content -->
<div class="container p-2">
    <h2>Categorías</h2>

    <!--bootstrap Search bar -->
    <div class="row">
        <div class="col-md-6">
            <input class="form-control" id="txtBusqueda" type="text" placeholder="Buscar">
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-success" id="nuevaCategoriaBtn" data-toggle="modal" data-target="#crearCategoriaModal">Nueva Categoría</button>

        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <h3>Listado de categorías</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="categoriasTableBody">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="crearCategoriaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear categoría</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoriaForm">
                    <input type="hidden" id="categoriaId" name="categoriaId">
                    <div class="form-group">
                        <label for="nbCategoria">Nombre de la categoría:</label>
                        <input type="text" class="form-control" id="nbCategoria" name="nbCategoria" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!--modal delete-->
<div id="


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        cargarCategorias();

        $('#nuevaCategoriaBtn').on('click', function() {
            limpiarFormulario();
            $('#crearCategoriaModal').modal('show');
        });
    });

    function limpiarFormulario() {
        $('#categoriaId').val('');
        $('#nbCategoria').val('');
    }

    //funcion para obtener los datos de la categoria seleccionada
    function EditarCategoria(idCategoria) {

        var data = {
            idCategoria: idCategoria
        };
        

        $.ajax({
            url: '../Api/v1/categorias.php?action=getById',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                console.log(response);

                var categoria = response.data[0];

                $('#categoriaId').val(categoria.idCategoria);
                $('#nbCategoria').val(categoria.nbCategoria);

                //show modal
                $('#crearCategoriaModal').modal('show');
            }
        });
    }

    //funcion para obtener las categorias del API
    function cargarCategorias() {
        $.ajax({
            url: '../Api/v1/categorias.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);

                var categorias = response.data;
                var idEstatus = response.idEstatus;
                var mensaje = response.mensaje;

                //obtener el tbody de la tabla
                var categoriasTableBody = $('#categoriasTableBody');
                
                //limpiar el contenido del tbody
                categoriasTableBody.empty();

                //recorrer el arreglo de categorias y crear la tabla con los datos de las categorias obtenidas del API
                $.each(categorias, function(index, categoria) {
                    //editar llamar la funcion EditarCategoria
                    var actionDeleteIcon = '<a href="javascript:EditarCategoria(' + categoria.idCategoria + ')"><i class="fas fa-trash-alt"></i></a>';
                    var actionEditIcon = '<a href="javascript:EditarCategoria(' + categoria.idCategoria + ')"><i class="fas fa-edit"></i></a>';
                    var fila = '<tr>' +
                        '<td>' + categoria.idCategoria + '</td>' +
                        '<td>' + categoria.nbCategoria + '</td>' +
                        "<td style='width: 10%;'>" +
                        actionEditIcon +
                        '</td>' +
                        "<td style='width: 10%;'>" +
                        actionDeleteIcon +
                        '</td>' +
                        '</tr>';

                    categoriasTableBody.append(fila);
                });
            }
        });
    }
</script>

<?php
require_once("templates/footer.php");
?>