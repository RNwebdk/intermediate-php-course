<?php
namespace App\Tests;
use App\Renderers\BladeRenderer;
use App\Session\NativeSession;
use Http\HttpRequest;
use Http\HttpResponse;
use App\Exceptions\PageNotFoundException;

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
        require __DIR__ . '/../../../vendor/autoload.php';

        $this->request = new HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);

        $this->response = $this->getMockBuilder('Http\HttpResponse')
            ->getMock();

        $this->session = new NativeSession();

        $this->blade = $this->getMockBuilder('App\Renderers\BladeRenderer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->logger = $this->getMockBuilder('App\Logging\Log')
            ->disableOriginalConstructor()
            ->getMock();

        $this->page = $this->getMockBuilder('App\Models\Page')
            ->getMock();
    }


    /**
     * test showing a valid page
     */
    public function testShowPageWithValidPage()
    {
        $blade = $this->getMockBuilder('App\Renderers\BladeRenderer')
            ->disableOriginalConstructor()
            ->getMock();

        $blade->expects($this->any())
            ->method(new \PHPUnit_Framework_Constraint_IsAnything())
            ->will($this->returnSelf());

        $controller = $this->getMockBuilder('App\Controllers\PageController')
            ->setConstructorArgs([
                $this->request,
                $this->response,
                $this->session,
                $blade,
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
        $blade = $this->getMockBuilder('App\Renderers\BladeRenderer')
            ->setConstructorArgs(['whatever', 'whatever'])
            ->setMethods(['render'])
            ->getMock();

        $blade->method('render')
            ->willReturn(true);

        $controller = $this->getMockBuilder('App\Controllers\PageController')
            ->setConstructorArgs([
                $this->request,
                $this->response,
                $this->session,
                $blade,
                $this->logger,
                $this->page,
            ])
            ->setMethods(['getPageBySlug'])
            ->getMock();

        $controller->method('getPageBySlug')
            ->willReturn(false);

        $controller->expects($this->any())
            ->method('showPage')
            ->will($this->throwException(
                new PageNotFoundException(
                    $this->request, $this->response, $this->session, $this->blade, $this->logger)));

        $result = $controller->showPage(['slug' => 'test-page']);

        $actual = get_class($result);
        // if we have a non-existent slug, the class of the return value should be an PageNotFoundException
        $expected = 'App\Exceptions\PageNotFoundException';
        $this->assertEquals($expected, $actual);
    }

}
