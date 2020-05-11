<?php
include_once ("./clases/usuario.php");
$usuarios = array();
$usuarios = Usuario::traerTodos();
        
echo "<h2>Lista de usuarios</h2>";
echo    "<table border='solid'>";
foreach($usuarios as $usuario)
{
    echo    "<tr>
                <td align='center'>".$usuario->toString()."</td>
            </tr>";
}
echo    "</table>";