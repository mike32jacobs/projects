<?php

namespace App\Commands;

use Faker\Factory;

class AppCommand extends Command
{

    public function fresh() 
    {
        $this->migrate();
        $this->seedPlayers();
        $this->seedGames();
        $this->seedChoices();

    }

    public function clearTables() 
    {
        $this->app->db()->dropTable('players');
        $this->app->db()->dropTable('games');
        $this->app->db()->dropTable('choices');

        dump('All tables have been dropped.');


    }

    public function migrate(){
        $this->app->db()->createTable('players', [
            'name' => 'varchar(16)',
        ]);

        
        $this->app->db()->createTable('games', [
            'winning_score' => 'tinyint(3)',
            'max_count' => 'tinyint(3)',
            'winner' => 'int', //player_id
            'player1_id'=> 'int',
            'player2_id'=> 'int',
            'timestamp'=> 'timestamp',
            'game_over'=>'boolean'
        ]);

        $this->app->db()->createTable('choices', [
            'player_id' => 'int',
            'game_id' => 'int',
            'total'=>'int',
            'choice' => 'int', //thi will be an add 1 or add 2
        ]);
    }

    public function seedPlayers() 
    {
        // Create a computer player
        $this->app->db()->insert('players',[
            'name'=>'computer'
        ]);
        // Create two Players
        for($i =2; $i<4;$i++){
            $this->app->db()->insert('players',[
                'name'=>'player'.$i
            ]);
        }
        dump('Players table has been seeded.');
    }
    public function seedGames() 
    {
        $faker = Factory::create();

        // Create three games
        for($j =0; $j<3;$j++){
            $this->app->db()->insert('games',[
                'winning_score'=>21,
                'max_count'=>2,
                'winner'=> 2, #Player 2 will win all seeded games
                'player1_id'=>($j % 2 == 0) ? 1 : 2, # Alternate between player 1 and 2
                'player2_id'=>($j % 2 == 0) ? 2 : 1, # Alternate between player 2 and 1,
                'timestamp'=> $faker->dateTimeBetween('-'.$j.' days','-'.$j.' days')->format('Y-m-d H:m:s'),
                'game_over'=>true
            ]);
        } 
        dump('Games table has been seeded.');
    }
    public function seedChoices() 
    {
        for($i =1; $i<4;$i++){
            // Create choices
            for($k =1; $k<(22/$i);$k++){
                $this->app->db()->insert('choices',[
                'player_id'=>($k % 2 == 0) ? 1 : 2, # Alternate between computer and player 2
                'game_id'=> $i,
                'total'=>$i*$k,
                'choice'=>$i
            ]);
            }
        }
        dump('choices table has been seeded.');
        
    }
}