<?php 
namespace App\Models;

use CodeIgniter\Model;

class MovimentacaoModel extends Model {
    
    protected $table      = 'movimentacao';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['produto' , 'entrada', 'quantidade', 'quantidadeAnterior', 'nf'];

    protected $useTimestamps = false;

    protected $useSoftDeletes = true;

}
?>