<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Livro;

use App\Models\Categoria;

use DB;

class LivroController extends Controller
{
    function store(Request $request){

        $livro = new Livro();

        
        
        $linkFinal = __DIR__;
        $linkFinal = explode("\\", $linkFinal);
        for($c = 0; $c < 3; $c++){
            array_pop($linkFinal);
        }
        $nome = $request->nomeLivro;
        $date = date('m-d-Y h:i:s a', time());
        $date = str_replace(" ", "_", $date);
        $date = str_replace("-", "_", $date);
        $date = str_replace(":", "_", $date);
        $extensao = $_FILES['capaLivro']["type"];
        $extensao = explode("/", $extensao)[1];
        $linkFinal = implode("\\", $linkFinal) . "\public\pictures\\" . $date .".". $extensao;
        print_r($linkFinal);
        move_uploaded_file($_FILES['capaLivro']['tmp_name'], $linkFinal);


        $livro->linkImagem = $date .".". $extensao;
        $livro->nome = $nome;
        $livro->autor = $request->nomeAutorLivro;
        if(isset($request->disponibilidadeLivro)){
            $livro->disponivel = 1;
        }else{
            $livro->disponivel = 0;
        }
        $livro->idCategoria = $request->categoriaEscolhida;



        $livro->save();

        return redirect("admin/novoLivro");


    }

    function index(){

        $livros = DB::table('livros')
            ->join('categorias', 'categorias.id', '=', 'livros.idCategoria')
            ->select('livros.*', 'categorias.nome as nomeCategoria')->get();

        $categorias = Categoria::all();

        return view("admin/admin", ['livros'=>$livros, 'categorias'=>$categorias]);

    }

    function showActive(){

        $categorias =  DB::select("select * from categorias where disponivel = 1 ORDER BY nome");

        $divisoes = [];

        foreach($categorias as $categoria){
            array_push($divisoes, [$categoria->nome => DB::select("select * from livros where idCategoria = " . $categoria->id . " and disponivel = 1 ORDER BY nome")]);
        }


        return view("library/listagemLivros", ["divisoes"=>$divisoes]);

    }

    function pickValue($id){
        $livro = DB::select("select * from livros where id = $id");
        $idCategoria = $livro[0]->idCategoria;
        $categoria = DB::select("select * from categorias where id = $idCategoria");
        return view("library/detalhesLivro", ['livro'=>$livro[0], 'categoria'=>$categoria[0]]);
    }

    function pickAdmValue($id){
        $livro = DB::select("select * from livros where id = $id");
        $categorias = DB::select("select * from categorias");
        return view("admin/formEditarLivro", ['livro'=>$livro[0], 'categorias'=>$categorias]);
    }

    function update(Request $request){
        
        $idLivro = $request->idLivro;

        $livroAntigo = DB::select("select * from livros where id = $idLivro");
        $imagem = $request->imagemCapa;
        if(isset($imagem)){
            $linkFinal = __DIR__;
            $linkFinal = explode("\\", $linkFinal);
            for($c = 0; $c < 3; $c++){
                array_pop($linkFinal);
            }

            $linkImagem = DB::select("select linkImagem from livros where id = $idLivro");
            unlink(implode("\\", $linkFinal) . "\public\pictures\\" . $linkImagem[0]->linkImagem);

            $linkFinal = __DIR__;
            $linkFinal = explode("\\", $linkFinal);
            for($c = 0; $c < 3; $c++){
                array_pop($linkFinal);
            }
            $nome = $request->nomeLivro;
            $date = date('m-d-Y h:i:s a', time());
            $date = str_replace(" ", "_", $date);
            $date = str_replace("-", "_", $date);
            $date = str_replace(":", "_", $date);
            $extensao = $_FILES['imagemCapa']["type"];
            $extensao = explode("/", $extensao)[1];
            $linkFinal = implode("\\", $linkFinal) . "\public\pictures\\" . $date .".". $extensao;
            print_r($linkFinal);
            move_uploaded_file($_FILES['imagemCapa']['tmp_name'], $linkFinal);


            $imagem = $date .".". $extensao;
        }else{
            $imagem = $livroAntigo[0]->linkImagem;
        }
        $nomeLivro = $request->nomeLivro;
        $autorLivro = $request->autorLivro;
        $disponivel;
        if(isset($request->disponibilidadeLivro)){
            $disponivel = 1;
        }else{
            $disponivel = 0;
        }
        $idCategoria = $request->categoriaEscolhida;

        DB::table('livros')
              ->where('id', $idLivro)
              ->update(
                [
                    'nome' => $nomeLivro,
                    'autor' => $autorLivro,
                    'linkImagem' => $imagem,
                    'disponivel' => $disponivel,
                    'idCategoria' => $idCategoria,
                    'updated_at' => date("Y/m/d H:i:s")
                ]
            );

        return redirect("/admin");

    }

    function excluir($id){
        

        $link = DB::select("select linkImagem from livros where id = $id");

        $linkFinal = __DIR__;
        $linkFinal = explode("\\", $linkFinal);
        for($c = 0; $c < 3; $c++){
            array_pop($linkFinal);
        }
        $linkFinal = implode("\\", $linkFinal) . "\public\pictures\\" . $link[0]->linkImagem;

        unlink($linkFinal);
        DB::table('livros')
        ->where('id', $id)
        ->delete();
        return redirect("/admin");
    }

}



