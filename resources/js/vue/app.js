Vue.component('modal-detalhe-item', require('./components/modalComplementos.js').default);
import { forEach } from 'lodash';
import money from 'v-money'
import axios from 'axios'
import 'vue-search-select/dist/VueSearchSelect.css'
import { ModelSelect } from 'vue-search-select'
Vue.use(money, {precision: 4})
Vue.component('vue-search-select', ModelSelect);

new Vue({
  el:'#app',
  filters: {
    currency(value){
      return Intl.NumberFormat('pt-br', {
        style: 'currency',
        currency: 'BRL'
      }).format(value)
    }
  },

  data: {
    search: null,
    items: [],
    itemsPedido: [],
    listagemContatos: [], //lista todos os contatos ativos na aba de contatos
    contatoId: null,
    contato: {
      text: '',
      value: ''
    },
    endereco_id: null,
    adicionaisItem: [],
    enderecosContato: [],
    showModal: false,
    item: null,
    showformcliente: false,
    novoenderecoentrega: false,
    details: null,
    totalItemsPedido: 0,
    totalMonetarioPedido: 0,
    totalItemLista: 0,
    editId: null,
    money: {
      decimal: ',',
      thousands: '.',
      // prefix: 'R$ ',
      // suffix: ' #',
      precision: 2,
      masked: false /* doesn't work with directive */
    },
    pagamento: {
      forma_pagamento: 'Dinheiro',
      local_pagamento: 'Local de Entrega',
      desconto: 0,
      total: 0,
      valortroco: 0,
      observacao: '',
      taxaentrega: 0,
    },
    novocliente: {
      nome: '',
      documento: '',
      telefone: '',
      endereco: '',
      numero: '',
      cidade: '',
      cep: '',
      telefone_entrega: '',
      bairro: '',
      observacao: '',
    },
  },

  methods: {
    consultaItem: _.debounce(function() {
      let vm = this;
      const url = $('meta[name=searchUrl]').attr('content');
      $.ajax({
        url: `${url}/${this.search}`,
        type: "get",
        dataType: "json"
      }).done(function(resposta) {
        const data = resposta.data.produto;
        vm.items = data;

      }).fail(function(jqXHR, textStatus ) {
        alert("Falha ao listar os dados: " + textStatus);
      });
    }, 250),

    // obtem os dados das configurações da empresa, e passa o preço da entrega
    getTaxaEntrega(){
      let vm = this;
      const url = $('meta[name=getConfigEmpresa]').attr('content');
      $.ajax({
        url: `${url}`,
        type: "get",
        dataType: "json"
  
      }).done(function(resposta) {
        const data = resposta.config.valorentrega;
        vm.pagamento.taxaentrega = Number(data).toFixed(2);

      }).fail(function(jqXHR, textStatus ) {
      });
    },

    // obtem todos os itens na listagem na aba de pedido
    getItems() {
      let vm = this;
      const url = $('meta[name=searchUrl]').attr('content');
      $.ajax({
        url: `${url}`,
        type: "get",
        dataType: "json"
  
      }).done(function(resposta) {
        const data = resposta.data.produto;
        vm.items = data;

      }).fail(function(jqXHR, textStatus ) {
        alert("Carregamento dos itens lento, recarregue a página!");
      });
    },

    // lista os contatos na aba de contatos do pedido
    getContatos() {
      let vm = this;
      const url = $('meta[name=getContatos]').attr('content');
      $.ajax({
        url: `${url}`,
        type: "get",
        dataType: "json"
  
      }).done(function(resposta) {
        const data = resposta.data.contatos;
        vm.listagemContatos = data;
      }).fail(function(jqXHR, textStatus ) {
        alert("Falha ao carregar os Clientes!");
      });
    },

    // faz consulta via ajax por grupo na aba de montagem de cardápio.
    getItemsGroup(id) {
      let vm = this;
      const url = $('meta[name=getItemFromGroup]').attr('content');
      $.ajax({
        url: `${url}/${id}`,
        type: "get",
        dataType: "json"
  
      }).done(function(resposta) {
        const data = resposta.data.produto;
        vm.items = data;

      }).fail(function(jqXHR, textStatus ) {
        alert("Falha ao listar os dados: " + textStatus);
      });
    },

    // obtem o endereço do cliente selecionado na aba de cliente e manda os endereços para a aba de entrega
    getEnderecoCliente(id) {
      let vm = this;
      const url = $('meta[name=getEnderecoCliente]').attr('content');
      $.ajax({
        url: `${url}/${id}`,
        type: "get",
        dataType: "json"
  
      }).done(function(resposta) {
        const data = resposta.data.enderecos;
        vm.enderecosContato = data
                
      }).fail(function(jqXHR, textStatus ) {
        alert("Falha ao listar os dados: " + textStatus);
      });
    },

    openModalItem(id, details = null) {
      this.item = this.items.find( (item) => item.id == id);

      if(details){
        this.details = details;
      }

      this.showModal = true;
    },

    // função responsável por desmontar o modal ao clicar no botão fechar
    cancelar(){
      this.showModal = false;
      this.details = null;
    },

    //calcula o total dos itens da listagem
    calculaItems(){
      this.totalItemsPedido = 0
      this.totalMonetarioPedido = 0
      
      this.itemsPedido.forEach((itempedido, index) => {
        let calculoTotalItem = itempedido.preco * itempedido.qtde
        this.totalItemsPedido += itempedido.qtde
        this.totalMonetarioPedido += calculoTotalItem
        this.itemsPedido[index]['totalItemLista'] = calculoTotalItem
      })
    },

    // lança item do modal a listagem de pedido serve também para edição
    lancarItem(form) {
      this.showModal = false
      this.details = null

      if(form.acao == 'criar'){
        form.iditemlista = this.itemsPedido.length == 0 ? 1 : this.itemsPedido.length + 1
        this.itemsPedido.push(form)
        this.calculaItems()
        return
      }

      let it = this.itemsPedido.find( (item) => item.iditemlista == form.iditemlista)
      this.itemsPedido[this.itemsPedido.indexOf(it)] = form
      this.calculaItems()
    },

    // remove um item da listagem do pedido
    removeItem(id) {
      let itp = this.itemsPedido.find( (item) => item.iditemlista == id)

      if(itp){
        this.itemsPedido.splice(this.itemsPedido.indexOf(itp), 1);
        this.calculaItems()
      }
    },

    concluirPedido(){
      let vm = this;
      const url = $('meta[name=processaPedidoBalcao]').attr('content');
      const urlImprimir = $('meta[name=imprimir]').attr('content');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      Swal.fire({
        title: 'Concluir Pedido',
        text: "Você quer realmente concluir este pedido?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4caf50',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, Concluir!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `${url}`,
            type: "POST",
            data: {
              itemsPedido: this.itemsPedido,
              pagamento: this.pagamento,
              contato_id: this.contatoId,
              endereco_id: this.endereco_id,
              novocliente: this.novocliente
            },
            dataType: "json"
      
          }).done(function(response) {
            if(response.resposta.error){
              Swal.fire(
                'Falha ao Registrar Pedido',
                response.resposta.error,
                'error'
              )
              return
            }
            Swal.fire({
              title: 'Pedido Concluído!',
              text: response.resposta.success + ' Gostaria de imprimir este pedido?',
              icon: 'success',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Imprimir!'
            }).then((result) => {
              if (result.isConfirmed) {
                window.open(urlImprimir + '/' + response.resposta.pedidoid, '_blank');
                location.reload();
              }
              location.reload();
            })
          }).fail(function(jqXHR, textStatus ) {
            console.log('erro', textStatus);
          });  
        }
      })
    },

    editarPedido(id){
      let vm = this;
      const url = $('meta[name=editarPedido]').attr('content');
      axios
      .get(`${url}/${id}`)
      .then(
        function(resposta) {
          let data = resposta.data.pedido
          vm.contato = resposta.data.pedido.contato_id

          data.itenspedidos.forEach((itempedido) => {
            data.complementositenspedido.forEach((complemento) => {
              vm.adicionaisItem.push(complemento)
            })
            vm.itemsPedido.push(itempedido)
            // complemento.produto_id == itempedido.produto_id
          })
        }
      )
      .catch(response => (this.info = response))
    },
  },

  computed: {
    calculaPedido() {
      this.pagamento.total = (this.totalMonetarioPedido + parseFloat(this.pagamento.taxaentrega)) - parseFloat(this.pagamento.desconto)
      return this.pagamento.total
    },
  },

  watch: {
    contato(){
      if(this.contato != ""){
        this.contatoId = this.contato.value
        this.getEnderecoCliente(this.contatoId)
      }
    },

    // contatoId(){
    //   if(this.contatoId){
    //     // this.contato = this.listagemContatos.find((contato) => contato.id == this.contatoId)
    //     // console.log(this.contatoId, this)
    //   }
    // }
  },
  
  mounted() {
    setTimeout( () => {
      this.getItems()
      this.getContatos()
      this.getTaxaEntrega()
    }, 700)
    
    // if($('#editId').val() != null){
    //   let id = this.editId = $('#editId').val();
    //   this.editarPedido(id)
    // }    
    
  },
})
