<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateLelangStatus extends Command
{
    protected $signature = 'lelang:update-status';
    protected $description = 'Update the status of lelang that have ended';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $listLelang = DB::table('lelang')
            ->where('status_lelang', 1)
            ->where('tanggal_berakhir', '<', now())
            ->get();

        foreach ($listLelang as $lelang) {
            DB::table('lelang')
                ->where('id_lelang', $lelang->id_lelang)
                ->update(['status_lelang' => 2]);
        }

        $this->info('Lelang status updated successfully.');
    }
}
