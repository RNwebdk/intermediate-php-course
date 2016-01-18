<?php

use Phinx\Migration\AbstractMigration;

class SeedUsersTable extends AbstractMigration
{
    public function up()
    {
        $password_hash = password_hash('verysecret', PASSWORD_DEFAULT);

        $this->execute("
            insert into users ( email, password, access_level)
            values
            ('me@here.ca', '$password_hash', '2')
        ");
    }


    public function down()
    {
        $this->execute("
            truncate users
        ");
    }
}
