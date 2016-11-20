<?php 
class Log_Redis extends Redis implements LogInterface
{
    public function __construct()
    {
        $this->pconnect("127.0.0.1");
    }

    public function setPath($path) {

    }


    public function write($key, $value)
    {
        $this->set($key, $value);
    }

    public function read($key)
    {
        if(!$this->exists($key)) {
            throw new Exception("Key does not exist!");
        }
        return $this->get($key);
    }

    public function contain($key)
    {
        if(!$this->exists($key)) {
            return false;
        }
        return true;
    }

    public function remove($key)
    {
        if(!$this->exists($key)) {
            throw new Exception("Key does not exist");
        }
        $this->del($key);
    }
}
 ?>