<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model {
    
    protected $table      = 'produto';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['nome' , 'quantidade'];

    protected $useTimestamps = false;

    protected $useSoftDeletes = false;


}
?>