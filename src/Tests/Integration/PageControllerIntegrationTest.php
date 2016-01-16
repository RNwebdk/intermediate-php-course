<?php
namespace App\Tests;

use App\Controllers\PageController;
use App\models\Page;

class PageControllerIntegrationTest extends BaseIntegrationTest
{


    /**
     * Override setUp in parent and set value in $_SERVER
     */
    public function setUp()
    {
        $_POST['first_name'] = 'Trevor';
        $_POST['last_name'] = 'Sawler';
        $_POST['email'] = 'trevor.sawler@me.com';
        $_POST['verify-email'] = 'trevor.sawler@me.com';
        $_POST['url'] = 'http://www.acme.com';
        $_POST['number'] = '1';
        $_POST['decimal'] = '1.1';
        $_POST['greater-or-less-than-number'] = '5';
        $_POST['ip_address'] = '2.2.2.2';

        parent::setUp();
    }


    public function testGetPageBySlugWithValidSlug()
    {
        $model = new Page();

        $controller = new PageController($this->request, $this->response, $this->session,
            $this->blade, $this->logger, $model);

        $result = $this->run_protected_method($controller, 'getPageBySlug', ['about']);

        $expected = 'About Us';
        $actual = $result['browser_title'];

        $this->assertEquals($actual, $expected);

    }

    public function testGetPageBySlugWithInvalidSlug()
    {
        $model = new Page();

        $controller = new PageController($this->request, $this->response, $this->session,
            $this->blade, $this->logger, $model);

        $result = $this->run_protected_method($controller, 'getPageBySlug', ['bad-slug']);

        $this->assertFalse($result);

    }


    public function testShowHome()
    {
        $model = new Page();

        $controller = new PageController($this->request, $this->response, $this->session,
            $this->blade, $this->logger, $model);

        $result = $result = $this->run_protected_method($controller, 'prettify', ['hello_world']);

    }


    public function testPrettify()
    {
        $controller = new PageController($this->request, $this->response, $this->session,
            $this->blade, $this->logger, $this->page);

        $actual = $this->run_protected_method($controller, 'prettify', ['hello_world']);
        $expected = "Hello World";
        $this->assertEquals($actual, $expected);
    }


    public function testValidateWithValidData()
    {
        $controller = new PageController($this->request, $this->response, $this->session,
            $this->blade, $this->logger, $this->page);

        $rules = [
            'first_name'                  => 'required|min:3|max:100',
            'email'                       => 'email',
            'verify-email'                => 'equalTo:email',
            'number'                      => 'digits',
            'decimal'                     => 'float',
            'greater-or-less-than-number' => 'greaterThan:2|lessThan:6',
            'url'                         => 'url',
            'ip_address'                  => 'ip',
        ];

        $errors = $this->run_protected_method($controller, 'validate', [$rules]);

        $this->assertEmpty(sizeof($errors), 0);

    }


    public function testValidateWithInvalidData()
    {
        $controller = new PageController($this->request, $this->response, $this->session,
            $this->blade, $this->logger, $this->page);

        $rules = [
            'first_name'                  => 'required|min:100',
            'email'                       => 'email|max:1',
            'number'                      => 'float',
            'decimal'                     => 'digits',
        ];

        $errors = $this->run_protected_method($controller, 'validate', [$rules]);

        $this->assertGreaterThan(0, sizeof($errors));

    }
}
