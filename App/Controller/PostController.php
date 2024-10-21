<?php 

class PostController{
    public function index($params){
        try{
            $postagem = Postagem::selecionaPorId($params);
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $parametros = array();
            $parametros['post'] = $postagem;
            $parametros['ID'] = $postagem->ID;
            $parametros['TITULO'] = $postagem->TITULO;
            $parametros['CONTEUDO'] = $postagem->CONTEUDO;
            $parametros['comentarios'] = $postagem->comentarios;


            $conteudo = $template->render($parametros);
            echo $conteudo;
 
        }
        catch (Exception $e) {
            echo($e->getMessage());
        }
    }
    public function addcoment(){
        try{
            Comentario::inserir($_POST);
            echo '<script>alert("COMENTADO COM SUCESSO !");</script>';
            header('Location: http://localhost/SistemaCRUD-MVC-PHP-SQL/?pagina=post&id='.$_POST['id']);
            }
            catch (Exception $e) {
               echo($e->getMessage());
               echo '<script>alert("'.$e->getMessage().'");</script>';
               echo '<script>location.href="http://localhost/SistemaCRUD-MVC-PHP-SQL/?pagina=post&id='.$_POST['id'].'"</script>';
            }
    }
}
?>