<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos;
use Carbon\Carbon;
use DB;

class ChartController extends Controller
{
  public function getWeekSales(){
    $weekSales = DB::table('pedidos')
              ->select('created_at as datapedido', (DB::raw('sum(total) as somatotal')))
              ->where('created_at', '>=', Carbon::now()->sub('days', 5))
              ->groupBy(DB::raw('date(created_at)'))
              ->orderBy('created_at', 'DESC')
              ->get();
    
    $topProducts = DB::table('pedido_produto')
                  ->select('produtos.descricao', (DB::raw('sum(pedido_produto.qtde) as qtde')))
                  ->leftjoin('pedidos', 'pedido_produto.pedido_id', '=', 'pedidos.id')
                  ->leftjoin('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
                  ->groupBy('produtos.id')
                  ->orderByRaw('sum(pedido_produto.qtde) DESC')
                  ->limit(5)
                  ->get();

    $topClients = DB::table('pedidos')
                ->select('contatos.nome', (DB::raw('count(pedidos.id) as qtde')))
                ->leftjoin('contatos', 'pedidos.contato_id', '=', 'contatos.id')
                ->groupBy('pedidos.contato_id')
                ->orderByRaw('count(pedidos.id) DESC')
                ->limit(5)
                ->get();

    return view('home', compact('weekSales', 'topProducts', 'topClients'));
  }
}
