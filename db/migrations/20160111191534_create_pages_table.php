<?php

use Phinx\Migration\AbstractMigration;

class CreatePagesTable extends AbstractMigration
{
    public function up()
    {
        $users = $this->table('pages');
        $users->addColumn('browser_title', 'string')
            ->addColumn('page_content', 'text')
            ->addColumn('page_title', 'string')
            ->addColumn('slug', 'string', ['default' => ''])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['null' => true])
            ->addIndex(['slug'], ['unique' => true])
            ->save();
    }

    public function down()
    {
        $this->dropTable('pages');
    }
}
