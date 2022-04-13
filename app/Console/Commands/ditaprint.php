<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Log;

class ditaprint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //コマンド名
    protected $signature = 'dita:print {input} {mapType} {userEmail}';

    /**
     * The console command description.
     *
     * @var string
     */
    //コマンドの説明
    protected $description = 'Prints dita topic xml to pdf';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    //コンストラクタ
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    //実行内容
    public function handle()
    {
    try{
        Log::debug('ditaprint is called');
        $dita_path = app_path('dita-ot-3.3.3/bin/dita');
        $mapType = $this->argument("mapType");
        $input = $this->argument("input");
        $usermail = $this->argument("userEmail");

        if(strpos($usermail,'@daitecjp.com')!==false){
            $cmd = 'echo "apache" | sudo -S '  . $dita_path . ' --input=' . storage_path('dita/') . $input . ' --format=' . $mapType . ' --output=' . storage_path('dita/out');
        }else{
            $cmd = 'echo "apache" | sudo -S '  . $dita_path . ' --input=' . storage_path('dita/') . $input . ' --format=' . $mapType . 'w' . ' --output=' . storage_path('dita/out');
        }

        //dd($cmd);

        exec($cmd);

    }catch(exec $e){
        return 1;
    }
  }
}
