<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('template/header'); ?>
    <title>Novo Produto</title>
    
</head>


<body>
    <nav>
        <div class="nav-wrapper teal">
            <div class="row">
                <div class="col s12">
                    <a href="<?= site_url()?>"></a>
                    <span id="mobile-breadcrumbs">
                        <a href="<?= site_url()?>" class="breadcrumb"><i class="material-icons">home</i></a>
                        <a href="#!" class="breadcrumb">Novo Produto</a>
                    </span>
                </div>
            </div>
        </div>
    </nav>
    

    <div class="container">
        <div class="row">
            <div class="col s12">
                <?php echo form_open('produto/salvar'); ?>
                <div class="row">
                    <div class="input-field col s12">
                        <input required pattern=".{1,50}" autofocus id="nome" name="nome" type="text" class="validate">
                        <label for="nome">Nome</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="quantidade" name="quantidade" type="number" class="validate">
                        <label for="quantidade">Quantidade</label>
                    </div>
                </div>
                <div class="row">
                    <a class="btn waves-effect waves-light grey lighten-1" href="<?=base_url()?>">Voltar
                        <i class="material-icons left">arrow_back</i>
                    </a>
                    <button class="btn waves-effect waves-light right" type="submit" name="action">Salvar
                        <i class="material-icons right">save</i>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Structure -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>

  <?= script_tag('assets/jquery/jquery-3.5.1.min.js') ?>
    <?= script_tag('assets/materialize/js/materialize.min.js') ?>

</body>

</html>