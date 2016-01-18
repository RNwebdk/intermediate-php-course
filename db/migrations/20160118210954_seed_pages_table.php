<?php

use Phinx\Migration\AbstractMigration;

class SeedPagesTable extends AbstractMigration
{
    public function up()
    {
        $this->execute("
            insert into pages (browser_title, page_content, page_title, slug)
            values
            ('About Us', '<h1>About Us</h1><p>All about this company.</p>', 'About Us', 'about')
        ");

    }
}
