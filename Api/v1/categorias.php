<?php
header('Content-Type: application/json');
require_once('../Conect.php');

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            createCategoria($conn);
            break;
        case 'update':
            updateCateroria($conn);
            break;
        case 'delete':
            deleteCategoria($conn);
            break;
        default:
            index($conn);
            break;
    }
}else{
    index($conn);
}

function index($conn){
    try {
        $sql = "SELECT * FROM tbl_categorias";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $categorias = array();
            while($row = mysqli_fetch_assoc($result)){
                $categorias[] = $row;
            }

            echo json_encode(array(
                'idEstatus' => 1,
                'data' => $categorias,
                'mensaje' => 'Operación realiza con éxito'
            ));
        }else{
            echo json_encode(array(
                'idEstatus' => 0,
                'data' => null,
                'mensaje' => 'No se encontraron categorias'
            ));
        }
    } catch (Exception $e) {
        echo json_encode(array(
            'idEstatus' => -1,
            'data' => null,
            'mensaje' => $e->getMessage()
        ));
    }
}
function  createCategoria($conn){
    try {
        //verificar que el json no venga vacio y sea un json valido
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);
    
        if ($obj == null) {
            echo json_encode(array(
                'idEstatus' => -1,
                'data' => null,
                'mensaje' => 'Bad request.'
            ));
            return;
        }

        //obtenemos los atributos del json
        $nbCategoria = $obj['nbCategoria'];

        //prevent sql injection
        $nbCategoria = mysqli_real_escape_string($conn, $nbCategoria);

        $sql = "INSERT INTO tbl_categorias (nbCategoria) VALUES ('".$nbCategoria."')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo json_encode(array(
                'idEstatus' => 1,
                'data' => null,
                'mensaje' => 'Operación realiza con éxito'
            ));
        }else{
            echo json_encode(array(
                'idEstatus' => 0,
                'data' => null,
                'mensaje' => 'No se pudo crear la categoria'
            ));
        }
    } catch (Exception $e) {
        echo json_encode(array(
            'idEstatus' => -1,
            'data' => null,
            'mensaje' => $e->getMessage()
        ));
    }

}

function updateCateroria($conn){
    try{
        //verificar que el json no venga vacio y sea un json valido
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);

        if ($obj == null) {
            echo json_encode(array(
                'idEstatus' => -1,
                'data' => null,
                'mensaje' => 'Bad request.'
            ));
            return;
        }

        //obtenemos los atributos del json
        $idCategoria = $obj['idCategoria'];
        $nbCategoria = $obj['nbCategoria'];

        //prevent sql injection
        $idCategoria = mysqli_real_escape_string($conn, $idCategoria);
        $nbCategoria = mysqli_real_escape_string($conn, $nbCategoria);


        $sql = "UPDATE tbl_categorias SET nbCategoria = '".$nbCategoria."' WHERE idCategoria = '".$idCategoria."'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo json_encode(array(
                'idEstatus' => 1,
                'data' => null,
                'mensaje' => 'Operación realiza con éxito'
            ));
        }else{
            echo json_encode(array(
                'idEstatus' => 0,
                'data' => null,
                'mensaje' => 'No se pudo actualizar la categoria'
            ));
        }
    }catch(Exception $e){
        echo json_encode(array(
            'idEstatus' => -1,
            'data' => null,
            'mensaje' => $e->getMessage()
        ));
    }

}

function deleteCategoria($conn){
    try{
        //verificar que el json no venga vacio y sea un json valido
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);

        if ($obj == null) {
            echo json_encode(array(
                'idEstatus' => -1,
                'data' => null,
                'mensaje' => 'Bad request.'
            ));
            return;
        }

        //obtenemos los atributos del json
        $idCategoria = $obj['idCategoria'];

        //prevent sql injection
        $idCategoria = mysqli_real_escape_string($conn, $idCategoria);

        $sql = "DELETE FROM tbl_categorias WHERE idCategoria = '".$idCategoria."'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo json_encode(array(
                'idEstatus' => 1,
                'data' => null,
                'mensaje' => 'Operación realiza con éxito'
            ));
        }else{
            echo json_encode(array(
                'idEstatus' => 0,
                'data' => null,
                'mensaje' => 'No se pudo eliminar la categoria'
            ));
        }
    }catch(Exception $e){
        echo json_encode(array(
            'idEstatus' => -1,
            'data' => null,
            'mensaje' => $e->getMessage()
        ));
    }

}

?>