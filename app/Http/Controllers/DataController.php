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
        $dataList = Config::get('datasource.csi_datafile_list');
        foreach($dataList as $indexName => $detail){
            if (!Schema::hasTable($indexName)) {
                $this->createCsiTable($indexName);
            }
            $this->csiSave($detail['fileName'], $indexName);
        }
        
        $dataList = Config::get('datasource.hsi_datafile_list');
        foreach($dataList as $indexName => $detail){
            if (!Schema::hasTable($indexName)) {
                $this->createHsiTable($indexName);
            }
            $this->hsiSave($detail['fileName'], $indexName);
        }
    }
    
    public function csiSave($filename, $tables)
    {
        Excel::load(storage_path('app/data/'.$filename), function($reader) {
            $this->execl_data = $reader->toArray();
        });
        
        $insertData = array();
        foreach($this->execl_data as $key => $value) {
            $result = DB::table($tables)->where('date', $value['date'])->first();

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
        DB::table($tables)->insert($insertData);
    }
    public function hsiSave($filename, $tables) {
        //恒生指数类
        $file = storage_path('app/data/'.$filename); 
        
        $UCS_2LE_data = file_get_contents($file);
        file_put_contents($file , mb_convert_encoding($UCS_2LE_data, 'UTF-8', 'UCS-2LE'));
        
        $handle = fopen($file, "r");
        fgetcsv($handle, 1000, "\t");
        fgetcsv($handle, 1000, "\t");
        
        $value = fgetcsv($handle, 1000, "\t");
        $insertData = array();
        if (is_array($value) && count($value) >0) {
            $datestr = trim($value[0], "\"\t\n\r\0\x0B");
            $date = substr($datestr, 0, 4).'-'.substr($datestr, 4, 2).'-'.substr($datestr, 6, 2);
            
            $result = DB::table($tables)->where('date', $date)->first();
            
            if ($result != '') {
                return;
            }
            $data = array();
            $data['date'] = $date;
            $data['hight'] = trim($value[4], "\"\t\n\r\0\x0B");
            $data['low'] = trim($value[5], "\"\t\n\r\0\x0B");
            $data['close'] = trim($value[6], "\"\t\n\r\0\x0B");
            $data['change'] = trim($value[7], "\"\t\n\r\0\x0B");
            $data['turnover'] = '';
            $data['pe1'] = trim($value[9], "\"\t\n\r\0\x0B");
            $data['dp1'] = trim($value[8], "\"\t\n\r\0\x0B");
            $insertData[] = $data;
        }
        DB::table($tables)->insert($insertData);
        fclose($handle);
    }
    private function createHsiTable($tableName) {
        Schema::create($tableName, function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('date')->unique()->comment('交易日期');
            $table->double('hight', 15, 4)->comment('全日最高');
            $table->double('low', 15, 4)->comment('全日最低');
            $table->double('close', 15, 4)->comment('收盘点位');
            $table->float('change')->comment('涨跌幅百分比');
            $table->float('pe1')->comment('市净率');
            $table->float('dp1')->comment('股息率');
            $table->bigInteger('turnover')->comment('成交额');
        });
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