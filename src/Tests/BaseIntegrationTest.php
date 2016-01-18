<?php
namespace App\Tests;

use Http\HttpRequest;
use Illuminate\Database\Capsule\Manager as Capsule;
use PDO;

abstract class BaseIntegrationTest extends \PHPUnit_Extensions_Database_TestCase
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
    public function setUp()
    {
        require __DIR__ . '/../../vendor/autoload.php';

//        $dotenv = new \Dotenv\Dotenv(__DIR__ . "/../../");
//        $dotenv->load();

        $capsule = new Capsule();

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'appdb_test',
            'username'  => 'travis',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $this->request = new HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);

        $this->response = $this->getMockBuilder('\Http\HttpResponse')
            ->getMock();

        $this->session = $this->getMockBuilder('App\Session\Session')
            ->getMock();

        $this->blade = $this->getMockBuilder('App\Renderers\BladeRenderer')
            ->disableOriginalConstructor()
            ->getMock();

        $monolog = $this->getMockBuilder('\Monolog\Logger')
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
     * create this file with:
     * mysqldump --xml -t -u vagrant -p appdb > /vagrant/src/Tests/Integration/test-data.xml
     * @return \PHPUnit_Extensions_Database_DataSet_MysqlXmlDataSet
     */
    public function getDataSet()
    {
        return $this->createMySQLXMLDataSet(__DIR__ . "/Integration/test-data.xml");
    }


    /**
     * Get Database connection
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    public function getConnection()
    {
        $db = new PDO(
            "mysql:host=localhost;dbname=appdb_test",
            "vagrant", "secret");

        return $this->createDefaultDBConnection($db, "appdb_test");
    }


    /**
     * Use reflection to allow us to run protected methods
     *
     * @param $obj
     * @param $method
     * @param array $args
     * @return mixed
     */
    protected function run_protected_method($obj, $method, $args = [])
    {
        $method = new \ReflectionMethod(get_class($obj), $method);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $args);
    }
}
