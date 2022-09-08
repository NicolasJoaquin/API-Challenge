<!-- html/Home.php --> 

<h1 class="mt-5" id="homeTitle">¡Bienvenido!</h1>
<h3>Para probar la App:</h3>
<p>La aplicación cuenta con tres endpoints (<strong>getData</strong>, <strong>viewData</strong> y <strong>searchData</strong>) y una base de datos
de MySQL llamada <strong>conectapps</strong> con una &uacute;nica tabla llamada <strong>post</strong>. Los endpoints cumplen con las siguientes funcionalidades: </p>
<p><strong>getData:</strong> Consulta datos a la api con URL <a href="https://jsonplaceholder.typicode.com/posts">https://jsonplaceholder.typicode.com/posts</a> 
y los almacena en la tabla <strong>post</strong>. Para probarlo:
    <ol>
        <li>Clickee el bot&oacute;n <strong>getData</strong> en el header para acceder al endpoint.</li>
        <li>Seleccione si quiere o no eliminar los registros existentes de la tabla post y luego presione el bot&oacute;n <strong>Realizar Alta</strong>.</li>
        <li>Podr&aacute; ver el resultado de la importaci&oacute;n de datos a trav&eacute;s de la misma pantalla en la que se encuentra al ejecutar el punto anterior.</li>
        <li>Tenga en cuenta que no podr&aacute; importar reg&iacute;stros con "id" repetidos, por lo que si la tabla <strong>post</strong> est&aacute; llena la importación fallará .</li>
    </ol>
</p>
<p><strong>viewData:</strong> Consulta todos los registros de la tabla <strong>post</strong> y los muestra en pantalla en formato JSON. Para probarlo:
    <ol>
        <li>Clickee el bot&oacute;n <strong>viewData</strong> en el header para acceder al endpoint.</li>
        <li>¡Listo!, podr&aacute; ver todos los registros de la tabla post.</li>
    </ol>
</p>
<p><strong>searchData:</strong> Consulta el registro de la tabla <strong>post</strong> con el ID indicado y lo muestra en pantalla en formato JSON. Para probarlo:
    <ol>
        <li>Clickee el bot&oacute;n <strong>searchData</strong> en el header para acceder al endpoint.</li>
        <li>Indique en el input, el ID del regístro a buscar.</li>
        <li>Presione el bot&oacute;n <strong>Buscar</strong> y podr&aacute; ver el regístro indicado.</li>
    </ol>
</p>
<p><strong>Adicionales:</strong> Para crear la base de datos y tabla 'post' ejecute las siguientes consultas en MySQL.
    <ul>
        <li>Crear base de datos: <i>CREATE DATABASE conectapps;</i>.</li>
        <li>Crear tabla 'post': <i>CREATE TABLE post (userId int NOT NULL, id int PRIMARY KEY, title varchar(300) NOT NULL, body varchar(500) NOT NULL);</i>.</li>
    </ul>
</p>

    