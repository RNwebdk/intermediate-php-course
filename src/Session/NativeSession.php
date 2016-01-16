<?php
namespace App\Session;

/**
 * Class NativeSession
 * @package App\Session
 */
class NativeSession implements Session
{

    /**
     * @param $item
     * @return bool
     */
    public function has($name)
    {
        return (isset($_SESSION[$name]) ? true : false);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function put($name, $value)
    {
        $_SESSION[$name] = $value;

        return $this;
    }

    /**
     * @param $name
     * @return bool
     */
    public function get($name)
    {
        return (isset($_SESSION[$name]) ? $_SESSION[$name] : false);
    }


    /**
     * @param $name
     * @return $this
     */
    public function forget($name)
    {
        unset($_SESSION[$name]);

        return $this;
    }

    /**
     * destroy session
     */
    public function destroy()
    {
        session_destroy();
    }

}
