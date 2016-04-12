<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Config;

/*
 * 收集数据类
 */
class DataCollectionController extends Controller {

    public function fileDownload() {
        $dataFileList = Config::get('datasource.csi_datafile_list');
        foreach($dataFileList as $indexName => $detail){
            $Url="ftp://115.29.204.48/webdata/".$detail['fileName'];
            exec("wget -O ".storage_path('app/data/').$detail['fileName'].' '.$Url);
        }
        
        $dataFileList = Config::get('datasource.hsi_datafile_list');
        foreach($dataFileList as $indexName => $detail){
            $filename = 'idx_'.(int)date('d').date('M').(int)date('y').'.csv';
            $Url="http://sc.hangseng.com/gb/www.hsi.com.hk/HSI-Net/static/revamp/contents/en/indexes/report/$indexName/";
            exec("wget -O ".storage_path('app/data/').$detail['fileName'].' '.$Url.$filename);
        }
    } 
    public function fileRemove() {
        exec("rm -f ".storage_path('app/data/*'));
    } 
}