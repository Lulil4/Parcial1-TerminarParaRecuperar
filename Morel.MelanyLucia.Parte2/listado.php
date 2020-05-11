<?php
include_once ("./clases/televisor.php");

$televisores = Televisor::Traer();
        
echo "<h2>Lista de Juguetes</h2>";
echo    "<table border='solid'>
            <thead>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Pais de Origen</th>
                <th>Foto</th>
                <th>Precio con IVA</th>
            </thead>";
foreach($televisores as $televisor)
{
    echo    "<tr>
                <td align='center'>".$televisor->_tipo."</td>
                <td align='center'>".$televisor->_precio."</td>
                <td align='center'>".$televisor->_paisOrigen."</td>";
    if($televisor->_path != ""){
        echo    "<td align='center'>
                    <img src='".$televisor->_path."' width='90px' height='90px'>
                </td>";
    }
    echo "<td align='center'>".$televisor->calcularIVA()."</td>
    </tr>";
}
echo "</table>";