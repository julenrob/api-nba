# api-nba

Dentro de .env.webapp:
**APACHE_SERVER_NAME=apinba.local**
**APACHE_SERVER_ALIAS=apinba.local**
**APACHE_DOCUMENT_ROOT=/code/public**

Cambiamos el nombre del contenedor por apinba dentro de docker-compose.yml

Levantar el contenedor
**docker-compose up -d**

Acceder a la terminal Linux del contenedor
**docker-compose exec web bash**

Una vez dentro del contenedor:
Crear estructura symfony
**symfony new api-nba --version=4.4 --full --no-git**

Se nos habrá creado un directorio llamado api-nba donde nos habrá creado todos los archivos y carpetas necesarios de Symfony.

Borramos los archivos “docker-compose.override.yml” y “docker-compose.yml” (para no sobrescribir el docker-compose.yml que usa el contenedor).

Ahora movemos todos los archivos y directorios de esta carpeta a la carpeta superior /code.
(Situándonos en la carpeta /code ejecuta mv api-nba/* . y ejecuta mv api-nba/.env .).

Una vez hecho esto borra la carpeta api-nba.

Dentro de la carpeta provisisioning/sites-enabled cambia las siguientes líneas por:
**ServerName apinba.local**
**ServerAlias apinba.local**
**DocumentRoot /code/public/**
**<Directory "/code/public">**

Tiene que quedar así:


![image1](https://github.com/julenrob/api-nba/blob/master/Readme%20Images/1.png?raw=true)

Permisos para todos a las carpetas cache y log dentro de var:
**root@440a097a8522:/code# chmod -R 777 var/cache/***
**root@440a097a8522:/code# chmod -R 777 var/log/**

Fichero .env donde tenemos las variables de conexión a la base de datos:

**DB_USER=root**
**DB_PASSWORD=dbrootpass**
**DB_HOST=add-dbms**
**DB_NAME=nba**
**DATABASE_URL="mysql://${DB_USER}:${DB_PASSWORD}@${DB_HOST}:3306/${DB_NAME}?serverVersion=5.7"**

Añade esto al fichero .sql de creación del esquema de la base de datos, antes de drop table if exists equipos:

**create schema if not exists nba;**
**use nba;**

De esta forma, si en el futuro necesitáramos poner la base de datos a sus valores iniciales podremos hacerlo con el comando que veremos a continuación.

Redireccionamos el script sql de creación de la estructura de la base de datos nba con el siguiente comando:

**mysql -u root -pdbrootpass -h add-dbms < files/nba_2022-02-02.sql**


Conectamos datagrip a la base de datos nba con el puerto 33006 y el usuario root y contraseña dbrootpass.

Para introducir la información en la base de datos de los archivos .csv utilizaremos python.

![image2](https://github.com/julenrob/api-nba/blob/master/Readme%20Images/2.png?raw=true)

Siguiendo este ejemplo realizaremos la carga de datos en la base de datos, sin olvidarnos de el orden correcto, equipos, jugadores, partidos y estadísticas (al haber claves foráneas que apuntan a otras tablas de no crearlas en el orden correcto tendríamos fallos).

![image3](https://github.com/julenrob/api-nba/blob/master/Readme%20Images/3.png?raw=true)

Una vez tenemos dentro de la base de datos los datos, pasamos a crear las Entities con las que vamos a trabajar (es el formato que entiende Symfony para los distintos objetos de la base de datos).
Dentro del container ejecuta:
(Este comando convierte las tablas y sus registros al lenguaje que entiende Symfony para poder trabajar).
**php bin/console doctrine:mapping:convert annotation src/Entity --from-database**

Ahora dentro de cada Entity creado añadimos el namespace App\Entity; y en las claves foráneas quitamos las barras al tipo de dato, acto seguido generamos los getters y setters para cada Entity y borramos los setters de las claves primarias.


Ahora crearemos dentro de la carpeta Repository un repositorio para cada Entity para poder crear selecciones de datos personalizadas, más allá del findOneBy, findOne, etcétera, las clases php extenderán de EntityRepository.

Dentro de cada Entity vamos a indicar que tiene un repositorio individual en el que buscar selecciones de datos personalizados, las primeras anotaciones que hacemos en cada entity tienen una etiqueta que pone **“@ORM\Entity”**: en la cual vamos a añadir **(repositoryClass=”App\Repository\EquiposRepository”)** donde Equipos es el nombre de la Entity.
Aquí desarrollaremos las funciones que albergarán las querys necesarias para hacer las búsquedas.


Después de haber creado cada Repository para cada Entity pasamos a crear un Controller para cada Entity, dentro de src/Controller, aquí crearemos las funciones necesarias para conectar con cada Repository.

Por último, en config/routes.yaml tendremos los endpoints con cada enlace de búsqueda.

https://github.com/beberlei/DoctrineExtensions 
Para cuando necesites usar el group concat, dateFormat, round (redondear), entre otros bundles externos a los que trae Symfony por defecto.


Dentro del container ejecuta composer **require beberlei/doctrineextensions** (tumba el container y vuelve a levantarlo).

Dentro de config/pacakges/doctrine.yaml añade las siguientes líneas:

**group_concat: DoctrineExtensions\Query\Mysql\GroupConcat**
**date_format: DoctrineExtensions\Query\Mysql\DateFormat**
**round: DoctrineExtensions\Query\Mysql\Round**

![image4](https://github.com/julenrob/api-nba/blob/master/Readme%20Images/4.png?raw=true)

PARA LA ENTREGA DEL PROYECTO EJECUTAR LOS COMANDOS:
**rm -r var/cache/***
**rm -r var/log/***
**rm -r vendor/***
Zip del container entero

## QueryA
**Listará para cada equipo, toda la información que tiene.**

http://apinba.local:8082/equipos
<p align="left">
  <img width="400" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryA.PNG?raw=true">
</p>

## Query B
**Listará para un equipo dado su nombre, toda la información que tiene.**

http://apinba.local:8082/equipos/Lakers
<p align="left">
  <img width="400" height="300" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryB.PNG?raw=true">
</p>

## Query C
**Listará para cada equipo todos sus jugadores.**

http://apinba.local:8082/equipo/jugadores
<p align="left">
  <img width="400" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryC.PNG?raw=true">
</p>

## Query D
**Listará para cada equipo dado su nombre, todos sus jugadores.**

http://apinba.local:8082/equipo/jugadores/Bulls
<p align="left">
  <img width="400" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryD.PNG?raw=true">
</p>

## Query E
**Listará para cada jugador, toda la información que tiene.**

http://apinba.local:8082/jugadores
<p align="left">
  <img width="400" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryE.PNG?raw=true">
</p>

## Query F
**Listará para un jugador dado su nombre, toda la información que tiene.**

http://apinba.local:8082/jugadores/Kobe%20Bryant
<p align="left">
  <img width="500" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryF.PNG?raw=true">
</p>

## Query G
**Listará para un jugador dado su nombre, altura en cm y peso en kg y su posición.**

http://apinba.local:8082/jugador/fisico/Kobe%20Bryant
<p align="left">
  <img width="500" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryG.PNG?raw=true">
</p>

## Query H
**Listará para un jugador dado todas sus estadisticas que tenga registradas en la base de datos.**

http://apinba.local:8082/estadisticas/jugador/Kobe%20Bryant
<p align="left">
  <img width="500" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryH.PNG?raw=true">
</p>

## Query I
**Listará para un jugador dado su nombre, la media de todas sus estadísticas que tenga registradas en la base de datos.**

http://apinba.local:8082/estadisticas/jugador/Kobe%20Bryant/avg
<p align="left">
  <img width="500" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryI.PNG?raw=true">
</p>

## Query J
**Listará para un equipo dado su nombre, todos los resultados en los que ha jugado como local.**

http://apinba.local:8082/partidos/resultados/local/Lakers
<p align="left">
  <img width="500" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryJ.PNG?raw=true">
</p>

## Query K
**Listará para un equipo dado su nombre, todos los resultados en los que ha jugado como visitante.**

http://apinba.local:8082/partidos/resultados/visitante/Lakers
<p align="left">
  <img width="500" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryK.PNG?raw=true">
</p>

## Query L
**Listará para un equipo dado su nombre, la media de puntos recibidos como local.**

http://apinba.local:8082/partidos/resultados/media/local/Lakers
<p align="left">
  <img width="500" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryL.PNG?raw=true">
</p>

## Query M
**Listará para un equipo dado su nombre, la media de puntos recibidos como visitante.**

http://apinba.local:8082/partidos/resultados/media/visitante/Lakers
<p align="left">
  <img width="500" height="400" src="https://github.com/julenrob/api-nba/blob/master/Readme%20Images/QueryM.PNG?raw=true">
</p>
