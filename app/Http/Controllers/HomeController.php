<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;  
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
    private $execl_data;

    /**
     * 首页
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $csi300Data['name'] = "沪深300";
        $csi300Data['data'] = DB::table('csi300')->select('date', 'open', 'close', 'change','pe1','dp1')
                ->orderBy('date', 'desc')->take(5)->get();
        $data[] = $csi300Data;
        
        $sse50Data['name'] = "上证50";
        $sse50Data['data'] = DB::table('sse50')->select('date', 'open', 'close', 'change','pe1','dp1')
                ->orderBy('date', 'desc')->take(5)->get();
        $data[] = $sse50Data;
        
        return view('home.index')->with('data', $data);
    }
}