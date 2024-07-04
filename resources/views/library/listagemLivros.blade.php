@extends('layout')
@section("css")
  {{asset("css/list.css")}}
@endsection
@section('container')

<header>
  <h1>Livros Disponíveis</h1>
</header>
<main id="content">
  @forelse ($divisoes as $divisao)
      <div class="item">
        <div class="headerItem" onclick="changeState(this)">
          <div class="img" style="background-image: url('{{asset("pictures/Expandir.png")}}')"></div>
          {{ key($divisao) }}
        </div>
        <div class="bodyItem">
          @foreach ($divisao as $livro)
            @isset($livro)
              @forelse ($livro as $l)
                <div class="card" onclick="cardClick({{$l->id}})">
                  <p style="display: none" id="idLivro">{{$l->id}}</p>
                  <div id="img" style="background-image: url('{{ asset("pictures/" . $l->linkImagem)}}')"></div>
                  <div id="content">
                    <h5>{{$l->nome}}</h5>
                    <p>{{$l->autor}}</p>
                  </div>
                </div>
              @empty
                <h2 id="mensagemSemLivros">Não há livros cadastrados</h2>
              @endforelse
            @endisset
          @endforeach
        </div>
      </div>
  @empty
    <h1 id="message">Ainda não há livros cadastrados</h1>
  @endforelse
</main>
<script>

  function cardClick(idLivro){
    window.location.href = `detalhes/${idLivro}`
  }

  function changeState(elemento){
    let bodyItem = elemento.parentNode.children[1]
    let imagem = elemento.children[0]
    if(bodyItem.style.display == "grid"){
      bodyItem.style.display = "none"
      imagem.style.rotate = "0deg"
    }else{
      bodyItem.style.display = "grid"
      imagem.style.rotate = "180deg"
    }
  }


</script>
@endsection

