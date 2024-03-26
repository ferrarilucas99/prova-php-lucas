<?php

require 'classes/connection.php';

$connection = new Connection();

$colors = $connection->query("SELECT * FROM colors");

echo "<table border='1'>

    <tr>
        <th>ID</th>    
        <th>Cor</th>
        <th>Ação</th>    
    </tr>
";

foreach($colors as $color) {

    echo sprintf("<tr>
                      <td>%s</td>
                      <td>%s</td>
                      <td>
                           <a href='#'>Editar</a>
                           <a href='#'>Excluir</a>
                      </td>
                   </tr>",
        $color->id, $color->name);

}

echo "</table>";