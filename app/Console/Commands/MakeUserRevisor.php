<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserRevisor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presto:MakeUserRevisor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rendi un utente revisore';

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
        $email=$this->ask('Inserisci l \' email dell \'utente che vuoi rendere revisore');
        //quando faccio il comando presto:MakeUserRevisor mi chiede quello che c'è scritto nella funzione ask
        //cioè l'email e la salva in una variabile $email
        $user=User::where('email',$email)->first();
        if(!$user){
            $this->error('utente non trovato');
            return;
        }
        $user ->is_revisor=true;
        $user->save();
        $this->info("L'utente {{$user->name}} è ora revisore");
        return Command::SUCCESS;
    }
}
