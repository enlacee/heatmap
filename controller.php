<?php

if (!empty($_POST)) {
    saveAction($_POST);
}

/**
 * Save data
 * @param   array   Request data (unfiltered)
 */
function saveAction($request)
{
    require_once 'config.php';

    //connection:
    $link = mysqli_connect($servidor, $user, $pass, $database) or die("Error " . mysqli_error($link));

    $flag = 'false';
    $param = $request;
    $idUrl = mysqli_real_escape_string($link, $param['idUrl']);
    
    $dataPost = isset($param['data']) ? $param['data'] : false;
    $idPage = _checkIdUrl($link, $idUrl);

    if ($idPage > 0 && is_array($dataPost) && count($dataPost) > 0) {
        $reg = formarDataToSerial($idPage, $dataPost);

        $reg['page_id'] = intval($reg['page_id']);
        $reg['browser_id'] = $reg['browser_id'];
        $reg['view_port'] = mysqli_real_escape_string($link, $reg['view_port']);
        $reg['window_browser'] = mysqli_real_escape_string($link, $reg['window_browser']);
        $reg['screen'] = mysqli_real_escape_string($link, $reg['screen']);        

        $query = "INSERT INTO heatmap (page_id, browser_id, view_port, window_browser, screen, data_serial, created_at) "
            . "VALUES ('".$reg['page_id']."', '".$reg['browser_id']."','".$reg['view_port']."','".$reg['window_browser']."','".$reg['screen']."', '".$reg['data_serial']."', '".date('Y-m-d H:i:s')."')";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);        
        $flag = 'true';
    }
    mysqli_close($link);

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
            $array[$counter]['page_id'] = $idPage;
            $array[$counter]['browser_id'] = $data[$i]['id'];
            $array[$counter]['view_port'] = $data[$i]['viewPort'];
            $array[$counter]['window_browser'] = $data[$i]['windowBrowser'];
            $array[$counter]['screen'] = $data[$i]['screen'];
        }
        $dataSerial[$i] = array(
            'x' => $data[$i]['x'],
            'y' => $data[$i]['y'],
            'page_id' => $idPage,
            'browser_id' => $data[$i]['id'],
            'view_port' => $data[$i]['viewPort'],
            'window_browser' => $data[$i]['windowBrowser'],
            'screen' => $data[$i]['screen'],
            'created_at' => $data[$i]['date'],
        );
    }
    $array[$counter]['data_serial'] = serialize($dataSerial);

    return $array[0];
}


/**
* helper of main function
* search idPage of sites avaibles for apply graphic heatmap.
*/
function _checkIdUrl($linkConnection, $url) {

    $flag = false;
    $url = mysqli_real_escape_string($linkConnection, $url);
    $matches = array();
    if (preg_match('/\/COURSE(\d*)\//', $url, $matches)) {
        $course = $matches[1];
        if (strpos($url,'kids')) {
            $url = str_replace('COURSE'.$course, 'COURSE002', $url);
            $url = str_replace('index.php','',$url);
        } else {
            $url = str_replace('COURSE'.$course, 'COURSE4', $url);
            $url = str_replace('index.php','',$url);
        }
    }
    $query = "SELECT  id FROM page WHERE url = '$url' LIMIT 1";
    $count = mysqli_fetch_row(mysqli_query($linkConnection, $query));

    return (intval($count[0]) > 0)  ? $count[0] : false;
}