<?php
header('Content-Type: application/json');
require_once('../Conect.php');

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'lugares':
            getLugares($conn);
            break;
        case 'create':
            createLugar($conn);
            break;
        case 'update':
            updateLugar($conn);
            break;
        case 'delete':
            deleteLugar($conn);
            break;
        case 'categoria':
            getByCategoria($conn);
            break;
        default:
            getLugares($conn);
            break;
    }
}else{
    getLugares($conn);
}

function getLugares($conn){
    try {
        $sql = "SELECT * FROM tbl_lugares";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $lugares = array();
            while($row = mysqli_fetch_assoc($result)){
                $lugares[] = $row;

                //buscar fotos de productos
                $sqlFotos = 'SELECT * FROM tbl_fotoslugares WHERE idLugar = '.$row['idLugar'];
                $resultFotos = mysqli_query($conn, $sqlFotos);
                if(mysqli_num_rows($resultFotos) > 0){
                    $fotos = array();
                    while($rowFotos = mysqli_fetch_assoc($resultFotos)){
                        $fotos[] = $rowFotos;
                    }
                    $lugares[count($lugares)-1]['fotos'] = $fotos;
                }else{
                    $lugares[count($lugares)-1]['fotos'] = null;
                }


            }

            echo json_encode(array(
                'idEstatus' => 1,
                'data' => $lugares,
                'mensaje' => 'Operación realiza con éxito'
            ));
        }else{
            echo json_encode(array(
                'idEstatus' => 0,
                'data' => null,
                'mensaje' => 'No se encontraron elementos'
            ));
        }
    } catch (Exception $e) {
        echo json_encode(array(
            'idEstatus' => -1,
            'mensaje' => $e->getMessage(),
            'data' => null
        ));
    }
    mysqli_close($conn);
}

/*
idLugar
nbLugar
nbLugarIngles
nbLugarMaya
nbCientifico
tRecorrido
desLugar
idCategoria
*/

function createLugar($conn){
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
        //$idLugar = $obj['idLugar'];
        $nbLugar = $obj['nbLugar'];
        $nbLugarIngles = $obj['nbLugarIngles'];
        $nbLugarMaya = $obj['nbLugarMaya'];
        $nbCientifico = $obj['nbCientifico'];
        $tRecorrido = $obj['tRecorrido'];
        $desLugar = $obj['desLugar'];
        $idCategoria = $obj['idCategoria'];

        //prevent sql injection
        $nbLugar = mysqli_real_escape_string($conn, $nbLugar);
        $nbLugarIngles = mysqli_real_escape_string($conn, $nbLugarIngles);
        $nbLugarMaya = mysqli_real_escape_string($conn, $nbLugarMaya);
        $nbCientifico = mysqli_real_escape_string($conn, $nbCientifico);
        $tRecorrido = mysqli_real_escape_string($conn, $tRecorrido);
        $desLugar = mysqli_real_escape_string($conn, $desLugar);
        $idCategoria = mysqli_real_escape_string($conn, $idCategoria);


        //crear sql para insertar
        $sql = "INSERT INTO tbl_lugares (nbLugar, nbLugarIngles, nbLugarMaya, nbCientifico, tRecorrido, desLugar, idCategoria) VALUES ('$nbLugar', '$nbLugarIngles', '$nbLugarMaya', '$nbCientifico', '$tRecorrido', '$desLugar', '$idCategoria')";

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
                'mensaje' => 'No fue posible realizar la operación'
            ));
        }
    } catch (Exception $e) {
        echo json_encode(array(
            'idEstatus' => -1,
            'mensaje' => $e->getMessage(),
            'data' => null
        ));
    }
    mysqli_close($conn);
}

function updateLugar($conn){
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
        $idLugar = $obj['idLugar'];
        $nbLugar = $obj['nbLugar'];
        $nbLugarIngles = $obj['nbLugarIngles'];
        $nbLugarMaya = $obj['nbLugarMaya'];
        $nbCientifico = $obj['nbCientifico'];
        $tRecorrido = $obj['tRecorrido'];
        $desLugar = $obj['desLugar'];
        $idCategoria = $obj['idCategoria'];

        //prevent sql injection
        $idLugar = mysqli_real_escape_string($conn, $idLugar);
        $nbLugar = mysqli_real_escape_string($conn, $nbLugar);
        $nbLugarIngles = mysqli_real_escape_string($conn, $nbLugarIngles);
        $nbLugarMaya = mysqli_real_escape_string($conn, $nbLugarMaya);
        $nbCientifico = mysqli_real_escape_string($conn, $nbCientifico);
        $tRecorrido = mysqli_real_escape_string($conn, $tRecorrido);
        $desLugar = mysqli_real_escape_string($conn, $desLugar);
        $idCategoria = mysqli_real_escape_string($conn, $idCategoria);


        //crear sql para insertar
        $sql = "UPDATE tbl_lugares SET nbLugar = '$nbLugar', nbLugarIngles = '$nbLugarIngles', nbLugarMaya = '$nbLugarMaya', nbCientifico = '$nbCientifico', tRecorrido = '$tRecorrido', desLugar = '$desLugar', idCategoria = '$idCategoria' WHERE idLugar = '$idLugar'";

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
                'mensaje' => 'No fue posible realizar la operación'
            ));
        }
    } catch (Exception $e) {
        echo json_encode(array(
            'idEstatus' => -1,
            'mensaje' => $e->getMessage(),
            'data' => null
        ));
    }
    mysqli_close($conn);
}

function deleteLugar($conn){
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
        $idLugar = $obj['idLugar'];

        //prevent sql injection
        $idLugar = mysqli_real_escape_string($conn, $idLugar);

        //crear sql para insertar
        $sql = "DELETE FROM tbl_lugares WHERE idLugar = '$idLugar'";

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
                'mensaje' => 'No se encontraron elementos'
            ));
        }
    } catch (Exception $e) {
        echo json_encode(array(
            'idEstatus' => -1,
            'mensaje' => $e->getMessage(),
            'data' => null
        ));
    }
    mysqli_close($conn);
}

function getByCategoria($conn){
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
        $idCategoria = $obj['idCategoria'];

        //prevent sql injection
        $idCategoria = mysqli_real_escape_string($conn, $idCategoria);

        //crear sql para insertar
        $sql = "SELECT * FROM tbl_lugares WHERE idCategoria = '$idCategoria'";

        $result = mysqli_query($conn, $sql);
        
        if($result){
            $lugares = array();
            while($row = mysqli_fetch_assoc($result)){
                $lugares[] = $row;

                //buscar fotos de productos
                $sqlFotos = 'SELECT * FROM tbl_fotoslugares WHERE idLugar = '.$row['idLugar'];
                $resultFotos = mysqli_query($conn, $sqlFotos);
                if(mysqli_num_rows($resultFotos) > 0){
                    $fotos = array();
                    while($rowFotos = mysqli_fetch_assoc($resultFotos)){
                        $fotos[] = $rowFotos;
                    }
                    $lugares[count($lugares)-1]['fotos'] = $fotos;
                }else{
                    $lugares[count($lugares)-1]['fotos'] = null;
                }
            }
            echo json_encode(array(
                'idEstatus' => 1,
                'data' => $lugares,
                'mensaje' => 'Operación realiza con éxito'
            ));
        }else{
            echo json_encode(array(
                'idEstatus' => 0,
                'data' => null,
                'mensaje' => 'No se encontraron elementos'
            ));
        }
    } catch (Exception $e) {
        echo json_encode(array(
            'idEstatus' => -1,
            'mensaje' => $e->getMessage(),
            'data' => null
        ));
    }
    mysqli_close($conn);
}


//get -> todos los lugares
//get action = search -> un lugar

//1 -> ok
//0 -> no se encrontraron elementos o reglas de validacion
//-1 -> error en la base de datoos o en el servidor