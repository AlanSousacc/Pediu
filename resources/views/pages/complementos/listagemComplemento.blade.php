@extends('layouts.app', [
'namePage' => 'Listagem de Complementos',
'class' => 'sidebar-mini',
'activePage' => 'listagemComplementos',
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
        <div class="card-header row">
          <div class="col-md-6">
            <h4 class="card-title">Complementos</h4>
          </div>
          <div class="col-md-6">
            <a href="{{route('complemento.create')}}" class="d-block float-right btn btn-success"><i class="fa fa-plus"></i> Novo Complemento</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="overflow: initial!important;">
            <table class="table">
              <thead class=" text-primary">
                <th class="text-center">#ID</th>
                <th class="text-center">Descrição</th>
                <th class="text-center">Preço</th>
                <th class="text-center">Opções</th>
              </thead>
              <tbody>
                @foreach ($consulta as $item)
                <tr>
                  <td class="text-center">{{$item->id}}</td>
                  <td class="text-center">{{$item->descricao}}</td>
                  <td class="text-center">R$ {{number_format($item->preco, 2, ',', '.')}}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('complemento.edit', $item->id) }}">Alterar</a>
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
            <div class="col-md-10"><p>Mostrando {{$consulta->count()}} complementos de um total de {{$consulta->total()}}</p></div>
            <div class="col-md-2">{{$consulta->links()}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- modal Deletar--}}
  @include('pages.complementos.modalExcluirComplemento')
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/complementos/complementos.js')}}'></script>
@endpush
@endsection
