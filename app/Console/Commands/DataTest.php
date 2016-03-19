<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DataCollectionController;

class DataTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datatest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'datatest';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('DataTest run');
        // 执行一些任务...
        $dataCollection = new DataCollectionController();
        $dataCollection->fileRemove();
        $dataCollection->fileDownload();

        $data = new DataController();
        $result = $data->save();
        $this->comment($result);
    }
}
