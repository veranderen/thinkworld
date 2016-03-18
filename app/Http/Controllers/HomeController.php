<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;  
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Config;
use \Illuminate\Support\Facades\Schema;

class HomeController extends Controller {
    /**
     * 首页
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $index = array();
        $dataList = Config::get('datasource.datafile_list');
        foreach($dataList as $indexName => $detail){
            if (Schema::hasTable($indexName)) {
                $data['name'] = $detail['name'];
                $data['data'] = DB::table($indexName)->select('date', 'open', 'close', 'change', 'pe1', 'dp1')
                                ->orderBy('date', 'desc')->take(3)->get();
                $index[] = $data;
            }
        }
        
        return view('home.index')->with('data', $index);
    }
}