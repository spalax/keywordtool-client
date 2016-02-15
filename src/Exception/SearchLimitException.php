<?php
/**
 * Created by PhpStorm.
 * User: oleksiimylotskyi
 * Date: 2/8/16
 * Time: 20:14
 */

namespace KWTClient\Exception;


class SearchLimitException extends ApiException
{
    const EXCEPTION_CODE = 7;

    /**
     * SearchLimitException constructor.
     *
     * @param string $message
     * @param \Exception $previous
     */
    public function __construct($message)
    {
        parent::__construct($message, self::EXCEPTION_CODE);
    }
}
