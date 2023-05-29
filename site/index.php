<?php
require_once("templates/header.php");
?>



<!-- Page Content -->
<div class="container">
    <h2>CRUD de Categorías</h2>
    <div class="row">
        <div class="col-md-6">
            <form id="categoriaForm">
                <input type="hidden" id="categoriaId" name="categoriaId">
                <div class="form-group">
                    <label for="nbCategoria">Nombre de la categoría:</label>
                    <input type="text" class="form-control" id="nbCategoria" name="nbCategoria" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3" id="guardarBtn">Guardar</button>
                <button type="button" class="btn btn-default" id="limpiarBtn">Limpiar</button>
                <button type="button" class="btn btn-success" id="nuevaCategoriaBtn" data-toggle="modal" data-target="#crearCategoriaModal">Nueva Categoría</button>

            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <h3>Listado de categorías</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crear categoría</h4>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>


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

    function cargarCategorias() {
        $.ajax({
            url: '../Api/v1/categorias.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var categorias = response.data;
                var categoriasTableBody = $('#categoriasTableBody');

                categoriasTableBody.empty();

                $.each(categorias, function(index, categoria) {
                    var fila = '<tr>' +
                        '<td>' + categoria.idCategoria + '</td>' +
                        '<td>' + categoria.nbCategoria + '</td>' +
                        '<td>' +
                        '<button type="button" class="btn btn-primary editarBtn" data-id="' + categoria.idCategoria + '" data-nombre="' + categoria.nbCategoria + '">Editar</button> ' +
                        '<button type="button" class="btn btn-danger eliminarBtn" data-id="' + categoria.idCategoria + '">Eliminar</button>' +
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