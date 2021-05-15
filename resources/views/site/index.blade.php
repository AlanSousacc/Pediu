<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pediu App</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href='{{asset('assets/vendor-site/bootstrap/css/bootstrap.min.css')}}' rel="stylesheet">
  <link href='{{asset('assets/vendor-site/icofont/icofont.min.css')}}' rel="stylesheet">
  <link href='{{asset('assets/vendor-site/boxicons/css/boxicons.min.css')}}' rel="stylesheet">
  <link href='{{asset('assets/vendor-site/venobox/venobox.css')}}' rel="stylesheet">
  <link href='{{asset('assets/vendor-site/remixicon/remixicon.css')}}' rel="stylesheet">
  <link href='{{asset('assets/vendor-site/owl.carousel/assets/owl.carousel.min.css')}}' rel="stylesheet">
  <link href='{{asset('assets/vendor-site/aos/aos.css')}}' rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href='{{asset('assets/css/stylesite.css')}}' rel='stylesheet' />
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="#"><span>Pediu App</span></a></h1>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="#about">Sobre Nós</a></li>
          <li><a href="#features">Recursos</a></li>
          <li><a href="#gallery">Galeria</a></li>
          <li><a href="#gallery">Perguntas Frequentes</a></li>
          <li><a href="#team">Planos</a></li>
          <li><a href="#contact">Contato</a></li>
          <li><a href="{{@Auth::check() ? route('home') : route('login')}}">Área do Cliente</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row">
        <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out">
            <h1><span>PediuApp</span> A sua plataforma de pedidos online</h1>
            <h2>Um portal desenvolvido para você obter a experiência de venda online!</h2>
            <div class="text-center text-lg-left">
              <a href="#about" class="btn-get-started scrollto">Conheça Agora</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
          <img src="assets/img/site/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch" data-aos="fade-right">
            {{-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a> --}}
            <img src="assets/img/site/img/sobre.png" class="img-fluid animated" alt="">
          </div>
          {{-- <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
            <img src="assets/img/site/img/hero-img.png" class="img-fluid animated" alt="">
          </div> --}}

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
            <h3>Sobre o Pediu App</h3>
            <p>Somos um portal desenvolvido para que você tenha a experiência de venda online, com um cardápio disponível a seus clientes através de uma URL amigável, e o mais legal, pode ser instalado no dispositivo móvel de seu cliente!</p>
            <p>Nós disponibilizamos um aplicativo web totalmente responsivo, sem qualquer necessidade de instalação por parte do cliente, portanto, apenas divulgando o link nas redes sociais, seu cliente acessa e realiza pedidos facilmente em sua joja. Seu cliente pode visualizar o cardápio criado por você lojista, de forma agradável através de smartphone ou computador.</p>
            <h3>Notifique seu cliente em tempo real através do WhatsApp</h3>
            <p>Seu cliente acessa seu menu e realiza o pedido que desejar, ao final será enviado um pedido para o seu painel de pedidos e também para o WhatsApp do lojista. Ao receber o pedido de seus clientes, a cada nova fase você pode notifica-lo, para que ele saiba que o seu pedido está sendo processado, as fases são:</p>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon"><i class="bx bx-message-square-check"></i></div>
              <h4 class="title"><a href="">Confirmar Pedido:</a></h4>
              <p class="description">Indica que o pedido de seu cliente será confirmado.</p>
            </div>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon"><i class="bx bx-dish"></i></div>
              <h4 class="title"><a href="">Em Andamento:</a></h4>
              <p class="description">O pedido de seu cliente está sendo preparado.</p>
            </div>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon"><i class="bx bx-cycling"></i></div>
              <h4 class="title"><a href="">Saiu para Entrega:</a></h4>
              <p class="description">O pedido está em transito.</p>
            </div>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon"><i class="bx bx-check-double"></i></div>
              <h4 class="title"><a href="">Finalizado:</a></h4>
              <p class="description">Indica que o pedido foi finalizado e entregue com sucesso!</p>
            </div>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon"><i class="bx bx-block"></i></div>
              <h4 class="title"><a href="">Cancelado:</a></h4>
              <p class="description">Houve algum problema ao processar o pedido de seu cliente, você pode descrever o que houve!</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>RECURSOS</h2>
          <p>Veja os Recursos</p>
        </div>

        <div class="row" data-aos="fade-left">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
              <i class="ri-smartphone-line" style="color: #ffbb2c;"></i>
              <h3><a href="">suporte em Smartphones</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
              <i class="ri-link-m" style="color: #5578ff;"></i>
              <h3><a href="">Link Amigável</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="150">
              <i class="ri-alarm-warning-line" style="color: #e80368;"></i>
              <h3><a href="">Notificação de pedidos</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
              <i class="ri-line-chart-fill" style="color: #e361ff;"></i>
              <h3><a href="">Estatística do seu negócio</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="250">
              <i class="ri-printer-line" style="color: #47aeff;"></i>
              <h3><a href="">Impressão de Pedidos</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
              <i class="ri-gallery-upload-line" style="color: #ffa76e;"></i>
              <h3><a href="">Atualizações constantes</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="350">
              <i class="ri-whatsapp-line" style="color: #11dbcf;"></i>
              <h3><a href="">Notificação WhatsApp</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="400">
              <i class="ri-chat-3-fill" style="color: #4233ff;"></i>
              <h3><a href="">Suporte Ativo</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Details Section ======= -->
    <section id="details" class="details">
      <div class="container">

        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img src="assets/img/site/img/details-1.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-4" data-aos="fade-up">
            <h3>Detalhamento dos Recursos</h3>
            <p class="font-italic">
              Aqui vamos explicar as vantagens de contratar o PediuApp
            </p>
            <ul>
              <li><i class="icofont-check"></i> Suporte em Smartphones: Você proporciona a seu cliente uma comodidade de fazer pedidos online, sem necessidade de fazer ligação.</li>
              <li><i class="icofont-check"></i> Link Amigável: Compartilhe o seu negócio nas suas redes sociais de forma fácil e simples, com o link da sua loja.</li>
              <li><i class="icofont-check"></i> Notificação de Pedidos: Receba minuto a minuto todos novos pedidos no seu painel administrativo.</li>
              <li><i class="icofont-check"></i> Estatísticas: Com o painel de dashboard vc monitora o progreso da sua loja ou do seu balcão.</li>
              <li><i class="icofont-check"></i> Impressão de Pedidos: Emita uma impressão de pedidos para sua cozinha.</li>
            </ul>
          </div>
        </div>

        <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img src="assets/img/site/img/details-2.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
            <ul>
              <li><i class="icofont-check"></i> Atualizações Constantes: Você nos direciona para atender suas demandas e fazer seu negócio prosperar, com as atualizações constante, o sistema está sempre evoluindo.</li>
              <li><i class="icofont-check"></i> Notificação Whatsapp: Notifique seu cliente via whatsapp a cada novo status do pedido, assim ele tranquilo, enquanto você prepara-o.</li>
              <li><i class="icofont-check"></i> Notificação de Pedidos: Receba minuto a minuto todos novos pedidos no seu painel administrativo.</li>
              <li><i class="icofont-check"></i> Suporte Ativo: Temos um canal de suporte de segunda a sexta feira, pronto para atender você!</li>
            </ul>
          </div>
        </div>

      </div>
    </section><!-- End Details Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Galeria</h2>
          <p>Veja nosso sistema em fotos</p>
        </div>

        <div class="row no-gutters" data-aos="fade-left">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
              <a href="assets/img/site/img/gallery/dashboard.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/dashboard.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="150">
              <a href="assets/img/site/img/gallery/pedidos.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/pedidos.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="450">
              <a href="assets/img/site/img/gallery/mudar-status-pedido.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/mudar-status-pedido.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="450">
              <a href="assets/img/site/img/gallery/detalhe-pedido-painel.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/detalhe-pedido-painel.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
              <a href="assets/img/site/img/gallery/listagem-pedidos-painel.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/listagem-pedidos-painel.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
              <a href="assets/img/site/img/gallery/configuracoes.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/configuracoes.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
              <a href="assets/img/site/img/gallery/pedidos-balcao.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/pedidos-balcao.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
              <a href="assets/img/site/img/gallery/caixa.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/caixa.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
              <a href="assets/img/site/img/gallery/impressao.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/impressao.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
              <a href="assets/img/site/img/gallery/produtos.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/produtos.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
              <a href="assets/img/site/img/gallery/produto.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/produto.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="250">
              <a href="assets/img/site/img/gallery/carrinho.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/carrinho.png" alt="Carrinho" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="300">
              <a href="assets/img/site/img/gallery/checkout.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/checkout.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="350">
              <a href="assets/img/site/img/gallery/meus-pedidos.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/meus-pedidos.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="400">
              <a href="assets/img/site/img/gallery/detalhe-pedido.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/detalhe-pedido.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="450">
              <a href="assets/img/site/img/gallery/loja.png" class="venobox" data-gall="gallery-item">
                <img src="assets/img/site/img/gallery/loja.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>F.A.Q</h2>
          <p>Perguntas Frequentes</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-1">Posso usar minha impressora térmica? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                <p>
                  Sim! Temos suporte a vários tipos de impressão.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-2" class="collapsed">Quem pode usar essa ferramenta? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-parent=".faq-list">
                <p>
                  É indicado para todos os negócios que atendam com delivery ou retirada no local, com pandemia, você pode dar mais segurança a seus clientes.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-3" class="collapsed">Vocês realizam a entrega dos produtos?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                <p>
                  Não! Nossa plataforma é desenvolvida para apoiar lojistas, eles são responsáveis por fazer a entrega dos pedidos. Nossa plataforma disponibiliza acesso aos lojistas para disponibilizar cardápio e produtos aos seus clientes, nesse momento a ferramenta proporciona o recebimento dos pedidos, tornando o processo de produção mais prático e organizado.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-4" class="collapsed">Quem fica responsável pela divulgação? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-parent=".faq-list">
                <p>
                  O próprio estabelecimento é responsável pela divulgação, afinal, ninguém melhor que você para saber onde estão seus clientes. Mas, você pode, por exemplo, enviar o seu link público do Pediu App por e-mail, Whatsapp e disponibilizar nas redes sociais. Além disso, criar uma lista de transmissão no Whatsapp e divulgar aos seus contatos pode ser uma ótima ideia! Estamos também preparando um blog para ajudar com dicas para seu negócio evoluir cada vez mais.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-5" class="collapsed">Tem algum meio de pagamento integrado? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-parent=".faq-list">
                <p>
                  Por enquanto não, mas em breve teremos novidades nesse sentido. Inclusive, suas sugestões e feedbacks são muito bem vindos! Faça um comentário escrevendo para contato@pediuapp.com.br
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Preços</h2>
          <p>Conheça nossos preços</p>
        </div>

        <div class="row" data-aos="fade-left">
          <div class="col-lg-4 col-md-4 mt-4 mt-md-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="200">
              <h3>PLANO MENSAL</h3>
              <h4><sup>R$</sup>129<span> / mês</span></h4>
              <ul>
                <li>Assinatura de 30 dias</li>
                <li>Pedidos Ilimitados</li>
                <li>Itens Ilimitados</li>
                <li>Fotos nos itens</li>
                <li>Adicione Logo Marca</li>
                <li>Página de Contato</li>
                <li>Cupom de desconto</li>
                <li class="na">Trabalho de fotos Nos itens</li>
              </ul>
              <div class="btn-wrap">
                <a href="{{route('novo.cliente', 1)}}" class="btn-buy">Contratar</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 mt-4 mt-lg-0">
            <div class="box featured" data-aos="zoom-in" data-aos-delay="300">
              <h3>PLANO TRIMESTRAL</h3>
              <h4><sup>R$</sup>297<span> / trimestre</span></h4>
              <ul>
                <li>Assinatura de 90 dias</li>
                <li>Pedidos Ilimitados</li>
                <li>Itens Ilimitados</li>
                <li>Fotos nos itens</li>
                <li>Adicione Logo Marca</li>
                <li>Página de Contato</li>
                <li>Cupom de desconto</li>
                <li class="na">Trabalho de fotos Nos itens</li>
              </ul>
              <div class="btn-wrap">
                <a href="{{route('novo.cliente', 2)}}" class="btn-buy">Contratar</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="400">
              <span class="advanced">Advanced</span>
              <h3>Plano ANUAL</h3>
              <h4><sup>R$</sup>948<span> / ano</span></h4>
              <ul>
                <li>Assinatura de 365 dias</li>
                <li>Pedidos Ilimitados</li>
                <li>Itens Ilimitados</li>
                <li>Fotos nos itens</li>
                <li>Adicione Logo Marca</li>
                <li>Página de Contato</li>
                <li>Cupom de desconto</li>
                <li>Trabalho de fotos nos itens</li>
              </ul>
              <div class="btn-wrap">
                <a href="{{route('novo.cliente', 3)}}" class="btn-buy">Contratar</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contato</h2>
          <p class="">Entre em Contato Conosco</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
            <div class="info">

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <a href="emailto:contato@pediuapp.com.br">contato@pediuapp.com.br</a>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Whatsapp:</h4>
                <a href="http://api.whatsapp.com/send?1=pt_BR&phone=5516991793351&text=Ol%C3%A1!">(16) 99179-3351</a>
              </div>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy;  <strong><span>PEDIUAPP</span></strong> Todos os Direitos Reservados
      </div>
      <div class="credits">
        Desenvolvido por <a href="#">ACPTI</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src='{{asset('assets/vendor-site/jquery/jquery.min.js')}}'></script>
  <script src='{{asset('assets/vendor-site/bootstrap/js/bootstrap.bundle.min.js')}}'></script>
  <script src='{{asset('assets/vendor-site/jquery.easing/jquery.easing.min.js')}}'></script>
  <script src='{{asset('assets/vendor-site/php-email-form/validate.js')}}'></script>
  <script src='{{asset('assets/vendor-site/venobox/venobox.min.js')}}'></script>
  <script src='{{asset('assets/vendor-site/waypoints/jquery.waypoints.min.js')}}'></script>
  <script src='{{asset('assets/vendor-site/counterup/counterup.min.js')}}'></script>
  <script src='{{asset('assets/vendor-site/owl.carousel/owl.carousel.min.js')}}'></script>
  <script src='{{asset('assets/vendor-site/aos/aos.js')}}'></script>

  <!-- Template Main JS File -->
  {{-- <script src="assets/js/main.js"></script> --}}
  <script src='{{asset('js/main/main.js')}}'></script>

</body>

</html>