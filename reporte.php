<?php
// data base screem
$sc[0]['screem'] = '1366x768';
$sc[1]['screem'] = '1280x800';
$sc[2]['screem'] = '1024x768';
$sc[3]['screem'] = '1600x900';

// function helper
/**
* unserializar data current array
*/
function formatData($data) {
    $newData = array();
    foreach($data as $key => $value) {
        foreach($value as $indice => $valor) {
            if ($indice == 'data_serial') {
                $newData[$key][$indice] = unserialize($valor);
            } else {
                $newData[$key][$indice] = $valor; 
            }
        }
    }
    return $newData;
}

/*
* order array only x and y
*/
function formarDataXY($data) {
    $newData = array();
    foreach($data as $key => $value) {
        foreach($value as $indice => $valor) {
            if ($indice == 'data_serial') {                
                foreach($valor as $a => $b) {
                    $newData[] = array ('x' => $valor[$a]['x'], 'y' => $valor[$a]['y']);
                    continue;
                }                             
            }
        }
    }
    return $newData;
}



//conection:
$database = 'heatmap';
$user = 'root';
$pass = '123456';

?>
<?php  if (!empty($_GET['sc'])) : ?>
<?php 
/*echo "<pre>";
print_r($_GET);*/
    $link = mysqli_connect("localhost", $user, $pass, $database) or die("Error " . mysqli_error($link));
    // insert
    $screen = $_GET['sc'];
    $id_page = $_GET['id_page'];
    $query = "SELECT  data_serial FROM heatmap WHERE screen = '$screen' AND id_page = '$id_page' ";
    $result = mysqli_query($link, $query,MYSQLI_USE_RESULT);
    
    $dataResult = array();
    if ($result) {
        $c = 0;
        while($row = $result->fetch_assoc()) {  
            $dataResult[$c] = $row;
            $c++;
        }
    }
    mysqli_close($link);

    $array = formatData($dataResult);    
    $array2 = formarDataXY($array);

    echo "<pre>"; print_r($array2);


?>
<?php else : ?>
    <ul>
    <?php for ($i = 0; $i < count($sc); $i++) : ?> 
        <li><a href="?id_page=1&sc=<?php echo $sc[$i]['screem'] ?>"><?php echo $sc[$i]['screem'] ?></a></li>
    <?php endfor;?>
    </ul>
<?php endif; ?>