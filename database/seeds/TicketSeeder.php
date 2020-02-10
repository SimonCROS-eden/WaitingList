<?php

use Illuminate\Database\Seeder;
use App\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::query()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        factory(Ticket::class, 10)->create();
    }
}
