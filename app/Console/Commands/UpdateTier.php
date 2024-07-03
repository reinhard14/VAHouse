<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateTier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update-user-tiers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update tiers for all existing users.';

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
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            DB::table('tiers')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'tier' => 'Tier 1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->info('Tier updated successfully for all users.');
    }
}
