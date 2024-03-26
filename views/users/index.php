<?php

require 'classes/connection.php';

$connection = new Connection();

$users = $connection->query("SELECT * FROM users");
?>
<section class="container mt-5">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal">
                Adicionar
            </button>
            <table id="" class="table table-striped table-responsive myTable">
                <thead>
                    <tr>
                        <th width="30px">ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th width="55px"></th>
                        <th width="55px"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        foreach ($users as $user) {
                            $html = '<tr>
                                        <td>' . $user->id . '</td>
                                        <td>' . $user->name . '</td>
                                        <td>' . $user->email . '</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-model="users" data-json="" data-edit>
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