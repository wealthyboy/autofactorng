<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class ResizeFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resize:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $path = public_path('images/prodcts');
        $files = File::allFiles($path);

        foreach ($files as $file) {
            $canvas = \Image::canvas(600, 600);
            $image = \Image::make($file)->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file =  basename($file);
            $canvas->insert($image, 'center');
            $canvas->save(
                public_path('images/products/l/' . $file)
            );

            //echo  basename($file);
        }
    }
}
