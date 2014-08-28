<?php
echo "<pre>";
//print_r($_REQUEST);
$dataPost = isset($_POST['data']) ? $_POST['data'] : false;
$idPage = (int) empty($_POST['idPage']) ? 0 : $_POST['idPage'];
if (is_array($dataPost) && count($dataPost) > 0) {
    $reg = formarDataToSerial($idPage, $dataPost);

    print_r($reg);


    //conection:
    $database = 'heatmap';
    $user = 'root';
    $pass = 'beeznest';
    $link = mysqli_connect("localhost", $user, $pass, $database) or die("Error " . mysqli_error($link));

    // insert
    $query = "INSERT INTO heatmap (id_page, id_browser, view_port, data_serial, create_at) "
        . "VALUES ('".$reg['id_page']."', '".$reg['id_browser']."','".$reg['view_port']."', '".$reg['data_serial']."', '".$reg['data_serial']."')";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt); // CLOSE $stmt
    //$result = mysqli_query($link, 'heatmap');
    //var_dump($result);
    mysqli_close($link);
}


/**
 * @param int $idPage site web
 * @param array $data data of heatmap
 * @return array
 */
function formarDataToSerial($idPage, $data) {

    $array = array();
    $dataSerial = array();
    $counter = 0;

    for ($i = 0; $i < count($data); $i++) {
        if ($i == 0) {
            $array[$counter]['id_page'] = $idPage;
            $array[$counter]['id_browser'] = $data[$i]['id'];
            $array[$counter]['view_port'] = $data[$i]['viewPort'];
            $array[$counter]['create_at'] = date('Y-m-d H:i:s');
        }
        $dataSerial[$i] = array(
            'x' => $data[$i]['x'],
            'y' => $data[$i]['y'],
            'id_page' => $idPage,
            'id_browser' => $data[$i]['id'],
            'view_port' => $data[$i]['viewPort'],
        );
    }
    $array[$counter]['data_serial'] = serialize($dataSerial);
    //$array[$counter]['data_serial'] = $dataSerial;

    return $array[0];
}