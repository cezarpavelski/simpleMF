<?php

require(__DIR__.'/../../env.php');

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'name'    => 'Admin',
                'email'    => 'admin@admin.com',
                'password'    => getenv('APP_KEY').hash('sha256', 'senha'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $posts = $this->table('users');
        $posts->insert($data)
              ->save();
    }
}
