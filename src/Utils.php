<?php
namespace KWTClient;

class Utils
{
    /**
     * Delay execution
     * it is a proxy method
     * which need to mock \sleep
     * builtin behavior.
     *
     * @param int $seconds
     * Halt time in seconds.
     * @return int zero on success, or false on errors. If the call was interrupted
     * by a signal, sleep returns the number of seconds left
     */
    public static function sleep($seconds)
    {
        return \sleep($seconds);
    }
}
