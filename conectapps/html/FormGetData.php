<!-- html/FormGetData.php --> 

<h1 class="mt-5">¿Desea eliminar los registros de la tabla antes de realizar el alta de datos?</h1>
<form action="./getData" method="post">
    <label> <input type="radio" name="deleteTable" id="delete" value="yes"> SI </label> <br>
    <label> <input type="radio" name="deleteTable" id="notDelete" value="no"> NO </label> <br>
    <button type="submit">Realizar Alta</button>
</form>