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
    $point = formarDataXY($array);

    //echo "<pre>"; print_r($point);
?>
<!-- html -->
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Mouse Move Heatmap Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="index, follow" />
  <meta name="description" content="This example also demonstrates how to dynamically add data to a heatmap instance with the 'addData' function at runtime" />
  <meta name="keywords" content="click heatmap, click heat, click map, mouse click map" />
  <style>
body, html, h2 { margin:0; padding:0; height:100%;}
.demo-wrapper { width:100%; height:100%; position:absolute; background:rgba(0,0,0,.1); background-image:"image/resolution/11366x768.png"}
.heatmap {width: 100%;height: 100%;}
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="demo-wrapper">
      <div class="heatmap">        
      </div>
    </div>
  </div>
  <script src="js/heatmap.min.js"></script>  
  <script>    
    window.onload = function() {
        document.body.style.backgroundImage="url('image/resolution/<?php echo $screen ?>.png')";        
        //var heatmapContainer = document.getElementById('heatmap')

        // data
        <?php $string = '';
        foreach ($point as $key => $arreglo) {
            foreach($arreglo as $indice => $value) { // print_r($arreglo);
                $string .= "{x:".$arreglo['x'].", y:".$arreglo['y'].", value:50},"; continue;             
            }
        }        
        if($string != '') {
            $string = substr($string, 0, -1);            
        }
        ?>

        //var points = [{x:582, y:500,value: 50}, {x:10, y:10,value: 50}];
        var points = [<?php echo $string ?>];
        var data = { max: 96, data: points };
        console.log('data', data);

        //render
        var heatmapInstance = h337.create({
            container: document.querySelector('.heatmap')
        });

        //var data = generateRandomData(200);
        heatmapInstance.setData(data);



    };
  </script>
</body>
</html>
<!-- html -->
<?php else : ?>
    <ul>
    <?php for ($i = 0; $i < count($sc); $i++) : ?> 
        <li><a href="?id_page=1&sc=<?php echo $sc[$i]['screem'] ?>"><?php echo $sc[$i]['screem'] ?></a></li>
    <?php endfor;?>
    </ul>
<?php endif; ?>
