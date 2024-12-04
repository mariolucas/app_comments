<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comentarios extends Model
{
    protected $table = 'comentarios';
    protected $fillable = ['id_usuario', 'comentario'];
    protected $dates = ['created_at', 'updated_at'];

    public static function buscarComentarios()
    {
        $sql = "
            SELECT comentario, DATE_FORMAT(comentarios.created_at, '%d/%m/%Y %H:%i' ) as data , usuarios.nome as nome
            FROM comentarios
            JOIN usuarios ON usuarios.id = comentarios.id_usuario
        ";

        return DB::select($sql);
    }

    public static function buscarComentariosPorUsuario($id)
    {
        $sql = "
            SELECT comentarios.id, 
                   comentario, 
                   DATE_FORMAT(comentarios.created_at, '%d/%m/%Y %H:%i' ) as data_criacao , 
                   DATE_FORMAT(comentarios.updated_at, '%d/%m/%Y %H:%i' ) as data_atualizacao,
                   usuarios.nome as nome
            FROM comentarios
            JOIN usuarios ON usuarios.id = comentarios.id_usuario
            WHERE comentarios.id_usuario = ?
        ";

        return DB::select($sql, [$id]);
    }

}
