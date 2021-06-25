export default {
  name: 'modal-detalhe-item',
  props: {
    item: {
      type: Object,
      default: null
    },
    details: {
      type: Object,
      default: null
    },
  },

  data() {
    return {
      descricaoItem: '',
      qtde: 1,
      tamanho: '',
      preco: 0,
      iditemlista: 0,
      complementos: [], //adicionais
      adicional: [],
      multipleCancelButton: null,
      configMeioaMeio: false, //Aqui vai receber o valor da configuração se o preço da pizza meio a meio é o produto base ou produto mais caro dos meio a meio
      sabores: [], 
      saboresModel: [], //model
      itemsDiversos: [], //sabores diversos recebe todos os itens que são do grupo 1 (pizza)
      observacao: '',
    }
  },

  methods: {
    confirmDetailItem() {
      let adicionalCalc = 0;
      this.adicional.forEach((adc) => {
        adicionalCalc += adc.preco
      })

      let form = {
        iditemlista: this.details ? this.details.iditemlista : 0,
        iditem: this.item.id,
        descricaoItem: this.item.descricao,
        qtde: this.qtde,
        tamanho: this.tamanho,
        adicional: this.adicional,
        sabores: this.sabores,
        observacao: this.observacao,
        preco: this.preco + adicionalCalc,
        acao: this.details ? 'editar' : 'criar'
      }
      this.$emit('details-item', form);
    },

    getItemsPizza(){
      let vm = this;
      const url = $('meta[name=getItemsPizza]').attr('content');
      $.ajax({
        url: `${url}`,
        type: "get",
        dataType: "json"
  
      }).done(function(resposta) {
        const data = resposta.data.produto;
        vm.itemsDiversos = data;

      }).fail(function(jqXHR, textStatus ) {
        alert("Carregamento dos itens lento, recarregue a página!");
      });
    },

    getConfigMeioaMeio(){
      let vm = this;
      const url = $('meta[name=getConfigEmpresa]').attr('content');
      $.ajax({
        url: `${url}`,
        type: "get",
        dataType: "json"
  
      }).done(function(resposta) {
        const data = resposta.config.maiorprecomeioameio;
        vm.configMeioaMeio = data == 1 ? true : false;

      }).fail(function(jqXHR, textStatus ) {
      });
    },

    getAdicionais(id){
      this.complementos[id] = !this.complementos[id] || false;
    },

    checkAdicional(complemento){
      let comp = document.querySelector('#complemento'+complemento.id);
      if(comp.checked){
        this.adicional.push(complemento);
        return
      }
      this.adicional.splice(this.adicional.indexOf(complemento), 1)
    }
  },

  async mounted() {
    this.multipleCancelButton = new Choices('#choices-multiple-remove-button', {
      removeItemButton: true,
      maxItemCount:4,
      searchResultLimit:4,
      renderChoiceLimit:4,
    });

    this.tamanho = this.item.controlatamanho ? 'precomedio' : 'precovenda';

    await this.getItemsPizza();

    // obtem a configuração do item meio a meio
    this.getConfigMeioaMeio();

    if(this.details){
      this.qtde = this.details.qtde
      this.iditemlista = this.details.iditemlista
      this.tamanho = this.details.tamanho
      this.observacao = this.details.observacao
      this.adicional = this.details.adicional
      this.sabores = this.details.sabores
      this.details.adicional.forEach(adicional => {
        (document.querySelector('#complemento'+adicional.id)).checked = true
      });

      this.details.sabores.forEach(sabor => {
        this.saboresModel.push(sabor.id);
      });

      this.multipleCancelButton.setChoices(this.details.sabores.map( sabor => {
        return {
          label: sabor.descricao,
          value: sabor.id,
          selected: true,
        }
      }), 'value', 'label', false);
    }

  },

  watch: {
    // função pra popular o component multi select
    itemsDiversos() {
      this.multipleCancelButton.setChoices(this.itemsDiversos.map( it => {
        let selected = false;
        if(this.item.id == it.id){
          this.saboresModel.push(this.item.id)
          selected = true;
        }

        return {
          label: it.descricao,
          value: it.id,
          selected: selected,

        }
      }), 'value', 'label', false);

    },

    saboresModel(){
      let ids = Object.values(this.saboresModel)
      this.sabores = this.itemsDiversos.filter((it) => ids.includes(it.id) && it.id != this.item.id)

      if(this.configMeioaMeio){
        let maiorPreco = this.item[this.tamanho];
        this.sabores.forEach((sabor) => {
          maiorPreco = sabor[this.tamanho] > maiorPreco ? sabor[this.tamanho] : maiorPreco;
        })

        this.preco = maiorPreco;
      }
    },

    tamanho(){
      setTimeout( () => {
        this.preco = this.item[this.tamanho]
      }, 100)
    },
  },

  template: `
  <div class="modal" id="myModal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center">{{item.descricao}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <h6 class="font-size-sm mb-2">Quantas unidades:</h6>
          <div class="form-group d-flex align-items-center">
            <select class="custom-select w-100" v-model.number="qtde">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>

          <div class="mb-3" v-if="item.controlatamanho">
            <h6 class="font-size-sm mb-2">Tamanho:</h6>
            <select class="form-select" v-model="tamanho">
              <option value="precopequeno">Pequeno - R$ {{item.precopequeno}}</option>
              <option value="precomedio">Médio - R$ {{item.precomedio}}</option>
              <option value="precogrande">Grande - R$ {{item.precogrande}}</option>
            </select>
          </div>

          <div v-if="item.complementos && item.complementos.length != 0">
            <h6 class="font-size-sm mb-0">Adicional</h6>
            <div class="row">
              <ul class="ks-cboxtags mb-0">
                <li v-for="complemento in item.complementos" >
                  <input type="checkbox" v-bind:id="'complemento'+complemento.id" :value="complemento.descricao" @click="checkAdicional(complemento)">
                  <label v-bind:for="'complemento'+complemento.id">{{complemento.descricao}} R$ {{Number(complemento.preco).toFixed(2)}}</label>
                </li>
              </ul>
            </div>
          </div>

          <div class="row d-flex justify-content-start pb-4" v-if="item.saboresdiversos">
            <div class="col-md-12">
              <h6 class="font-size-sm">Sabores <small> Meio a Meio Até 4 sabores</small></h6>
              <select v-model.number="saboresModel" class="form-select" id="choices-multiple-remove-button" placeholder="Selecione até 4 Sabores" multiple>
              </select>
            </div>
          </div>

          <span class="badge badge-info font-size-xs mr-2">Nota</span><span class="font-weight-medium">Observação do Produto: (Opcional)</span></label>
          <textarea v-model="observacao" class="form-control border rounded p-2 mt-1" style="resize: none" name="observacaoitem" placeholder="Descreva aqui uma observação, por ex: Sem Cebola, Sem Alface, etc..." rows="2" id="observacaoitem"></textarea>
          
        </div>

        <div class="modal-footer d-block px-0">
          <div class="row w-100 m-0">
            <div class="col-md-6 mb-1">
              <button type="button" class="btn btn-warning w-100" @click="$emit('cancelar')"data-dismiss="modal">Cancelar <i class="fa fa-times-circle"></i></button>
            </div>
            <div class="col-md-6 mb-1">
              <button type="submit" @click="confirmDetailItem()" class="btn btn-success w-100" data-dismiss="modal">Adicionar Item <i class="fa fa-plus"></i></button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  `
}