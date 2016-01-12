<?php
namespace App\Tests;


class LogTest extends \PHPUnit_Framework_TestCase {

    public $logInfo;
    public $logWarning;
    public $logError;

    protected function setUp()
    {
        $this->logInfo = $this->getMockBuilder('Monolog\Logger')
            ->setConstructorArgs(['infolog'])
            ->setMethods([])
            ->getMock();

        $this->logWarning = $this->getMockBuilder('Monolog\Logger')
            ->setMethods([])
            ->setConstructorArgs(['warninglog'])
            ->getMock();

        $this->logError = $this->getMockBuilder('Monolog\Logger')
            ->setConstructorArgs(['errorlog'])
            ->setMethods([])
            ->getMock();
    }


    public function testLogToInfoWarningAndError()
    {

        // we set methods to null so that all methods are mocks
        $logger = $this->getMockBuilder('App\Logging\Log')
            ->setConstructorArgs([$this->logInfo, $this->logWarning, $this->logError])
            ->setMethods(null)
            ->getMock();

        $logger->method('addInfo')
            ->willReturn(true);

        // test info
        $result = $logger->logInfo("Some test value");
        $this->assertTrue($result);

        // test warning
        $result = $logger->logWarning("Some test value");
        $this->assertTrue($result);

        // test error
        $result = $logger->logError("Some test value");
        $this->assertTrue($result);
    }
}
