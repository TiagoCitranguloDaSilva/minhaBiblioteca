@extends("layout")
@section("css")
    {{asset("css/editarLivro.css")}}
@endsection
@section("container")
    <main>
        <form action="/updateLivro" method="post" enctype="multipart/form-data">
            @csrf
            <input type="number" name="idLivro" id="idLivro" value="{{$livro->id}}">
            <div id="imagem" style="background-image: url('{{ asset("pictures/$livro->linkImagem")}}')">
                <label for="imagemCapa">Mudar Capa</label>
                <input type="file" name="imagemCapa" id="imagemCapa" onchange="pickValue()">
                <p id="message"></p>
            </div>
            <div id="nome">
                <div>
                    <label for="nomeLivro">Nome do livro:</label>
                    <input type="text" name="nomeLivro" id="nomeLivro" value="{{ $livro->nome }}">
                </div>
            </div>
            <div id="autor">
                <div>
                    <label for="autorLivro">Autor do livro:</label>
                    <input type="text" name="autorLivro" id="autorLivro" value="{{ $livro->autor }}">
                </div>
            </div>
            <div id="categoria">
                <div>
                    <label for="inputCategoria">Categoria principal do livro: </label>
                    <select name="categoriaEscolhida" id="" required>
                        @foreach ($categorias as $categoria)
                            @if($categoria->id == $livro->idCategoria)
                                <option value="{{$categoria->id}}" selected>{{$categoria->nome}}</option>
                            @else
                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="disponibilidade">
                <label for="disponibilidadeLivro">Disponibilidade: </label>
                @if ($livro->disponivel == 1)
                    <input type="checkbox" name="disponibilidadeLivro" id="disponibilidadeLivro" checked>
                @else
                    <input type="checkbox" name="disponibilidadeLivro" id="disponibilidadeLivro">
                @endif
            </div>
            <div id="buttons">
                <input type="submit" value="Salvar">
                <button type="button" id="voltar" onclick="voltarTela()">Voltar</button>
                <button type="button" id="excluir" onclick="excluirLivro()">Excluir</button>
            </div>
        </form>
    </main>
    <script>
        let inputFile = document.getElementById("imagemCapa")
        let mensagem = document.getElementById("message")

        function pickValue(){
            let valor = inputFile.value
            if(valor != null){
                mensagem.innerText = valor;
            }
        }

        function excluirLivro(){
            let id = document.getElementById("idLivro").value
            window.location.href=`/excluirLivro/${id}`
        }

        function voltarTela(){
            window.location.href = "/admin"
        }
    </script>
@endsection