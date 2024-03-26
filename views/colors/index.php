<?php

require 'classes/connection.php';

$connection = new Connection();

$colors = $connection->query("SELECT * FROM colors");
?>

<section class="container mt-5">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add-modal">
                Adicionar
            </button>
            <table id="" class="table table-striped table-responsive myTable">
                <thead>
                    <tr>
                        <th width="30px">ID</th>
                        <th>Cor</th>
                        <th width="35px"></th>
                        <th width="55px"></th>
                        <th width="55px"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($colors as $color) {
                        $html = '<tr>
                                    <td>' . $color->id . '</td>
                                    <td>' . $color->name . '</td>
                                    <td><div class="color" style="background-color: ' . $color->name . '"></div></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-model="colors" data-json="" data-edit>
                                            Editar
                                        </button>
                                    </td>
                                    <td>
                                        <form action="" method="POST" data-delete>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>';

                        echo $html;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>