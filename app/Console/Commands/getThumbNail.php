<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class getThumbNail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ffmpeg:getThumbNail {input}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Thumgnail from movies.';

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
        Log::debug('getThumbNail is called');

        $ffmpeg_path = app_path('ffmpeg\bin/');
        $input = $this->argument("input");
        $dest_path = public_path('blog_videos/');

        $arr = explode('.', $input);
        $output_path = $dest_path . $arr[0] . '.png';

        $cmd = $ffmpeg_path . "ffmpeg -i " . $dest_path . $input . " -ss 1 -vframes 1 -f image2 " . $output_path;
        exec($cmd);

    }
}
