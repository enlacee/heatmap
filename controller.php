<?php

if (!empty($_POST)) {
	saveAction($_POST);
}

/**
* save data
*/
function saveAction($request)
{
	require_once 'config.php';	

    $flag = 'false';
    $param = $request;
    $dataPost = isset($param['data']) ? $param['data'] : false;
    $idPage = (int) empty($param['idPage']) ? 0 : $param['idPage'];

    if (is_array($dataPost) && count($dataPost) > 0) {
        $reg = formarDataToSerial($idPage, $dataPost);

        //conection:
        $link = mysqli_connect($servidor, $user, $pass, $database) or die("Error " . mysqli_error($link));

        $query = "INSERT INTO heatmap (id_page, id_browser, view_port, window_browser, screen, data_serial, create_at) "
            . "VALUES ('".$reg['id_page']."', '".$reg['id_browser']."','".$reg['view_port']."','".$reg['window_browser']."','".$reg['screen']."', '".$reg['data_serial']."', '".date('Y-m-d H:i:s')."')";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        $flag = 'true';
    }

    echo $flag;
}

/**
 * Function Helper order param
 * @param $idPage
 * @param $data
 * @return mixed
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
            $array[$counter]['window_browser'] = $data[$i]['windowBrowser'];
            $array[$counter]['screen'] = $data[$i]['screen'];
        }
        $dataSerial[$i] = array(
            'x' => $data[$i]['x'],
            'y' => $data[$i]['y'],
            'id_page' => $idPage,
            'id_browser' => $data[$i]['id'],
            'view_port' => $data[$i]['viewPort'],
            'window_browser' => $data[$i]['windowBrowser'],
            'screen' => $data[$i]['screen'],
            'date' => $data[$i]['date'],
        );
    }
    $array[$counter]['data_serial'] = serialize($dataSerial);

    return $array[0];
}