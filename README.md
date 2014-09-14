HEATMAP (mapa de calor) multi sitios
===================================
Descripcion:
-------------
Gestionar mapa de calor en determinadas paginas
pruebas con el plugin http://www.patrick-wied.at/static/heatmapjs
- script para obtener data (movimiento del mouse)

#### INSTALACION
> - Siga los pasos

#### Paso 1
Creacion de base de datos el archivo a ejecutar se encuentra en :
la tabla : heatmap, page.
    doc/heatmap.sql
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
En la tabla **page** se deben agregar agregan todas las URLS de las paginas web que usted quiere hacer seguimiento, para este ejemplo se ha insertado en la tabla page este registro id =1, url =  http://localhost/heatmap/client.html como parte del demo
Actualize este registro con las lineas de abajo si quiere seguimiento ah otro sitio web (cambie la url).

    UPDATE `page` SET
    `url` = 'http://vlearning.icpna.edu.pe/in/web/login'
    WHERE `id` = '1';

Aquí por lo tanto para cada pagina tenemos una carpeta que contendrá las 4 resoluciones  por defecto que se visualizaran en el reporte.
Para crear estas carpetas de manera automatica ejecutamos este archivo:

    http://localhost/heatmap/install.php
*Las imágenes con el tamaño adecuado segun la resolucion es manual por el momento.*

#### Paso 4
Configurar la pagina (donde se se activara el plugin mapa de calor)
revise **http://localhost/heatmap/client.html** (este es la pagina demo  uselo como guia si es necesario)
incluir las librerías javascript jquery y **heatmapFunction.js** (archivo principal)

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/heatmapFunction.js"></script>


#### Paso 5
Ahora podemos ver los reportes, para esta version solo hay habilitados:
// resoluciones de monitores aceptados (configurable para otras resoluciones)
- 1366x768
- 1280x800
- 1024x768
- 1600x900

Para ver el reporte ingrese : http://localhost/heatmap/reporte.php 
