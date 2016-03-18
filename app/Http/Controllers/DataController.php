<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel; 
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Config;
use \Illuminate\Support\Facades\Schema;

class DataController extends Controller {
    private $execl_data;

    /**
     * 首页
     * @param  int  $id
     * @return Response
     */
    public function save()
    {
        $dataList = Config::get('datasource.datafile_list');
        foreach($dataFileList as $indexName => $detail){
            if (!Schema::hasTable($indexName)) {
                $this->createCsiTable($indexName);
            }
            $this->csiSave($detail['fileName'], $indexName);
        }
    }
    
    public function csiSave($filename, $tables)
    {
        Excel::load(storage_path('app/data/'.$filename), function($reader) {
            $this->execl_data = $reader->toArray();
        });
        
        $insertData = array();
        foreach($this->execl_data as $key => $value) {
            $result = DB::table('sse50')->where('date', $value['date'])->first();

            if ($result != '') {
                break;
            }
            $data = array();
            $data['date'] = $value['date'];
            $data['open'] = $value['open'];
            $data['close'] = $value['close'];
            $data['change'] = $value['change'];
            $data['turnover'] = $value['turnover'];
            $data['pe1'] = $value['1pe1'];
            $data['pe2'] = $value['2pe2'];
            $data['dp1'] = $value['1dp1'];
            $data['dp2'] = $value['2dp2'];
            
            $insertData[] = $data;
        }
        if (!Schema::hasTable($tables)) {
            createCsiTable($tables, $tables);
        }
        DB::table($tables)->insert($insertData);
    }
    
    private function createCsiTable($tableName) {
        Schema::create($tableName, function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('date')->unique()->comment('交易日期');
            $table->double('open', 15, 4)->comment('开盘点位');
            $table->double('close', 15, 4)->comment('收盘点位');
            $table->float('change')->comment('涨跌幅百分比');
            $table->float('pe1')->comment('市净率1');
            $table->float('pe2')->comment('市净率2');
            $table->float('dp1')->comment('股息率1');
            $table->float('dp2')->comment('股息率2');
            $table->bigInteger('turnover')->comment('成交额');
        });
    }
}