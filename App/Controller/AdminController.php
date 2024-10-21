<?php 

class AdminController{
    public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('admin.html');

            $objPostagens = Postagem::selecionaTodos();
            $parametros = array();
            $parametros['postagens'] = $objPostagens;

            $conteudo = $template->render($parametros);
            echo $conteudo;
    }
    public function create(){
        $loader = new \Twig\Loader\FilesystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = array();

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }
    public function insert(){
        try{Postagem::insert($_POST); 
            echo '<script>alert("INSERIDO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaCRUD-MVC-PHP-SQL/?pagina=admin&metodo=index"</script>';
        }
        catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaCRUD-MVC-PHP-SQL/?pagina=admin&metodo=create"</script>';
        }
    
    }
    public function change($paramId){
        $loader = new \Twig\Loader\FilesystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $post = Postagem::selecionaPorId($paramId);
        var_dump($post);
        $parametros = array();
        $parametros['id'] = $post->ID;
        $parametros['titulo'] = $post->TITULO;
        $parametros['conteudo'] =$post->CONTEUDO;


        $conteudo = $template->render($parametros);
        echo $conteudo;
    }
    public function update(){
        try{Postagem::update($_POST);
            echo '<script>alert("ALTERADO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaCRUD-MVC-PHP-SQL/?pagina=admin&metodo=index"</script>';
        }
        catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaCRUD-MVC-PHP-SQL/?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
        }
    }

    public function delete($paramId){
        try{Postagem::delete($paramId);
            echo '<script>alert("APAGADO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaCRUD-MVC-PHP-SQL/?pagina=admin&metodo=index"</script>';
        }
        catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaCRUD-MVC-PHP-SQL/?pagina=admin&metodo=index"</script>';
        }
    }
}
?>