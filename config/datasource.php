<?php
/*
 * 数据源文件
 * 
 */
return [
    'datafile_list' => [
        'csi300' => [         //指数名-数据库表名
            'fileName' => 'Csi300Perf.xls', //下载的文件名
            'name' => '沪深300',     //指数名称
        ],
        'sse50' => [ 
            'fileName' => '000016perf.xls',
            'name' => '上证50', 
        ],
        'csi500' => [ 
            'fileName' => 'Csi905Perf.xls',
            'name' => '中证500', 
        ],
        'csirafi50' => [ 
            'fileName' => 'Csi925Perf.xls',
            'name' => '基本面50', 
        ],
    ],
];
