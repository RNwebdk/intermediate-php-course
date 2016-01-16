<?php
namespace App\Tests;

/**
 * Class PageControllerTest
 * @package App\Tests
 */
class PageControllerTest extends \PHPUnit_Framework_TestCase
{

    protected $request;
    protected $response;
    protected $session;
    protected $blade;
    protected $logger;
    protected $page;

    /**
     * Set things up
     */
    protected function setUp()
    {
        $this->request = $this->getMockBuilder('Http\HttpRequest')
            ->setMethods(null)
            ->setConstructorArgs([[], [], [], [], []])
            ->getMock();

        $this->response = $this->getMockBuilder('Http\HttpResponse')
            ->getMock();

        $this->session = $this->getMockBuilder('App\Session\Session')
            ->getMock();

        $this->blade = $this->getMockBuilder('duncan3dc\Laravel\BladeInstance')
            ->setConstructorArgs(['whatever', 'whatever'])
            ->getMock();

        $monolog = $this->getMockBuilder('Monolog\Logger')
            ->setMethods(null)
            ->setConstructorArgs(['whatever'])
            ->getMock();

        $this->logger = $this->getMockBuilder('App\Logging\Log')
            ->setConstructorArgs([$monolog, $monolog, $monolog])
            ->getMock();

        $this->page = $this->getMockBuilder('App\Models\Page')
            ->getMock();
    }


    /**
     * test showing a valid page
     */
    public function testShowPageWithValidPage()
    {

        $controller = $this->getMockBuilder('App\Controllers\PageController')
            ->setConstructorArgs([
                $this->request,
                $this->response,
                $this->session,
                $this->blade,
                $this->logger,
                $this->page,
            ])
            ->setMethods(['getPageBySlug'])
            ->getMock();

        $controller->method('getPageBySlug')
            ->willReturn(['browser_title' => 'x', 'page_title' => 'x', 'page_content' => 'x']);

        $result = $controller->showPage(['slug' => 'test-page']);

        $actual = get_class($result);
        // if we have a valid slug, the class of the return value should be an PageControllerTest
        $expected = 'App\Tests\PageControllerTest';
        $this->assertEquals($actual, $expected);
    }


    /**
     * test showing a page that does not exist
     */
    public function testShowPageWithInvalidPage()
    {
        $controller = $this->getMockBuilder('App\Controllers\PageController')
            ->setConstructorArgs([
                $this->request,
                $this->response,
                $this->session,
                $this->blade,
                $this->logger,
                $this->page,
            ])
            ->setMethods(['getPageBySlug'])
            ->getMock();

        $controller->method('getPageBySlug')
            ->willReturn(false);

        $result = $controller->showPage(['slug' => 'test-page']);

        $actual = get_class($result);
        // if we have a non-existent slug, the class of the return value should be an PageNotFoundException
        $expected = 'App\Exceptions\PageNotFoundException';
        $this->assertEquals($actual, $expected);
    }

}
