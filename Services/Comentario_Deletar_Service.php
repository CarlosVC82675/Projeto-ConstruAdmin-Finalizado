<?php  

namespace App\Services;
use App\Models\Comentarios;
class Comentario_Deletar_Service{


    public function DeletarComentario($idComentario){
        $comment= Comentarios::findOrFail($idComentario);
        $comment->delete();
 
     }



}

?>