const mix = require('laravel-mix');

mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/contato/contato.js', 'public/js/contato')
    .js('resources/js/cliente/cliente.js', 'public/js/cliente')
    .js('resources/js/enderecos/entrega.js', 'public/js/enderecos')
    .js('resources/js/produtos/produtos.js', 'public/js/produtos')
    .js('resources/js/usuarios/usuarios.js', 'public/js/usuarios')
    .js('resources/js/pedidos/pedidos.js', 'public/js/pedidos')
    .js('resources/js/empresas/empresas.js', 'public/js/empresas')
    .js('resources/js/entregadores/entregadores.js', 'public/js/entregadores');
