<?php
namespace KWTClient;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;
use KWTClient\Exception\ApiException;
use KWTClient\Exception\ExceptionFactory;
use KWTClient\Exception\SearchLimitException;
use KWTClient\Request\RequestInterface;
use KWTClient\Response\Response;
use KWTClient\Response\ResponseInterface;

class Client
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * Client constructor.
     *
     * @param string $apiKey
     * @param ClientInterface|null $httpClient
     */
    public function __construct($apiKey,
                                ClientInterface $httpClient = null)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;

        if (is_null($httpClient)) {
            $this->httpClient = new \GuzzleHttp\Client();
        }
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws ApiException | SearchLimitException
     */
    public function research(RequestInterface $request)
    {
        try {
            $response = $this->httpClient->request('GET',
                                                    Uri::withQueryValue($request->getUri(),
                                                                        'apikey',
                                                                        $this->apiKey));
            return new Response($response);
        } catch (\GuzzleHttp\Exception\ClientException $ex) {
            throw ExceptionFactory::createThrowable($ex);
        }
    }
}
