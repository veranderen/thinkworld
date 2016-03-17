<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
/*
 * 收集数据类
 */
class DataCollectionController extends Controller {

 
    public function fileDownload() {
        $csi300Url="ftp://115.29.204.48/webdata/Csi300Perf.xls";
        exec("wget -P ".storage_path('app/data/').' '.$csi300Url);
        
        $sse50Url="ftp://115.29.204.48/webdata/000016perf.xls";
        exec("wget -P ".storage_path('app/data/').' '.$sse50Url);
    } 
    public function fileRemove() {
        exec("rm -f ".storage_path('app/data/*'));
    } 
}