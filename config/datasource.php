<?php
/*
 * 数据源文件
 * 
 */
return [
    'csi_datafile_list' => [
//        'csi300' => [         //指数名-数据库表名
//            'fileName' => 'Csi300Perf.xls', //下载的文件名
//            'name' => '沪深300',     //指数名称
//        ],
        'sse' => [         
            'fileName' => '000001perf.xls', 
            'name' => '上证指数',    
        ],
        'sse' => [         
            'fileName' => '000001perf.xls', 
            'name' => '上证指数',    
        ],
        'csi300' => [         
            'fileName' => 'Csi300Perf.xls', 
            'name' => '沪深300',    
        ],
        'sse50' => [ 
            'fileName' => '000016perf.xls',
            'name' => '上证50', 
        ],
        'sse180' => [ 
            'fileName' => '000010perf.xls',
            'name' => '上证180', 
        ],
        'sse380' => [ 
            'fileName' => '000009perf.xls',
            'name' => '上证380', 
        ],
        'ssedividend' => [ 
            'fileName' => '000015perf.xls',
            'name' => '上证红利指数', 
        ],
        'csi100' => [ 
            'fileName' => 'Csi903Perf.xls',
            'name' => '中证100', 
        ],
        'csi200' => [ 
            'fileName' => 'Csi904Perf.xls',
            'name' => '中证200', 
        ],
        'csi500' => [ 
            'fileName' => 'Csi905Perf.xls',
            'name' => '中证500', 
        ],
        'csirafi50' => [ 
            'fileName' => 'Csi925Perf.xls',
            'name' => '基本面50', 
        ],
        'csirafi200' => [ 
            'fileName' => '000965perf.xls',
            'name' => '基本面200', 
        ],
        'csirafi400' => [ 
            'fileName' => '000966perf.xls',
            'name' => '基本面400', 
        ],
//        'csirafi600' => [ 
//            'fileName' => 'Csi967Perf.xls',
//            'name' => '基本面600', 
//        ],
    ],
    'hsi_datafile_list' => [
        'hsi' => [         //恒生指数
            'fileName' => 'hsi.csv', //下载的文件名
            'name' => '恒生指数',     //指数名称
        ],
        'hscei' => [       //恒生国企指数
            'fileName' => 'hscei.csv',
            'name' => '恒生国企指数',     
        ],
    ],
];
