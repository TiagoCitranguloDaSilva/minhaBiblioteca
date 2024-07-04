@extends("layout")
@section("css")
    {{asset("css/detalhesLivro.css")}}
@endsection
@section("container")
    {{-- <img src='{{asset("pictures/$livro->linkImagem")}}'>
    {{$livro->nome}}
    {{$livro->autor}} --}}
    <main>
        <form action="/update" method="POST">
            @csrf
            <input type="number" name="idLivro" id="idLivro" value="{{$livro->id}}">
            <div id="imagem" style="background-image: url('{{ asset("pictures/$livro->linkImagem")}}')"></div>
            <div id="nome">
                <div>
                    <label for="nomeLivro">Nome do livro:</label>
                    <input type="text" name="nomeLivro" id="nomeLivro" value="{{ $livro->nome }}" readonly>
                </div>
            </div>
            <div id="autor">
                <div>
                    <label for="autorLivro">Autor do livro:</label>
                    <input type="text" name="autorLivro" id="autorLivro" value="{{ $livro->autor }}" readonly>
                </div>
            </div>
            <div id="categoria">
                <div>
                    <label for="categoriaAtual">Categoria do livro:</label>
                    <input type="text" name="categoria" id="categoriaAtual" value="{{ $categoria->nome }}" readonly>
                </div>
            </div>
            <button type="button" onclick="voltar()">Voltar</button>
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

        function voltar(){
            window.location.href = "/"
        }
    </script>
@endsection