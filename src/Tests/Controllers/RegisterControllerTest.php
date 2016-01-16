<?php
namespace App\Tests;

use App\Controllers\RegisterController;

/**
 * Class ResterControllerTest
 * @package App\Tests
 */
class ResterControllerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var
     */
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
     *
     */
    public function testShowRegisterPage()
    {
        $controller = $this->getMockBuilder('App\Controllers\RegisterController')
            ->setConstructorArgs([
                $this->request,
                $this->response,
                $this->session,
                $this->blade,
                $this->logger,
                $this->page,
            ])
            ->setMethods(null)
            ->getMock();

        $controller->showRegister();
    }

}
