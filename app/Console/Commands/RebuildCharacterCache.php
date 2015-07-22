<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Cache;
use Carbon;
use Lodestone;

class RebuildCharacterCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'character:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

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
        // Clear the cache
        $this->info('Clearing cache...');
        Cache::flush();
        $this->info('Cache cleared.');

        // Get all users
        $users = User::
                    whereNotNull('character_id')
                    ->get();

        $this->info('Rebuilding Character Cache...');

        $this->output->progressStart(count($users));

        foreach($users as $user) {
            $this->info(' '.$user->character_name);

            $lodestone = New Lodestone();
            if($user->character_id) {
                $this->info('Finding character by id...');
                $character = $lodestone->Search->Character($user->character_id);
            } else {
                $this->info('Finding character by character name...');
                $character = $lodestone->Search->Character($user->character_name, 'Moogle');

                if($character) {
                    $user->character_id = $character->id;
                    if($user->save()) {
                        $this->info('Character ID has been set in database.');
                    }
                }
             }

            if(isset($character)) {
                // See if the character name needs updating
                if($character->name !== $user->character_name) {
                    $this->info('Character name needs updating!');
                    $user->character_name = $character->name;
                    if($user->save()) {
                        $this->info('Character name has been updated.');
                    }
                } else {
                    $this->info('Character name has not changed on Lodestone.');
                }

                $this->info('Setting cache values...');

                $expiresAt = Carbon::now()->addDay();
                // Reset the cache values
                    // Set title
                    Cache::put('title-'.$character->id, $character->title, $expiresAt);

                    // Set avatar
                    Cache::put('avatar-'.$character->id, $character->avatar, $expiresAt);

                    // Set portrait
                    Cache::put('portrait-'.$character->id, $character->portrait, $expiresAt);

            } else {
                $this->error('Could not find character '.$user->character_name);
            }



            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }
}
