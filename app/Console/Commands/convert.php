<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Log;

class convert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:xml  {input}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts HTML to Dita topic xml';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            Log::debug('convert:xml is called');

            //$msxsl_path = app_path() . '\msxsl';
            $input = $this->argument("input");

            //変換元
            $input_path = storage_path('dita/') . $input;

            //出力先
            $output_path = storage_path('dita/') . $input . '.dita';

            //XSL
            $xsl_path = app_path('msxsl/trial.xsl');

            //HTML→ditaへ変換

            $convert_cmd =  'xsltproc '. $xsl_path . ' ' .  $input_path . ' > ' . $output_path;
            exec($convert_cmd);

            //dtdを宣言
            $declaration = '<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE topic PUBLIC "-//OASIS//DTD DITA Topic//EN" "topic.dtd">';

            //出力したファイルをストリームにオープン
            $fp = fopen($output_path, 'c+b');

            //オリジナルをロック
            flock($fp, LOCK_EX);

            //ファイル内容を取得
            $data = stream_get_contents($fp);

            //ポインタを先頭に異動
            rewind($fp);

            //書き込む内容の先頭に宣言文を追加
            $data = $declaration . $data;

            //ファイルに上書き
            $output_file = fwrite($fp, $data);

            //ストリームを解放して閉じる
            fflush($fp);
            flock($fp, LOCK_UN);
            fclose($fp);

            //作成したditaの絶対パス+ファイル名をリターン
            return $output_path;
        }catch(QueryException $e){
            return "";
        }

    }
}
