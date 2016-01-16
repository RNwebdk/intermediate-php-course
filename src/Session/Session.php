<?php
namespace App\Session;

/**
 * Class Session
 * @package App\Session
 */
interface Session
{

    /**
     * @param $name
     * @return mixed
     */
    public function has($name);

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function put($name, $value);

    /**
     * @param $name
     * @return mixed
     */
    public function get($name);

    /**
     * @param $name
     * @return mixed
     */
    public function forget($name);

//    public function destroy();
}
