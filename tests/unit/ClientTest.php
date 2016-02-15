<?php
namespace KWTClient\Tests\Unit;

use KWTClient\Client;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultConstructorBehaviour()
    {
        $apiKey = md5('super_string');
        $this->assertEquals(new Client($apiKey, new \GuzzleHttp\Client), new Client($apiKey));
    }

    public function testResearch()
    {
        $apiKey = md5('super_string');

        $guzzleClientMock = \Mockery::mock('\GuzzleHttp\ClientInterface');

        $requestMock = \Mockery::mock('\KWTClient\Request\RequestInterface');
        $requestMock->shouldReceive('getUri')->andReturnSelf();

        $uriMock = \Mockery::mock('overload:\GuzzleHttp\Psr7\Uri');
        $uriMock->shouldReceive('withQueryValue')
                ->withArgs([$requestMock, 'apikey', $apiKey])
                ->andReturnSelf();

        $guzzleClientMock->shouldReceive('request')
                         ->withArgs(['GET', $uriMock])
                         ->andReturn(\Mockery::mock('Psr\Http\Message\ResponseInterface'));

        $client = new Client($apiKey, $guzzleClientMock);

        $this->assertInstanceOf('KWTClient\Response\ResponseInterface',
                                $client->research($requestMock));
    }

    /**
     * @expectedException \KWTClient\Exception\SearchLimitException
     */
    public function testResearchForExceptionalSituation()
    {
        $apiKey = md5('super_string');

        $guzzleClientMock = \Mockery::mock('GuzzleHttp\ClientInterface');

        $requestMock = \Mockery::mock('KWTClient\Request\RequestInterface');
        $requestMock->shouldReceive('getUri')->andReturnSelf();

        $uriMock = \Mockery::mock('overload:\GuzzleHttp\Psr7\Uri');
        $uriMock->shouldReceive('withQueryValue')->andReturnSelf();

        $exception = \Mockery::mock('KWTClient\Exception\SearchLimitException');
        $exceptionFactoryMock = \Mockery::mock('overload:\KWTClient\Exception\ExceptionFactory');
        $exceptionFactoryMock->shouldReceive('createThrowable')
                             ->andReturn($exception);

        $guzzleClientMock->shouldReceive('request')
                         ->withArgs(['GET', $uriMock])
                         ->andThrow($exception);

        $client = new Client($apiKey, $guzzleClientMock);
        $client->research($requestMock);
    }
}
