<?php
namespace App\Tests;

use App\Controllers\AuthenticationController;
use App\Session\NativeSession;
use Http\HttpRequest;

/**
 * Class AuthenticationControllerTest
 * @package App\Tests
 */
class AuthenticationControllerTest extends \PHPUnit_Framework_TestCase
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


    public function testGetShowLoginPage()
    {
        $blade = $this->getMockBuilder('App\Renderers\BladeRenderer')
            ->disableOriginalConstructor()
            ->getMock();

        $blade->expects($this->any())
            ->method(new \PHPUnit_Framework_Constraint_IsAnything())
            ->will($this->returnSelf());

        $controller = $this->getMockBuilder('App\Controllers\AuthenticationController')
            ->setConstructorArgs([
                $this->request,
                $this->response,
                $this->session,
                $blade,
                $this->logger,
                $this->page,
            ])
            ->getMock();

        $result = $controller->showLogin(['slug' => 'test-page']);

        $actual = get_class($result);
        // if we have a valid slug, the class of the return value should be an PageControllerTest
        $expected = 'App\Tests\AuthenticationControllerTest';
        $this->assertEquals($actual, $expected);
    }

}
