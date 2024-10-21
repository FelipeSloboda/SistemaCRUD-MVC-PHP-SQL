<?php

class Comentario{
    public static function selecionarComentarios($idPost){   
        $con = Connection::getConn();

        $sql = "SELECT * FROM COMENTARIO WHERE IDPOSTAGEM = {$idPost}";
        $sql = $con->prepare($sql);
        $sql->execute();
        
        $resultado = array();

        while ($row = $sql->fetchObject()) {
            $resultado[] = $row;
        }
        return $resultado;
    }
    public static function inserir($reqPost){
        $con = Connection::getConn();
        $sql = "INSERT INTO COMENTARIO (NOME, MENSAGEM, IDPOSTAGEM) VALUES ('{$reqPost['nome']}','{$reqPost['msg']}', '{$reqPost['id']}')";
        $sql = $con->prepare($sql);
        $sql->execute();
        if($sql->rowCount()){
            return true;
        }
        else{
            throw new Exception("Falha na inserção do comentario.");
        }
     
    }
}