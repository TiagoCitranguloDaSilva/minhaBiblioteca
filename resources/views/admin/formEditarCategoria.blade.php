@extends("layout")
@section("css")
    {{asset("css/editarCategoria.css")}}
@endsection
@section("container")
    <main>
        <form action="/updateCategoria" method="post" enctype="multipart/form-data">
            @csrf
            <input type="number" name="idCategoria" id="idCategoria" value="{{$categoria->id}}">
            <div id="nome">
                <div>
                    <label for="nomeCategoria">Nome da categoria:</label>
                    <input type="text" name="nomeCategoria" id="nomeCategoria" value="{{ $categoria->nome }}">
                </div>
            </div>
            <div id="disponibilidade">
                <label for="disponibilidadeCategoria">Disponibilidade: </label>
                @if ($categoria->disponivel == 1)
                    <input type="checkbox" name="disponibilidadeCategoria" id="disponibilidadeCategoria" checked>
                @else
                    <input type="checkbox" name="disponibilidadeCategoria" id="disponibilidadeCategoria">
                @endif
            </div>
            <div id="buttons">
                <input type="submit" value="Salvar">
                <button type="button" id="voltar" onclick="voltarTela()">Voltar</button>
                <button type="button" id="excluir" onclick="excluirCategoria()">Excluir</button>
            </div>
        </form>
    </main>
    <script>

        function excluirCategoria(){
            let id = document.getElementById("idCategoria").value
            window.location.href=`/excluirCategoria/${id}`
        }

        function voltarTela(){
            window.location.href = "/admin"
        }
    </script>
@endsection