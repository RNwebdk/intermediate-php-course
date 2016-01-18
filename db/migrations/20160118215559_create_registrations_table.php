<?php

use Phinx\Migration\AbstractMigration;

class CreateRegistrationsTable extends AbstractMigration
{
    public function up()
    {
        $users = $this->table('registrations');
        $users
            ->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade'])
            ->addColumn('first_name', 'string')
            ->addColumn('last_name', 'string')
            ->addColumn('colour', 'string')
            ->addColumn('comments', 'text')
            ->addColumn('join_list', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['null' => true])
            ->save();
    }

    public function down()
    {
        $this->dropTable('registrations');
    }
}
