<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo view('template/header'); ?>
    <title>Produtos</title>



</head>



<body>

    <div class="row">
        <div id="admin" class="col s12">
            <div class="card material-table">
                <div class="table-header">
                    <span class="table-title">Produtos</span>
                    <div class="actions">
                        <a href="<?= base_url('produto/novo')?>" class="modal-trigger waves-effect btn-flat nopadding"><i
                                class="material-icons right">add_box</i>Novo produto</a>
                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i
                                class="material-icons">search</i></a>
                    </div>
                </div>
                <table id="datatable">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $item):?>
                        <a href="">
                        <tr>
                            <td><?= $item['nome'] ?></td>
                            <td><b><?= $item['quantidade'] ?></b></td>
                            <td class="center">
                                <a href="<?= base_url('produto/detalhes')?>/<?= $item['id'] ?>" class="waves-effect waves-light btn white-text">Detalhes</a>
                            </td>
                        </tr>
                        </a>
                        <?php endforeach;?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <?= script_tag('assets/jquery/jquery-3.5.1.min.js') ?>
    <?= script_tag('assets/datatables/datatables.min.js') ?>
    <?= script_tag('assets/js/table.js') ?>
    <?= script_tag('assets/materialize/js/materialize.min.js') ?>

</body>



</html>