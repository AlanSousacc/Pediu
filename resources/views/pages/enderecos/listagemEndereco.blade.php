@extends('layouts.app', [
'namePage' => 'Listagem de Endereços',
'class' => 'sidebar-mini',
'activePage' => 'localendereco',
])

@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          @if (isset($id))  
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('novo.endereco', $id) }}">Adicionar Endereço</a>
          @endif
          <h4 class="card-title"> Listagem de Endereços</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="overflow: initial!important;">
            <table class="table">
              <thead class=" text-primary">
                <th class="text-center">Nome contato</th>
                <th class="text-center">Endereco</th>
                <th class="text-center">Número</th>
                <th class="text-center">Bairro</th>
                <th class="text-center">Cidade</th>
                <th class="text-center">End. Principal</th>
                <th class="text-center">Opções</th>
              </thead>
              <tbody>
                @foreach ($consulta as $item)
                <tr>
                  <td class="text-center">{{$item->contato->nome}}</td>
                  <td class="text-center">{{$item->endereco}}</td>
                  <td class="text-center">{{$item->numero}}</td>
                  <td class="text-center">{{$item->bairro}}</td>
                  <td class="text-center">{{$item->cidade}}</td>
                  <td class="text-center">{{$item->principal == 1 ? 'Sim' : 'Não'}}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('endereco.edit', $item->id) }}">Alterar</a>
                        <a class="dropdown-item" href="{{$item->id}}" data-contid={{$item->id}} data-target="#delete" data-toggle="modal">Remover</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-md-10"><p>Mostrando {{$consulta->count()}} endereços de um total de {{$consulta->total()}}</p></div>
            <div class="col-md-2">{{$consulta->links()}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- modal Deletar--}}
  @include('pages.enderecos.modalExcluirEntrega')
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='https://cdnjs.com/libraries/jquery.mask'></script>
<script src='{{asset('js/enderecos/entrega.js')}}'></script>
@endpush
@endsection