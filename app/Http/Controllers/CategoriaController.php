<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;


use DB;

class CategoriaController extends Controller
{
    function index(){
        $categorias = Categoria::all();

        return view("admin/novoLivro", ["categorias"=>$categorias]);
    }

    function store(Request $request){
        $categoria = new Categoria();
        $categoria->nome = $request->nomeCategoria;
        if($request->disponibilidadeCategoria == "on"){
            $categoria->disponivel = 1;
        }else{
            $categoria->disponivel = 0;
        }
        $categoria->save();

        return redirect("admin/novaCategoria");
    }

    function pickAdmValue($id){
        $categoria = DB::select("select * from categorias where id = $id");
        return view("admin/formEditarCategoria", ['categoria'=>$categoria[0]]);
    }

    function update(Request $request){
        $idCategoria = $request->idCategoria;
        $nomeCategoria = $request->nomeCategoria;
        $disponivel;
        if(isset($request->disponibilidadeCategoria)){
            $disponivel = 1;
        }else{
            $disponivel = 0;
        }
        

        DB::table('categorias')
              ->where('id', $idCategoria)
              ->update(
                [
                    'nome' => $nomeCategoria,
                    'disponivel' => $disponivel
                ]
            );

        return redirect("/admin");

    }

    function excluir($id){

        $livros = DB::select("SELECT * FROM livros WHERE idCategoria = $id");

        if(count($livros) == 0){
            DB::table('categorias')
            ->where('id', $id)
            ->delete();
            return redirect("/admin");
        }else{
            echo "<script>alert('Não foi possivel apagar pois há livros cadastrados nesta categoria')</script>";
            return redirect("admin/editarCategoria/$id");
        }

        
    }
}
