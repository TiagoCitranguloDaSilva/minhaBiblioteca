@extends("layout")
@section("css")
    {{asset("css/novaCategoria.css")}}
@endsection
@section("container")
    <div id="formContainer">
        <form action="/storeCategoria" method="POST" enctype="multipart/form-data" id="formularioLivro">
            @csrf
            <div>
                <label for="nomeCategoria">Nome da Categoria:</label>
                <input type="nome" id="nomeCategoria" placeholder="Nome da Categoria" name="nomeCategoria" required autocomplete="off">
            </div>
            <div id="disponibilidade">
                <label for="flexCheckDefault">Disponibilidade:</label>
                <input type="checkbox" id="flexCheckDefault" name="disponibilidadeCategoria">
            </div>
            <div id="buttons">
                <input type="submit" value="Salvar" id="saveButton">
                <button type="button" onclick="voltarPagina()" id="voltar">Voltar</button>
            </div>
        </form>
    </div>
    <script>
        function voltarPagina(){
            window.location.href = "../admin"
        }
    </script>
@endsection