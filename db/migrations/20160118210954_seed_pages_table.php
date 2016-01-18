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

        $this->execute("
            insert into pages (browser_title, page_content, page_title, slug)
            values
            ('Worldwide Tourism', '<p>Here is the content for the home page</p>', 'Welcome to Worldwide Tourism', 'home')
        ");

        $this->execute("
            insert into pages (browser_title, page_content, page_title, slug)
            values
            ('Test Page', '<p>This content is served from the DB</p>', 'Test Page', 'test-page')
        ");
    }

    public function down()
    {
        $this->execute("
            truncate table pages
        ");
    }
}
