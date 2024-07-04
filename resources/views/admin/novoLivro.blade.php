@extends('layout')
@section('css')
  {{asset("css/novoLivro.css")}}
@endsection
@section('container')

<div id="formContainer">
  <form action="/storeBook" method="POST" enctype="multipart/form-data" id="formularioLivro">
    @csrf
    <div id="containerInputImagem">
      <label for="floatingImagem" id="labelCapa">Clique aqui para adicionar a capa do livro</label>
      <input type="file" id="floatingImagem"  onchange="pickValue()" placeholder="Capa do Livro" name="capaLivro" required>
      <p id="message"></p>
    </div>
    <div>
      <label for="floatingName">Nome do Livro:</label>
      <input type="nome" id="floatingName" placeholder="Nome do Livro" name="nomeLivro" required autocomplete="off">
    </div>
    <div>
      <label for="floatingAuth">Autor:</label>
      <input type="text"id="floatingAuth" placeholder="Autor" name="nomeAutorLivro" required autocomplete="off">
    </div>
    <div id="categoria">
      <label for="inputCategoria">Categoria principal do livro: </label>
      <select name="categoriaEscolhida" id="" required>
        @foreach ($categorias as $categoria)
            <option value="{{$categoria->id}}">{{$categoria->nome}}</option> 
        @endforeach
      </select>
    </div>
    <div id="disponibilidade">
      <label for="flexCheckDefault">Disponibilidade:</label>
      <input type="checkbox" id="flexCheckDefault" name="disponibilidadeLivro">
    </div>
    <div id="buttons">
      <input type="submit" value="Salvar" id="saveButton"></input>
      <button type="button" onclick="voltarPagina()" id="voltar">Voltar</button>
    </div>
  </form>
</div>
<script>

  let inputFile = document.getElementById("floatingImagem")
  let mensagem = document.getElementById("message")

  function pickValue(){
    let valor = inputFile.value
    if(valor != null){
      mensagem.innerText = valor;
    }
  }

  function voltarPagina(){
    window.location.href = "../admin"
  }


</script>
@endsection