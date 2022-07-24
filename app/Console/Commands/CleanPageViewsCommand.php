<?php

namespace App\Console\Commands;

use App\Models\PageView;
use Illuminate\Console\Command;

class CleanPageViewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:page-views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the static cleanPageViews method of the PageView model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        PageView::cleanPageViews();
    }
}
