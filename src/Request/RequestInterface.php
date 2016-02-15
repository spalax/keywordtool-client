<?php
namespace KWTClient\Request;

use Psr\Http\Message\UriInterface;

interface RequestInterface
{
    /**
     * @return UriInterface
     */
    public function getUri();
}
