@extends('layout')
@section("css")
  {{asset("css/adminList.css")}}
@endsection
@section('container')

<header>
  <h1>Página Administrativa</h1>
</header>
<main>
  <div id="containerAdicionar">
    <div id="escolha">
      <button onclick="addNewCategoria()" class="botaoNovo">Nova Categoria</button>
      <button onclick="addNewLivro()" class="botaoNovo">Novo Livro</button>
    </div>
  </div>
  <div id="container">
    <div id="containerCategorias">
      <table>
        <thead>
          <tr>
            <th>Nome da Categoria</th>
            <th>Adicionado em</th>
            <th>Atualizado em</th>
            <th>Disponível</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categorias as $categoria)
            <tr class="CategoriaCard" onclick="abrirEdicaoCategoria({{$categoria->id}})">
              <td id="nomeCategoria">{{$categoria->nome}}</td>
              <td id="adicionado">{{$categoria->created_at}}</td>
              <td id="atualizado">{{$categoria->updated_at}}</td>
              @if ($categoria->disponivel == 1)
                <td id="disponivel">Sim</td>
                @else
                <td id="disponivel">Não</td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div id="containerLivros">
      <table>
        <thead>
          <tr>
            <th>Título do Livro</th>
            <th>Autor</th>
            <th>Categoria</th>
            <th>Adicionado em</th>
            <th>Atualizado em</th>
            <th>Disponível</th>
          </tr>
        </thead>
        @foreach ($livros as $livro)
          <tr class="livroCard" onclick="abrirEdicaoLivro({{$livro->id}})">
              <td id="nomeLivro">{{$livro->nome}}</td>
              <td id="autor">{{$livro->autor}}</td>
              <td id="categoriaLivro">{{ $livro->nomeCategoria }}</td>
              <td id="adicionado">{{$livro->created_at}}</td>
              <td id="atualizado">{{$livro->updated_at}}</td>
              @if ($livro->disponivel == 1)
                <td id="disponivel">Sim</td>
                @else
                <td id="disponivel">Não</td>
              @endif
          </tr>
        @endforeach
      </table>
  </div>
  </div>
</main>

<script>

  function abrirEdicaoLivro(idLivro){
    window.location.href = `admin/editarLivro/${idLivro}`
  }

  function abrirEdicaoCategoria(idCategoria){
    window.location.href = `admin/editarCategoria/${idCategoria}`
  }

  function addNewLivro(){
    window.location.href = "admin/novoLivro"
  }

  function addNewCategoria(){
    window.location.href = "admin/novaCategoria"
  }

</script>
@endsection