<?php
namespace KWTClient\Tests\Unit;

use KWTClient\Request\Request;
use KWTClient\RequestFactory;

class RequestFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGoogleRequest()
    {
        $newInstance = new Request('test', 'http://api.keywordtool.io/v1/search/google');
        $request = RequestFactory::google('test');

        $this->assertEquals($newInstance, $request);
    }

    public function testYoutubeRequest()
    {
        $newInstance = new Request('test', 'http://api.keywordtool.io/v1/search/youtube');
        $request = RequestFactory::youtube('test');

        $this->assertEquals($newInstance, $request);
    }

    public function testBingRequest()
    {
        $newInstance = new Request('test', 'http://api.keywordtool.io/v1/search/bing');
        $request = RequestFactory::bing('test');

        $this->assertEquals($newInstance, $request);
    }

    public function testAppStoreRequest()
    {
        $newInstance = new Request('test', 'http://api.keywordtool.io/v1/search/app-store');
        $request = RequestFactory::appstore('test');

        $this->assertEquals($newInstance, $request);
    }
}
