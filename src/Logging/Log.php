<?php
namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log {

    private $infoLog;
    private $warningLog;
    private $errorLog;

    public function __construct()
    {
        $this->infoLog = new Logger('info');
        $this->infoLog->pushHandler(new StreamHandler(getenv('LOG_FILE') . '/info.log', Logger::INFO));
        $this->warningLog = new Logger('warning');
        $this->warningLog->pushHandler(new StreamHandler(getenv('LOG_FILE') . '/warning.log', Logger::WARNING));
        $this->errorLog = new Logger('error');
        $this->errorLog->pushHandler(new StreamHandler(getenv('LOG_FILE') . '/error.log', Logger::ERROR));
    }


    public function logInfo($entry)
    {
        $this->infoLog->addInfo($entry);
    }


    public function logWarning($entry)
    {
        $this->warningLog->addWarning($entry);
    }

    public function logError($entry)
    {
        $this->errorLog->addError($entry);
    }
}
