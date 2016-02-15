<?php
namespace KWTClient\Tests\Unit\Request;

use KWTClient\Request\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultConstructorBehaviour()
    {
        $keyword = 'keyword_test';
        $serviceUrl = 'http://some.api.url.com/test';
        $request = new Request($keyword, $serviceUrl);

        $this->assertEquals($serviceUrl.'?keyword='.$keyword, (string)$request->getUri());
    }

    public function testUseAllParams()
    {
        $keyword = 'keyword_test';
        $country = 'es';
        $language = 'es';
        $excludeKeywords = ['exclude', 'exclude_1'];
        $serviceUrl = 'http://some.api.url.com/test';

        $request = new Request($keyword, $serviceUrl);
        $request->complete(true)
                ->country('es')
                ->type()
                ->excludeKeywords($excludeKeywords)
                ->language('es')
                ->metrics(true);

        $params = ['keyword' => $keyword,
                   'complete'=>'true',
                   'country'=>$country,
                   'type'=>'suggestions',
                   'exclude'=>join('|', $excludeKeywords),
                   'language'=>$language,
                   'metrics'=>'true'];
        
        $this->assertEquals($serviceUrl.'?'.\GuzzleHttp\Psr7\build_query($params), (string)$request->getUri());
    }
}
