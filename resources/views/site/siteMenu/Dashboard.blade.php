@extends('site.siteMenu.layoutFora')
@section('title','Dashboard')
@section('conteudo')
<div style="padding:25px">
<H1>Comece uma obra </H1>
{{--@if(Auth::user()->atribuicao_Usuario_id_Atribuicao == 1)--}}



            <div class="row g-3">
                 <div class="col-sm-4 mb-3 mb-sm-0 ">
                    <a href="{{route('site.criarobra')}}" class="btn btn-primary w-100" >Criar Obra </a>
                </div>
            </div>


{{--@endif--}}

<hr>

<H1>Lista de obras</H1>

    @if($obras->isEmpty() || $obras->filter(function ($obra) {return $obra->status !== 'Finalizado';})->isEmpty())
        <p>Nenhuma obra registrada ou ativa </p>
    @else
    <div class="row g-3 " >

            @foreach ($obras as $obra)
                @if($obra->status!='Finalizado')
                <div class="col-sm-4 mb-3 mb-sm-0 " >
                    <div class="card w-auto h-100" id="cardoso" style="background-image: url('/img/obra6.jpg');background-size: cover;--bs-card-border-color: #e9ecef !important;" >
                        <div class="card-body d-flex justify-content-between" >
                          <div class="w-50" >

                          <h3 class="card-title text-break ">{{$obra->nome}} </h3>

                        </div>
                        <div class="d-flex flex-column row-gap-2" >
                          <a href="{{route('obra.dashboard', ['id' => $obra->idObras])}}" class="btn btn-primary" style="width:  6.4rem !important">Acessar</a>
                          {{--@if(Auth::user()->atribuicao_Usuario_id_Atribuicao == 1)--}}
                          <a href="{{route('obra.editar', ['id' => $obra->idObras])}}" class="btn btn-primary" style="width:  6.4rem !important">Editar</a>
                          <a href="{{route('obra.desativar', ['id' => $obra->idObras])}}" onclick="return confirm('Tem certeza que deseja desativar ?')" class="btn btn-danger" style="width: 6.4rem !important" >desativar</a>
                         {{-- @endif--}}
                        </div>
                        </div>
                      </div>
                    </div>
                @else
                @endif
            @endforeach

    </div>
    @endif
    <hr>

    <h1>Obras Desativadas</h1>
    @if($obras->filter(function ($obra) {return $obra->status === 'Finalizado';})->isEmpty())
        <p>Nenhuma Obra Desativada</p>
    @else
    <div class="row g-3 " >

      @foreach ($obras as $obra)
          @if($obra->status=='Finalizado')
          <div class="col-sm-4 mb-3 mb-sm-0 " >
              <div class="card w-auto h-100" style="background-image: url('/img/obra (1).jpg');background-size: cover ;background-size: cover;--bs-card-border-color: #e9ecef !important;" >
                  <div class="card-body d-flex justify-content-between" >
                    <div class="w-50" >

                    <h3 class="card-title text-break ">{{$obra->nome}} </h3>

                  </div>
                  <div class="d-flex flex-column row-gap-2" >
                    <a href="{{route('obra.dashboard', ['id' => $obra->idObras])}}" class="btn btn-primary" style="width:  6.4rem !important">Acessar</a>
                    {{--@if(Auth::user()->atribuicao_Usuario_id_Atribuicao == 1)--}}
                    <a href="" class=" invisible btn btn-success" style="width:  6.4rem !important">Editar</a>
                    <a href="" class=" invisible btn btn-danger" style="width: 6.4rem !important" >desativar</a>
                    {{--@endif--}}
                  </div>
                  </div>
                </div>
              </div>
          @else
           @endif
      @endforeach

</div>
@endif





</div>
@endsection
