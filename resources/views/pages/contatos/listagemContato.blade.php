@extends('layouts.app', [
'namePage' => 'Listagem de Contatos',
'class' => 'sidebar-mini',
'activePage' => 'listagemContato',
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
          <h4 class="card-title"> Contatos</h4>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="ativo-tab" data-toggle="tab" href="#ativo" role="tab" aria-controls="ativo" aria-selected="true">Ativos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#inativo" role="tab" aria-controls="inativo" aria-selected="false">Inativos</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            {{-- tab ativo --}}
            <div class="tab-pane fade show active" id="ativo" role="tabpanel" aria-labelledby="ativo-tab">
              <div class="table-responsive" style="overflow: initial!important;">
                <table class="table">
                  <thead class=" text-primary">
                    <th class="text-center">#ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Endereço</th>
                    <th class="text-center">Telefone</th>
                    <th class="text-center">Opções</th>
                  </thead>
                  <tbody>
                    @foreach ($consulta->where('ativo', 1) as $item)
                    <tr>
                      <td class="text-center">{{$item->id}}</td>
                      <td class="text-center">{{$item->nome}}</td>
                      @foreach ($item->entregas->where('principal', 1) as $i)
                        <td class="text-center">{{$i->endereco}}</td>
                      @endforeach
                      <td class="text-center">{{$item->telefone}}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('contato.edit', $item->id) }}"><i class="ionicons ion-ios-paper-outline"></i> Alterar</a>
                            <a class="dropdown-item" href="{{$item->id}}" data-contid={{$item->id}} data-target="#delete" data-toggle="modal"><i class="ionicons ion-ios-close-outline"></i> Remover</a>
                            <a class="dropdown-item" href="{{ route('contato.endereco', $item->id)}}"><i class="ionicons ion-ios-location-outline"></i> Endereços</a>
                            <a class="dropdown-item" href="{{ route('contato.financeiro', $item->id)}}"><i class="ionicons ion-social-usd-outline"></i> Financeiro</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-10"><p>Mostrando {{$consulta->count()}} contatos de um total de {{$consulta->total()}} contatos</p></div>
                <div class="col-md-2">{{$consulta->links()}}</div>
              </div>
            </div>
            {{-- end ativo --}}

            {{-- tab inativo --}}
            <div class="tab-pane fade" id="inativo" role="tabpanel" aria-labelledby="inativo-tab">
              <div class="table-responsive" style="overflow: initial!important;">
                <table class="table">
                  <thead class=" text-primary">
                    <th class="text-center">#ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Endereço</th>
                    <th class="text-center">Telefone</th>
                    <th class="text-center">Opções</th>
                  </thead>
                  <tbody>
                    @foreach ($consulta->where('ativo', 0) as $item)
                    <tr>
                      <td class="text-center">{{$item->id}}</td>
                      <td class="text-center">{{$item->nome}}</td>
                      @foreach ($item->entregas->where('principal', 1) as $i)
                        <td class="text-center">{{$i->endereco}}</td>
                      @endforeach
                      <td class="text-center">{{$item->telefone}}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('contato.edit', $item->id) }}"><i class="ionicons ion-ios-paper-outline"></i> Alterar</a>
                            <a class="dropdown-item" href="{{$item->id}}" data-contid={{$item->id}} data-target="#delete" data-toggle="modal"><i class="ionicons ion-ios-close-outline"></i> Remover</a>
                            <a class="dropdown-item" href="{{ route('contato.endereco', $item->id)}}"><i class="ionicons ion-ios-location-outline"></i> Endereços</a>
                            <a class="dropdown-item" href="{{ route('contato.financeiro', $item->id)}}"><i class="ionicons ion-social-usd-outline"></i> Financeiro</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-10"><p>Mostrando {{$consulta->count()}} contatos de um total de {{$consulta->total()}} contatos</p></div>
                <div class="col-md-2">{{$consulta->links()}}</div>
              </div>
            </div>
            {{-- end inativo --}}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- modal Deletar--}}
  @include('pages.contatos.modalExcluirContato')
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/contato/contato.js')}}'></script>
@endpush
@endsection
