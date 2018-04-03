<?php

use Phinx\Migration\AbstractMigration;

class CreateTableUsers extends AbstractMigration
{

    public function up()
    {
        $this->execute("
            CREATE TABLE `users` (
                `id` int(15) NOT NULL auto_increment,
                `name` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `password` varchar(255) NOT NULL,
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY  (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
        ");
    }

    public function down() {
		$this->execute("DROP TABLE IF EXISTS users;");
	}

}
