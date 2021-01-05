@extends('layouts.app', [
'namePage' => 'editar entregador',
'class' => 'sidebar-mini',
'activePage' => 'editarpedido',
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
					<h5 class="title">{{__(" Editar Pedidos")}}</h5>
				</div>
				<div class="card-body">
					<form action="{{route('pedido.update', $pedido->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						@csrf
						@include('alerts.success')
						@include('pages.pedidos.formPedidos')
						<div class="card-footer text-right">
							<button type="submit" class="btn btn-primary btn-round" id="finalizaralteracao">{{__('Salvar Alterações')}}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src='{{asset('js/pedidos/pedidos.js')}}'></script>
<script>
	
	var count = 0;
	var TotalGeral = 0;
	var desconto = 0;
	
	$('#inserirProduto').click(function(){
		$.ajax({
			url: '{{route('busca.produto.pedido')}}' + '/' + $('#produto_id').val(),
			type: "get",
			dataType: "json"
			
		}).done(function(resposta) {
			let dados = resposta.data;
			
			var str = '<tr id="'+count+'">' 
				str += '<input type="hidden" name="produtos_listagem_id[]" value="'+dados.id+'" />'
				str += '<input type="hidden" name="produtos_qtde[]" value="'+$('#qtde').val()+'" />'
				str += '<input type="hidden" name="obsitem[]" value="'+$('#obsitem').val()+'" />'
				str += '<input type="hidden" name="prvenda[]" value="'+$('#prvenda').val()+'" />'
				
				if($('#obsitem').val() == ''){
					str += '<td class="text-left">'+ dados.descricao + '</td>'
				} else{
					str += '<td class="text-left">'+ dados.descricao + '<br><small class="obs-item"> ' + $('#obsitem').val() + '</small>' + '</td>'
				}
				
				str += '<td class="text-center">'+ $('#qtde').val() +'</td>'
				str += '<td class="text-center">'+ $('#prvenda').val() +'</td>'
				str += '<td class="text-center">'+ ($('#qtde').val() * $('#prvenda').val()).toFixed(2) +'</td>'
				str += '<td class="text-center"><button class="btn btn-outline-primary btn-sm btn-fab btn-icon btn-round" type="button" onclick="removerItem('+count+')"><i class="now-ui-icons ui-1_simple-remove"></i></button></td>'
				str += '</tr>';
				
				$('#total').val();
				
				TotalGeral += $('#qtde').val() * $('#prvenda').val();
				$('#total').val(TotalGeral - desconto);
				
				// habilita botão de finalizar pedido
				$('#finalizarPedido').prop('disabled', false);
				
				// habilita inserir desconto
				$('#desconto').removeAttr("readonly");
				$('.sifrao').removeClass('sifrao');
				
				$('#qtde').val(1);
				$('#listaProd').append(str);
				count++;
				limpaCampos();
			}).fail(function(jqXHR, textStatus ) {
				alert("Falha ao inserir produto no pedido!" + textStatus);
			});
		});
		
		function carregaLocalEntrega(){
			$.ajax({
				url: '{{route('busca.enderecos')}}' + '/' + $('#contatoid').val(),
				type: "get",
				dataType: "json"
				
			}).done(function(resposta) {
				$('#entrega_id').attr('readonly', false);
				let str = '';    
				$(resposta.data).each(function () {
					str += '<option value=' + this.id + '>' + this.endereco + ' - ' + this.numero  + ' - ' + this.bairro  + '</option>';
					
					var url = '{{ route("contato.edit", ":id") }}';
					url = url.replace(':id', resposta.data[0].contato_id);
					
					$('.contato-edit').attr("href", url);
				})
				
				$('#entrega_id').html(str);
				
			}).fail(function(jqXHR, textStatus ) {
				alert("Falha ao listar os dados de entrega: " + textStatus);
			});
		}
		
		// função de carregamento de local de entrega automático ao escolher o contato
		$('#contatoid').on('change',function(ev){
			carregaLocalEntrega();
		});
		
		function limpaCampos(){
			$('#obsitem').val('');
			carregaPrecoProduto();
		}
		
		function carregaProdutosGrid(id){
			$.ajax({
				url: '{{route('busca.produtopedido')}}' + '/' + id,
				type: "get",
				dataType: "json"
				
			}).done(function(resposta) {
				$('#entrega_id').select2('val', ''+resposta.data.pedido.endereco_id)
				var dados = resposta.data.produtos;
				
				for(var i = 0; i < dados.length ; i++){
					
					var str = '<tr id="'+count+'">' 
						str += '<input type="hidden" name="produtos_listagem_id[]" value="'+ dados[i].id +'" />'
						str += '<input type="hidden" name="produtos_qtde[]" value="'+ dados[i].pivot.qtde +'" />'
						str += '<input type="hidden" name="obsitem[]" value="'+ dados[i].pivot.obsitem +'" />'
						str += '<input type="hidden" name="prvenda[]" value="'+ dados[i].pivot.prvenda +'" />'
						
						if(dados[i].pivot.obsitem == null){
							str += '<td class="text-left">'+ dados[i].descricao+ '</td>'	
						} else {
							str += '<td class="text-left">'+ dados[i].descricao + '<br><small class="obs-item"> ' + dados[i].pivot.obsitem + '</small>' + '</td>'
						}
						str += '<td class="text-center">'+ dados[i].pivot.qtde +'</td>'
						str += '<td class="text-center">'+ dados[i].pivot.prvenda +'</td>'
						str += '<td class="text-center">'+ dados[i].pivot.qtde * dados[i].pivot.prvenda +'</td>'
						str += '<td class="text-center"><button class="btn btn-outline-primary btn-sm btn-fab btn-icon btn-round" type="button" onclick="removerItem('+count+')"><i class="now-ui-icons ui-1_simple-remove"></i></button></td>'
						str += '</tr>';
						
						// $('#total').val(dados[i].pivot.qtde * dados[i].precovenda + parseFloat($('#total').val()));
						
						TotalGeral += dados[i].pivot.qtde * dados[i].pivot.prvenda
						
						// habilita inserir desconto
						$('#desconto').removeAttr("readonly");
						$('.sifrao').removeClass('sifrao');
						
						$('#qtde').val(1);
						$('#listaProd').append(str);
						
						count++;
					}
					desconto = Number(resposta.data.pedido.desconto);
					$('#total').val(TotalGeral - desconto);
					
				}).fail(function(jqXHR, textStatus ) {
					alert("Falha ao listar os dados de entrega: " + textStatus);
				});
			}
			
			// verifica se a forma de pagamento e dinheiro e habilita o campo de troco, se não for deixa desabilitado
			$('#forma_pagamento').on('change',function(ev){
				if($('#forma_pagamento').val() == 'Dinheiro'){
					$('span.sifra-troco').removeClass("sifrao-troco")
					$('.troco').removeAttr('readonly');
				} else {
					$('.troco').attr('readonly', true);
					$('span.sifra-troco').addClass('sifrao-troco');
				}
			});
			
			$(document).ready(function() {
				carregaPrecoProduto();
				
				Number.prototype.toBrl = function () {
					return this.toFixed(2).replace(',', '.');
				};
				
				$('#desconto').val(parseFloat($('#desconto').val()).toBrl());
				$('.troco').val(parseFloat($('.troco').val()).toBrl());	
				$('#prvenda').val(parseFloat($('#prvenda').val()).toBrl());	
				
				
				$('#desconto').mask("#.##0.00", {reverse: true});
				$('.troco').mask("#.##0.00", {reverse: true});
				$('#prvenda').mask("#.##0.00", {reverse: true});
				
				carregaLocalEntrega();
				@if(isset($pedido))
				carregaProdutosGrid('{{$pedido->id}}');
				@endif
				
				// verifica se a forma de pagamento e dinheiro e habilita o campo de troco, se não for deixa desabilitado
				if($('#forma_pagamento').val() == 'Dinheiro'){
					$('span.sifra-troco').removeClass("sifrao-troco")
					$('.troco').removeAttr('readonly');
				} else if($('#forma_pagamento').val() == 'Cartão de Crédito'){
					$('.troco').attr('readonly', true);
					$('span.sifra-troco').addClass('sifrao-troco');
				} else if($('#forma_pagamento').val() == 'Cartão de Débito'){
					$('.troco').attr('readonly', true);
					$('span.sifra-troco').addClass('sifrao-troco');
				}
			});
			
			function removerItem(id){
				var valorTotal = $('#'+ id).children('td');
				valorTotal = valorTotal[3];
				valorTotal = $(valorTotal).text();
				
				valorTotal = Number(valorTotal);
				
				TotalGeral -= valorTotal;
				
				$('#total').val(TotalGeral - desconto);
				
				$('#'+ id).remove()
			}
			
			$('#desconto').on('change',function(ev){
				var total    = Number($('#total').val())
				var desconto_temp = Number($('#desconto').val()).toFixed(2);
				desconto = desconto_temp;
				$('#total').val(TotalGeral - desconto);
			});
			
			// função de carregamento de preço do produto automático ao escolher o produto
			$('#produto_id').on('change',function(ev){
				carregaPrecoProduto();
			});
			
			// Ajax para carregar o preço do produto
			function carregaPrecoProduto(){
				$.ajax({
					url: '{{route('busca.precoproduto')}}' + '/' + $('#produto_id').val(),
					type: "get",
					dataType: "json"
					
				}).done(function(resposta) {
					let dados = resposta.data;    
					$('#prvenda').val(dados[0].precovenda)
					
					
				}).fail(function(jqXHR, textStatus ) {
					alert("Falha ao carregar preço do produto: " + textStatus);
				});
			}
			
		</script>
		@endpush
		@endsection