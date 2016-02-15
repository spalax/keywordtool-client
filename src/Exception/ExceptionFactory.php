<?php
namespace KWTClient\Exception;

use GuzzleHttp\Exception\ClientException;

class ExceptionFactory
{
    /**
     * @param ClientException $clientException
     *
     * @return ApiException | SearchLimitException
     */
    public static function createThrowable(ClientException $clientException)
    {
        $data = \GuzzleHttp\json_decode($clientException->getResponse()->getBody()->getContents());

        $code = 0;
        $message = '';

        if (!empty($data->error)) {
            $error = $data->error;
            if (!empty($error->code)) {
                $code = $error->code;
            }

            if (!empty($error->message)) {
                $message = $error->message;
            }
        }

        if ($code == SearchLimitException::EXCEPTION_CODE) {
            return new SearchLimitException($message);
        }
        
        return new ApiException($message, $code);
    }
}
