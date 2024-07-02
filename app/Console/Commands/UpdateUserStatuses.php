<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateUserStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update-user-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update statuses for all existing users.';

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
            DB::table('statuses')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'status' => 'New',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->info('Statuses updated successfully for all users.');
    }
}
