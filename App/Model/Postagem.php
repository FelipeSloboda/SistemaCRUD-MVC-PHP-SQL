<?php

class Postagem{
    public static function selecionaTodos()
    {   
        $con = Connection::getConn();

        $sql = "SELECT * FROM POSTAGEM ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();
        
        $resultado = array();

        while ($row = $sql->fetchObject()) {
            $resultado[] = $row;
        }
        
        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco1");		
        }
        return $resultado;
    }
    public static function selecionaPorId($idPost){
        $con = Connection::getConn();

        $sql = "SELECT * FROM POSTAGEM WHERE ID = {$idPost}";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = $sql->fetchObject();
        
        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco2");		
        }
        else{     
            $resultado->comentarios = Comentario::selecionarComentarios($resultado->ID);    
             
        }
        return $resultado;
    }
    public static function insert($dadosPost){
        if(empty($dadosPost['titulo']) || empty($dadosPost['conteudo'])){
            throw new Exception("Erro, dados invalidos.");
            return false;
        }
        $con = Connection::getConn();
        $sql = "INSERT INTO POSTAGEM (TITULO, CONTEUDO) VALUES('{$dadosPost['titulo']}','{$dadosPost['conteudo']}')";
        $sql = $con->prepare($sql);
        $res = $sql->execute();
        if($res == 0) {throw new Exception("Erro, falha ao inserir publicacao.");} 
        return true;
        
    }
    public static function update($params){ 
        $con = Connection::getConn();
        $sql = "UPDATE POSTAGEM SET TITULO = '{$params['titulo']}', CONTEUDO = '{$params['conteudo']}' WHERE ID = '{$params['id']}'";
        $sql = $con->prepare($sql);
        $res = $sql->execute();
        if($res == 0) {throw new Exception("Erro, falha ao alterar publicacao."); return false;} 
        return true;
        
    }

    public static function delete($params){ 
        $con = Connection::getConn();
        $sql = "DELETE FROM POSTAGEM WHERE ID = '{$params}'";
        $sql = $con->prepare($sql);
        $res = $sql->execute();
        if($res == 0) {throw new Exception("Erro, falha ao apagar publicacao."); return false;} 
        return true;
        
    }
}
?>