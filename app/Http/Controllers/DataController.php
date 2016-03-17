<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel; 
use Illuminate\Support\Facades\DB;

class DataController extends Controller {
    private $execl_data;

    /**
     * 首页
     * @param  int  $id
     * @return Response
     */
    public function save()
    {
        $this->csi300save();
        $this->sse50Save();
    }
    public function csi300save()
    {
        Excel::load(storage_path('app/data/Csi300Perf.xls'), function($reader) {
            $this->execl_data = $reader->toArray();
        });
        
        $insertData = array();
        foreach($this->execl_data as $key => $value) {
            $result = DB::table('csi300')->where('date', $value['date'])->first();

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

        DB::table('csi300')->insert($insertData);
    }
    
    public function sse50Save()
    {
        Excel::load(storage_path('app/data/000016perf.xls'), function($reader) {
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
        DB::table('sse50')->insert($insertData);
    }
}