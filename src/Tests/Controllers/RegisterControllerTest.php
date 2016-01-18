<?php
namespace App\Tests;

/**
 * Class ResterControllerTest
 * @package App\Tests
 */
class RegisterControllerTest extends \PHPUnit_Framework_TestCase
{

    protected $request;
    protected $response;
    protected $session;
    protected $blade;
    protected $logger;
    protected $page;

    /**
     *
     */
    protected function setUp()
    {
        require __DIR__ . '/../../../vendor/autoload.php';

        $this->request = $this->getMockBuilder('\Http\HttpRequest')
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder('\Http\HttpResponse')
            ->getMock();

        $this->session = $this->getMockBuilder('App\Session\Session')
            ->getMock();

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
     *
     */
    public function testShowRegisterPage()
    {

        $blade = $this->getMockBuilder('App\Renderers\BladeRenderer')
            ->disableOriginalConstructor()
            ->getMock();

        $blade->expects($this->any())
            ->method(new \PHPUnit_Framework_Constraint_IsAnything())
            ->will($this->returnSelf());

        $controller = $this->getMockBuilder('App\Controllers\RegisterController')
            ->setConstructorArgs([
                $this->request,
                $this->response,
                $this->session,
                $blade,
                $this->logger,
                $this->page,
            ])
            ->setMethods(null)
            ->getMock();

        $controller->showRegister();
    }

}
