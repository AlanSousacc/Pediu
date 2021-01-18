@extends('layouts.app', [
'namePage' => 'Listagem de Empresas',
'class' => 'sidebar-mini',
'activePage' => 'listagemempresa',
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
          <h4 class="card-title"> Empresas Cadastradas</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="overflow: initial!important;">
            <table class="table">
              <thead class="text-primary">
                <th class="text-center">Status</th>
                <th class="text-center">Nome Proprietário</th>
                <th class="text-center">Razão Social</th>
                <th class="text-center">CNPJ</th>
                <th class="text-center">Licença</th>
                <th class="text-center">Validade</th>
                <th class="text-center">Opções</th>
              </thead>
              <tbody>
                @foreach ($consulta as $item)
                <tr class="{{$item->active != 'S' ? 'text-danger' : ''}}">
                  @if ($item->active == 'S')
                  <td class="text-center">
                    <i class="fa fa-check-circle text-success"></i>
                  </td>
                  @else
                  <td class="text-center">
                    <i class="fa fa-times-circle text-danger"></i>
                  </td>
                  @endif
                  <td class="text-center">{{$item->nome}}</td>
                  <td class="text-center">{{$item->razao}}</td>
                  <td class="text-center">{{$item->cnpj}}</td>

                  @if ((isset($item->licenca->status) && $item->licenca->status == 1))
                  <td class="text-center">
                    <i class="fa fa-check-circle text-success"></i>
                  </td>
                  @else
                  <td class="text-center">
                    <i class="fa fa-times-circle text-danger"></i>
                  </td>
                  @endif
                  @if ($item->active == 'S')
                  <td class="text-center">
                    {{!isset($item->licenca['dtvalidade']) ? 'S/V' : Carbon\Carbon::parse(isset($item->licenca['dtvalidade']))->format('d/m/Y')}}
                  </td>
                  @else
                  <td class="text-center">S/V</td>
                  @endif
                    {{-- {{$item->active == 'S' ? Carbon\Carbon::parse(isset($item->licenca['dtvalidade']))->format('d/m/Y') : 'S/V'}} --}}
                  <td class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('empresa.edit', $item->uuid) }}"><i class="fa fa-eye"></i> Visualizar</a>
                        <a href="{{$item->id}}" data-emprid={{$item->id}} data-target="#licenca" data-toggle="modal" class="dropdown-item"><i class="fa fa-address-card"></i> Licença</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-md-10"><p>Mostrando {{$consulta->count()}} empresa(s) de um total de {{$consulta->total()}}</p></div>
            <div class="col-md-2">{{$consulta->links()}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal licença-->
  @include('pages.empresas.modalLicenca')
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script src='{{asset('js/empresas/empresas.js')}}'></script>
<script src='{{asset('js/licenca/licenca.js')}}'></script>
@endpush
@endsection
