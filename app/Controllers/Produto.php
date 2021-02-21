<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\ProdutoModel;

class Produto extends Controller{

	protected $helpers = ['html', 'form', 'url'];

    public function index(){
		$produtoModel = model('ProdutoModel', true, $db);
		$data['produtos'] = $produtoModel->findAll();
		return view('produtos_view', $data);
	}

	public function detalhes($id){
		$produtoModel = model('ProdutoModel', true, $db);
		$movimentacaoModel = model('MovimentacaoModel', true, $db);
		$data['produto'] = $produtoModel->find($id);
		$data['movimentacoes'] = $movimentacaoModel->withDeleted()->orderBy('data', 'DESC')->where('produto', $id)->findAll();
		return view('produto_detalhes_view', $data);
	}
	
	public function novo(){
		return view('novo_produto_view');
	}

	public function salvar(){
		$produtoModel = model('ProdutoModel', true, $db);


		if ($this->request->getMethod() === 'post' && $this->validate([
            'nome' => 'required|max_length[50]'
        ]))
		{
			$produtoModel->save([
				'nome' => $this->request->getPost('nome'),
				'quantidade'  => $this->request->getPost('quantidade'),
			]);
			
			echo "<script>		  
					document.addEventListener('DOMContentLoaded', function() {
					M.toast({html: 'Salvo com sucesso!'})
					});
				 </script>";
		
			return view('novo_produto_view');
		} else {
			return view('novo_produto_view');
		}

	}

	public function editarNome(){
		$produtoModel = model('ProdutoModel', true, $db);

		if ($this->request->getMethod() === 'post' && $this->validate([
            'nome' => 'required|max_length[50]'
        ])){
		$produtoModel->update($this->request->getPost('id'),[
			'nome' => $this->request->getPost('nome'),
		]);
	}	
		return $this->detalhes($this->request->getPost('id'));
	}

	public function deletar($id){
		$produtoModel = model('ProdutoModel', true, $db);
		$produtoModel->delete($id);
		return $this->index();
	}

	public function entrada(){
		$movimentacaoModel = model('MovimentacaoModel', true, $db);

		$mov = [
            'produto' => $this->request->getPost('produto'),
            'quantidade'  => $this->request->getPost('quantidade'),
            'quantidadeAnterior'  => $this->request->getPost('quantidadeAtual'),
			'entrada' => true
		];

		if ($this->request->getFile('nf')->isValid()) {
			$mov['nf'] = $this->request->getFile('nf')->store('nfs');
		}

		$movimentacaoModel->save($mov);
		
		return  $this->detalhes($this->request->getPost('produto'));
	}

	public function saida(){
		$movimentacaoModel = model('MovimentacaoModel', true, $db);

		$mov = [
            'produto' => $this->request->getPost('produto'),
            'quantidade'  => $this->request->getPost('quantidade'),
            'quantidadeAnterior'  => $this->request->getPost('quantidadeAtual'),
			'entrada' => false
		];

		if ($this->request->getFile('nf')->isValid()) {
			$mov['nf'] = $this->request->getFile('nf')->store('nfs');
		}

		$movimentacaoModel->save($mov);
		
		return  $this->detalhes($this->request->getPost('produto'));
		}

	public function downloadNF($id) {
		$movimentacaoModel = model('MovimentacaoModel', true, $db);
		$mov = $movimentacaoModel->find($id);
		return $this->response->download(WRITEPATH.'uploads/'.$mov['nf'], null);
	}

	public function deletarMovimentacao($id){
		$movimentacaoModel = model('MovimentacaoModel', true, $db);
		$mov = $movimentacaoModel->withDeleted()->find($id);
		$movimentacaoModel->delete($id);
		return $this->detalhes($mov['produto']);
	}
}