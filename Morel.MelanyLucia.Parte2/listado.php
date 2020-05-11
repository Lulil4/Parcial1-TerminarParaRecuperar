<?php
include_once ("./clases/televisor.php");

$televisores = Televisor::Traer();
        
echo "<h2>Lista de Juguetes</h2>";
echo    "<table border='solid'>
            <thead>
               <th>Id</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Pais de Origen</th>
                <th>Foto</th>
                <th>Precio con IVA</th>
            </thead>";
foreach($televisores as $televisor)
{
    echo    "<tr>
                <td align='center'>".$televisor->getID()."</td>
                <td align='center'>".$televisor->tipo."</td>
                <td align='center'>".$televisor->precio."</td>
                <td align='center'>".$televisor->paisOrigen."</td>";
    if($televisor->path != ""){
        echo    "<td align='center'>
                    <img src='".$televisor->path."' width='90px' height='90px'>
                </td>";
    }
    echo "<td align='center'>".$televisor->calcularIVA()."</td>
    </tr>";
}
echo "</table>";