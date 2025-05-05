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
            $existingStatus = DB::table('statuses')
                ->where('user_id', $user->id)
                ->first();

            if (!$existingStatus) {
                // No record at all — insert new
                DB::table('statuses')->insert([
                    'user_id' => $user->id,
                    'status' => 'New',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } elseif (is_null($existingStatus->status)) {
                // Record exists but status is null — update it
                DB::table('statuses')
                    ->where('user_id', $user->id)
                    ->update([
                        'status' => 'New',
                        'updated_at' => now(),
                    ]);
            }
            // else: record exists and has a value — do nothing
        }

        $this->info('Statuses updated for users with no status or null status.');
    }

}
