<?php
/**
* Process for create all directories, Dinamic
* each table.page
*
*/

require_once 'config.php';


/**
* create directororyes in ./image/resolutions/xx
* permission 777
*/
function createDirectoryOfPages($id)
{
    $return = false;
    if (!empty($id)) {
        $directorory = __DIR__. "/image/resolution/$id";
        if (!is_dir($directorory)) {
            $oldmask = umask(0);
            $return = mkdir($directorory, 0777);
            umask($oldmask);
        }
    }

    return $return;
}

echo "<br>*****************************************";
echo "<br> Create directories";
echo "<br>*****************************************";
$link = mysqli_connect($servidor, $user, $pass, $database) or die("Error " . mysqli_error($link));
$query = 'SELECT  id FROM page ';
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0 ) {
    while($row = $result->fetch_assoc()) {
        $flag = createDirectoryOfPages($row['id']);
        echo ($flag) ? '<BR>OK' : '<BR>FAIL';
    }
}
mysqli_close($link);