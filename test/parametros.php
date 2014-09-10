<?php
echo "<pre>";
//print_r($_REQUEST);
$dataPost = isset($_POST['data']) ? $_POST['data'] : false;
$idPage = (int) empty($_POST['idPage']) ? 0 : $_POST['idPage'];
if (is_array($dataPost) && count($dataPost) > 0) {
    $reg = formarDataToSerial($idPage, $dataPost);

   // print_r($reg);



    //conection:
    $database = 'heatmap';
    $user = 'root';
    $pass = '123456';
    $link = mysqli_connect("localhost", $user, $pass, $database) or die("Error " . mysqli_error($link));
    // insert
    $query = "INSERT INTO heatmap (page_id, browser_id, view_port, window_browser, screen, data_serial, created_at) "
        . "VALUES ('".$reg['page_id']."', '".$reg['browser_id']."','".$reg['view_port']."','".$reg['window_browser']."','".$reg['screen']."', '".$reg['data_serial']."', '".$reg['created_at']."')";
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
            $array[$counter]['page_id'] = $idPage;
            $array[$counter]['browser_id'] = $data[$i]['id'];
            $array[$counter]['view_port'] = $data[$i]['viewPort'];
            $array[$counter]['window_browser'] = $data[$i]['windowBrowser'];
            $array[$counter]['screen'] = $data[$i]['screen'];
            $array[$counter]['created_at'] = date('Y-m-d H:i:s');
        }
        $dataSerial[$i] = array(
            'x' => $data[$i]['x'],
            'y' => $data[$i]['y'],
            'page_id' => $idPage,
            'browser_id' => $data[$i]['id'],
            'view_port' => $data[$i]['viewPort'],
            'window_browser' => $data[$i]['windowBrowser'],
            'screen' => $data[$i]['screen'],
        );
    }
    $array[$counter]['data_serial'] = serialize($dataSerial);
    //$array[$counter]['data_serial'] = $dataSerial;

    return $array[0];
}