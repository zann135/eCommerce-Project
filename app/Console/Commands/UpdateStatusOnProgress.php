<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateStatusOnProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status-on-progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $listLelang = DB::table('lelang')
            ->where('status_lelang', 0)
            ->where('tanggal_berakhir', '<=', now())
            ->get();

        foreach ($listLelang as $lelang) {
            DB::table('lelang')
                ->where('id_lelang', $lelang->id_lelang)
                ->update(['status_lelang' => 1]);
        }

        $this->info('Lelang status updated successfully.');
        # refresh the dashboard
        $this->call('cache:clear');
    }
}
