# API-Challenge
**Para probar la App:**
La aplicación cuenta con tres endpoints (getData, viewData y searchData) y una base de datos de MySQL llamada challenge con una única tabla llamada post. Los endpoints cumplen con las siguientes funcionalidades:

**getData:** Consulta datos a la api con URL https://jsonplaceholder.typicode.com/posts y los almacena en la tabla post. Para probarlo:

- Clickee el botón getData en el header para acceder al endpoint.
- Seleccione si quiere o no eliminar los registros existentes de la tabla post y luego presione el botón Realizar Alta.
- Podrá ver el resultado de la importación de datos a través de la misma pantalla en la que se encuentra al ejecutar el punto anterior.
- Tenga en cuenta que no podrá importar regístros con "id" repetidos, por lo que si la tabla post está llena la importación fallará .

**viewData:** Consulta todos los registros de la tabla post y los muestra en pantalla en formato JSON. Para probarlo:

- Clickee el botón viewData en el header para acceder al endpoint.
- ¡Listo!, podrá ver todos los registros de la tabla post.

**searchData:** Consulta el registro de la tabla post con el ID indicado y lo muestra en pantalla en formato JSON. Para probarlo:

- Clickee el botón searchData en el header para acceder al endpoint.
- Indique en el input, el ID del regístro a buscar.
- Presione el botón Buscar y podrá ver el regístro indicado.

**Adicionales:** Para crear la base de datos y tabla 'post' ejecute las siguientes consultas en MySQL.

- Crear base de datos: CREATE DATABASE challenge;.
- Crear tabla 'post': CREATE TABLE post (userId int NOT NULL, id int PRIMARY KEY, title varchar(300) NOT NULL, body varchar(500) NOT NULL);.
