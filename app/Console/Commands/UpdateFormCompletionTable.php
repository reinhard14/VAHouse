<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateFormCompletionTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update-user-form-completion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create data for user form-completion table for existing users.';

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
        DB::table('users')
            ->join('skillsets', 'users.id', '=', 'skillsets.user_id')
            ->join('references', 'users.id', '=', 'references.user_id')
            ->select('users.id')
            ->distinct()
            ->chunkById(100, function ($users) {
                foreach ($users as $user) {
                    DB::table('user_form_completions')->updateOrInsert(
                        ['user_id' => $user->id],
                        [
                            'is_experience_completed' => 1,
                            'is_reference_completed' => 1,
                            'updated_at' => now(),
                            // Only set created_at if a new record is created
                            'created_at' => DB::raw('IFNULL(created_at, NOW())')
                        ]
                    );
                }
        });

        $this->info('Completion form updated successfully for all existing users.');
    }
}
