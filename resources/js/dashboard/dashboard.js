$(function(){
  var canvasbalcao    = $('#pedidosbalcaomes');
  var balcaoMes       = new Chart(canvasbalcao);

  var canvasloja    = $('#pedidoslojames');
  var lojames       = new Chart(canvasloja);

  // gráfico mensal de vendas do balcão
  function graficobalcao(dia, totaldia){
    balcaoMes.destroy();
    balcaoMes = new Chart(canvasbalcao, {
      type: 'bar',
      data: {
        labels: totaldia,
        datasets: [{
          label: 'Total do dia: R$',
          data: dia,
          barThickness: 100,
          borderRadius: 5,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: false,
            title: {
              display: true,
              text: 'Total por Dia R$',
            }
          },
          x: {
            display: true,
            title: {
              display: true,
              text: 'Dias'
            }
          },
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        plugins: {
          tooltip: {
            usePointStyle: true,
          }
        },
      } 
    });
  }

  // gráfico mensal de vendas da loja
  function graficoloja(dia, totaldia){

    lojames.destroy();
    lojames = new Chart(canvasloja, {
      type: 'bar',
      data: {
        labels: totaldia,
        datasets: [{
          label: 'Total do dia: R$',
          data: dia,
          barThickness: 100,
          borderRadius: 5,
          backgroundColor: [
            'rgba(100, 99, 132, 0.2)',
            'rgba(54, 255, 70, 0.2)',
            'rgba(255, 206, 100, 0.2)',
            'rgba(99, 192, 145, 0.2)',
            'rgba(153, 102, 158, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(155, 99, 132, 1)',
            'rgba(54, 255, 100, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(154, 192, 192, 1)',
            'rgba(176, 80, 158, 1)',
            'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: false,
            title: {
              display: true,
              text: 'Total por Dia R$',
            }
          },
          x: {
            display: true,
            title: {
              display: true,
              text: 'Dias'
            }
          },
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        plugins: {
          tooltip: {
            usePointStyle: true,
          }
        },
      } 
    });
  }

  $('document').ready(function() {
    vendasBalcaoMensal();
    vendasLojaMensal();
  });

  function vendasBalcaoMensal(){
    $.ajax({
      url: '/vendas-balcao-mensal',
      type: 'get',
      dataType: "json",
      success: function (data) {
        // console.log(data)
        var totaldia = []
        var dia = []
        for(var i in data){
          totaldia.push(data[i].totaldia);
          dia.push(data[i].dia);
        }
        graficobalcao(totaldia, dia);
      },
      error: function (data) {
        alert('error');
      },
    });
  }

  function vendasLojaMensal(){
    $.ajax({
      url: '/vendas-loja-mensal',
      type: 'get',
      dataType: "json",
      success: function (data) {
        // console.log(data)
        var totaldia = []
        var dia = []
        for(var i in data){
          totaldia.push(data[i].totaldia);
          dia.push(data[i].dia);
        }
        graficoloja(totaldia, dia);
      },
      error: function (data) {
        alert('error');
      },
    });
  }
});