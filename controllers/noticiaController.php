<?php 
require_once './models/NoticiaModel.php';
class NoticiaController {
    public function getNoticias() {
        $noticiaModel = new NoticiaModel();
        $response = $noticiaModel->getNoticias();

        return json_encode([
            'error' => null,
            'result' => $response
        ]);
    }

    public function createNoticia() {
      $dados = json_decode(file_get_contents('php://input'), true);  


        if (empty($dados['idAutor'])) 
            return $this->mostrarErro('Você deve informar o idAutor!');

        if (empty($dados['tituloNoticia'])) 
                return $this->mostrarErro('Você deve informar o tituloNoticia!');    
            
        if (empty($dados['conteudoNoticia']))
            return $this->mostrarErro('Você deve infromar o conteudoNoticia!');

        $noticia = new NoticiaModel(
        null, 
        $dados['idAutor'],
        $dados['tituloNoticia'],
        $dados['conteudoNoticia'],
        $dados['imagemNoticia']
        
        );

        $response = $noticia->create();

        return json_encode([
            'error' => null,
            'result' => $response
        ]);
        

        
        }

        public function uptadeNoticia(){
            $dados = json_decode(file_get_contents('php://input'), true);  
        
        if (empty($dados['idNoticia']))    
            return $this->mostrarerro('Você deve informar o idNoticia!');


        if (empty($dados['idAutor'])) 
            return $this->mostrarErro('Você deve informar o idAutor!');

        if (empty($dados['tituloNoticia'])) 
                return $this->mostrarErro('Você deve informar o tituloNoticia!');    
            
        if (empty($dados['conteudoNoticia']))
            return $this->mostrarErro('Você deve infromar o conteudoNoticia!');

        $noticia = new NoticiaModel(
            $dados['idNoticia'],
            $dados['idAutor'],
            $dados['tituloNoticia'],
            $dados['conteudoNoticia'],
            $dados['imagemNoticia']
        );
        
        $response = $noticia->update();

        return json_encode([
            'error'=> null,
            'result' => $response
        ]);

        }

        public function deleteNoticia() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idNoticia']))
            return $this->mostrarErro('Você deve informar o idNoticia!');

        $noticia = new NoticiaModel(
            $dados['idNoticia']
        );

        $response = $noticia->delete();

        return json_encode([
            'erro' => null,
            'result' => $response
        ]);  

        }

    

    private function mostrarErro(string $mensagem) {
        return json_encode([
            'error' => $mensagem,
            'result' => null
        ]);
    }
}
?>