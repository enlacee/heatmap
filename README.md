HEATMAP (mapa de calor)
=====================
Descripcion:
-------------
Gestionar mapa de calor en determinadas paginas
pruebas con el plugin http://www.patrick-wied.at/static/heatmapjs
- script para obtener data (movimiento del mouse)

#### INSTALACION
> - Siga los pasos

#### Paso 1
Creacion de base de datos el archivo a ejecutar se encuentra en :
<pre>doc/heatmap.sql</pre>    
#### Paso 2
Configuracion los parámetros de base de datos que se encuentran en el archivo :
**config.dist.php**  cambiar de nombre a : **config.php**

    mv config.dist.php config.php
    //---------------------------
    $database = 'heatmap';
    $user = 'root';
    $pass = '******';
    $servidor = 'localhost';

#### Paso 3
Configurar la pagina (donde se se activara el plugin mapa de calor)
en la estructura html justo en el tag **body** poner esta linea  (funcion javascript), este se encargara  de capturar el movimiento del mouse y guardarlo en la base de datos.
revise **http://localhost/heatmap/client.html** (este es la pagina demo  uselo como guia si es necesario)

    <body onmousemove="getPos(event)">contenidohtml</body>

También incluir las librerías javascript jquery y **heatmapFunction.js** (archivo principal)

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/heatmapFunction.js"></script>

#### Paso 4
Ahora podemos ver los reportes, para esta version solo hay habilitados:
// resoluciones de monitores aceptados (configurable para otras resoluciones)
- 1366x768
- 1280x800
- 1024x768
- 1600x900

Para ver el reporte ingrese : http://localhost/heatmap/reporte.php 