<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo view('template/header'); ?>
    <title><?=$produto['nome']?></title>
</head>

<body>

    <nav>
        <div class="nav-wrapper teal">
            <div class="row">
                <div class="col s12">
                    <a href="<?= site_url()?>"></a>
                    <span id="mobile-breadcrumbs">
                        <a href="<?= site_url()?>" class="breadcrumb"><i class="material-icons">home</i></a>
                        <a href="#!" class="breadcrumb"><?=$produto['nome']?></a>
                    </span>
                </div>
            </div>
        </div>
    </nav>


    <!-- CARDS -->
    <div class="row">
        <div class="col s12 m12 l4">
            <div class="card-panel blue-grey darken-1 prod-card">
            <?=form_open('produto/editarNome')?>    
            <div id="editarCard" class="card-content white-text">
                    <div class="row">
                        <div class="col">
                            <spam class="card-title"><b><?=$produto['nome']?></b></spam>
                        </div>
                        <div class="col right">

                            <a id="editarNome" href="#" class="btn  waves-effect waves-light grey"><i
                                    class="material-icons">edit</i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <spam class="qnt"><?=$produto['quantidade']?><spam>
                        </div>
                        <div class="col right">

                            <a onclick="deletarProduto('<?php echo site_url('produto/deletar/' . $produto['id'])?>','<?=$produto['nome']?>')"
                                class="btn  waves-effect waves-light red"><i class="material-icons">delete</i></a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- CARD ENTRADA -->
        <div class="col s12 m6 l4">
            <div class="card-panel green  lighten-1">
                <div class="card-content  white-text">
                    <span class="card-title">Entrada</span>
                    <?= form_open_multipart('produto/entrada'); ?>
                    <div class="row">
                        <div class="input-field col s4">
                            <input placeholder="Quantidade" id="quantidade" name="quantidade" type="number"
                                class="validate">
                            <label class="white-text " for="quantidade"></label>
                        </div>
                        <div class="col s4 ">
                            <div class="file-field input-field ">
                                <div class="btn">
                                    <span>NF</span>
                                    <input name="nf" type="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input placeholder="Upload" class="file-path validate white-text"
                                        type="text">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col s4 right">
                            <button class="btn waves-effect waves-light " type="submit" name="action">Salvar
                                <i class="material-icons right">save</i>
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="produto" value="<?=$produto['id']?>">
                    <input type="hidden" name="quantidadeAtual" value="<?=$produto['quantidade']?>">
                    </form>
                </div>
            </div>
        </div>
        <!-- CARD SAIDA -->
        <div class="col s12 m6 l4">
            <div class="card-panel red  lighten-1">
                <div class="card-content white-text">
                    <span class="card-title">Saída</span>
                    <?= form_open_multipart('produto/saida'); ?>
                    <div class="row">
                        <div class="input-field col s4">
                            <input required  placeholder="Quantidade" id="quantidade2" name="quantidade" type="number"
                                class="validate">
                            <label class="white-text " for="quantidade2"></label>
                        </div>
                        <div class="col s4 ">
                            <div class="file-field input-field ">
                                <div class="btn btn-sm">
                                    <span>NF</span>
                                    <input name="nf" type="file" >
                                </div>
                                <div class="file-path-wrapper">
                                    <input placeholder="Upload" class="file-path validate white-text"
                                        type="text">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col s4 right">
                            <button class="btn waves-effect waves-light " type="submit" name="action">Salvar
                                <i class="material-icons right">save</i>
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="produto" value="<?=$produto['id']?>">
                    <input type="hidden" name="quantidadeAtual" value="<?=$produto['quantidade']?>">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TABELA -->
    <div class="row">
        <div id="admin" class="col s12">
            <div class="card material-table">
                <div class="table-header">
                    <span class="table-title">Movimentações</span>
                    <div class="actions">
                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i
                                class="material-icons">search</i></a>
                    </div>
                </div>
                <table id="datatable">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Quantidade Anterior</th>
                            <th>Quantidade</th>
                            <th>Quantidade Final</th>
                            <th>NF</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movimentacoes as $item):?>

                        <!-- Calcula quantidade final apos movimentacao -->
                        <?php if ($item['entrada']) {
                            $quantidadeFinal = $item['quantidadeAnterior'] + $item['quantidade'];
                        } else {
                            $quantidadeFinal = $item['quantidadeAnterior'] - $item['quantidade'];

                        }
                        //Cor da row
                        if ($item['deleted_at']) {
                            echo "<tr class='grey  lighten-2'>";
                        } else if ($item['entrada']) {
                            echo "<tr class='green  lighten-2'>";
                        } else {
                            echo "<tr class='red  lighten-2'>";

                        }?>

                        <td><?= $item['data'] ?></td>
                        <td><?= $item['quantidadeAnterior'] ?></td>
                        <td><?= $item['quantidade'] ?></td>
                        <td><?= $quantidadeFinal ?></td>

                        <td>
                            <?php if ($item['nf']) {?>
                            <a id="download" href="<?= site_url('produto/downloadNF')?>/<?=$item['id']?>"
                                class="waves-effect waves-teal btn"><i class="material-icons">download</i></a>
                            <?php } ?>
                        </td>
                        <?php if ($item['deleted_at']) { ?>
                        <td class="center">
                            <?=$item['deleted_at']?>
                        </td>
                        <?php } else { ?>
                        <td class="center">
                            <a onclick="deletarMovimentacao('<?php echo site_url('produto/deletarMovimentacao/' . $item['id'])?>')"
                                class="waves-effect waves-light btn red  lighten-1">Deletar<i
                                    class="material-icons left">delete</i></a>
                        </td>
                        <?php } ?>
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
    <?= script_tag('assets/materialize/js/materialize.min.js') ?>
    <?= script_tag('assets/js/table.js') ?>
    <?= script_tag('assets/js/main.js') ?>


    <!-- JS para editar nome -->
    <script type="text/javascript">
    var prodId = "<?= $produto['id']?>";

    $("#editarNome").click(function() {
        const form = "<div  class='row'>" +
                "<div class='col'>" +
                    "<div class='input-field col s12 '>" +
                        "<input required pattern='.{1,50}' autofocus id='nome' name='nome' type='text' class='validate white-text'>" +
                        "<label for='nome'>Nome</label>" +
                    "</div>" +
                "</div>" +
                "<div class='col right'>" +
                    "<input type='hidden' name='id' value='" + prodId + "'" +
                    "<br><br><button type='submit' id='editarNome' href='#' class='btn waves-effect waves-light green '>" +
                    "<i class='material-icons left'>save</i>Salvar</button>" +
                "</div></form>" +
            "</div>" +
            "<div class='row'>" +
                "<div class='col right'>" +
                    "<a onClick='location.reload()' class='btn waves-effect waves-light grey'>" +
                    "<i class='material-icons left'>arrow_back</i>Voltar</a>" +
                "</div>" +
            "</div>"

        $('#editarCard').html(form);
    });
    </script>


</body>

</html>