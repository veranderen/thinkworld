<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Config;

/*
 * 收集数据类
 */
class DataCollectionController extends Controller {

    public function fileDownload() {
        $dataFileList = Config::get('datasource.datafile_list');
        foreach($dataFileList as $indexName => $detail){
            $Url="ftp://115.29.204.48/webdata/".$detail['fileName'];
            exec("wget -P ".storage_path('app/data/').' '.$Url);
        }
        
    } 
    public function fileRemove() {
        exec("rm -f ".storage_path('app/data/*'));
    } 
    
    
}