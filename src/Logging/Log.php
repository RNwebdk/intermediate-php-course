<?php
namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class Log
 * @package App\Logging
 */
class Log
{

    protected $infoLog;
    protected $warningLog;
    protected $errorLog;

    /**
     * Log constructor.
     * @param Logger $infoLog
     * @param Logger $warningLog
     * @param Logger $errorLog
     */
    public function __construct(Logger $infoLog, Logger $warningLog, Logger $errorLog)
    {
        $this->infoLog = $infoLog;
        $this->infoLog->pushHandler(new StreamHandler(getenv('LOG_FILE') . '/info.log', Logger::INFO));
        $this->warningLog = $warningLog;
        $this->warningLog->pushHandler(new StreamHandler(getenv('LOG_FILE') . '/warning.log', Logger::WARNING));
        $this->errorLog = $errorLog;
        $this->errorLog->pushHandler(new StreamHandler(getenv('LOG_FILE') . '/error.log', Logger::ERROR));
    }


    /**
     * @param $entry
     * @return bool
     */
    public function logInfo($entry)
    {
        $this->infoLog->addInfo($entry);

        return true;
    }


    /**
     * @param $entry
     * @return bool
     */
    public function logWarning($entry)
    {
        $this->warningLog->addWarning($entry);

        return true;
    }

    /**
     * @param $entry
     * @return bool
     */
    public function logError($entry)
    {
        $this->errorLog->addError($entry);

        return true;
    }
}
