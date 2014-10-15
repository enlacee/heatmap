HEATMAP (mapa de calor) multi sitios
===================================
Descripción:
-------------
Gestiona mapas de calor en determinadas páginas.

Elaborado en base al plugin http://www.patrick-wied.at/static/heatmapjs (script para obtener datos de posicionamiento del cursor del mouse)

# INSTALACIÓN

## Paso 1: Creación de base de datos

> Crear usuario de base de datos
> Crear base de datos
> Ejecutar archivo doc/heatmap.sql para crear las tablas page y heatmap

## Paso 2: Configuración

> Copiar config.dist.php como config.php
> Editar config.php y poner los datos de conexión a la base de datos

    cp config.dist.php config.php
    vim config.php
    //---------------------------
    $servidor = 'localhost';
    $database = 'heatmap';
    $user = 'root';
    $pass = '******';

## Paso 3: Generar lista de páginas

En la tabla **page** se deben agregar agregan todas las URLS de las paginas web que usted quiere hacer seguimiento. Para este ejemplo, se han insertado en la tabla "page" 3 URLs, de los cuales el primero es: http://localhost/heatmap/client.html

Actualize este registro con las lineas de abajo si quiere seguimiento ah otro sitio web (cambie la url).

    UPDATE `page` SET
    `url` = 'http://vlearning.icpna.edu.pe/in/web/login'
    WHERE `id` = '1';

Aquí por lo tanto para cada pagina tenemos una carpeta que contendrá 4 resoluciones por defecto que se visualizarán en el reporte.
Para crear estas carpetas de manera automatica cargamos este archivo:

    http://localhost/heatmap/install.php

*Las imágenes son consideradas de uno de 4 tamaños comunes de pantallas. Se configuran manualmente por el momento.*

## Paso 4: Incluir el JS

Configurar la pagina donde se se activará el plugin de mapa de calor.

En la estructura HTML, justo en el tag **body** poner esta linea  (funcion javascript), este se encargara  de capturar el movimiento del mouse y guardarlo en la base de datos.
revise **http://localhost/heatmap/client.html** (este es la página demo, usela como guía si es necesario)

    <body onmousemove="getPos(event)">contenidohtml</body>

También incluir las librerías javascript jquery y **heatmapFunction.js** (archivo principal)

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/heatmapFunction.js"></script>


## Paso 5

Ahora se pueden ver los reportes. Para esta versión solo se han habilitado las resoluciones de monitores comunes siguientes (configurable para otras resoluciones)
- 1366x768
- 1280x800
- 1024x768
- 1600x900
- 1680x1050

Para ver el reporte ingrese : http://localhost/heatmap/report.php
