HEATMAP (mapa de calor)
=====================
Descripcion:
-------------
Gestionar mapa de calor en determinadas paginas
pruebas con el plugin http://www.patrick-wied.at/static/heatmapjs

1 : script para obtener data (movimiento del mouse)
2 : pagina web donde se ve el reporte (mapa de calor) 
con las las resoluciones (desktop, laptop) file =  **reporte.php**


#### INSTALACION
> - Creacion de base de datos
ejecute el archivo en su base de datos :  

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

    <body onmousemove="getPos(event)">contenidohtml</body>

#### Paso 4