<?php
namespace KWTClient\Tests\Unit\Response;

use KWTClient\Response\Response;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testGetKeywords()
    {
        $jsonFile = dirname($GLOBALS['configurationFilePath']) . '/' . $GLOBALS['GOOGLE_KW_RESPONSE_JSON_FILE'];
        if (!file_exists($jsonFile)) {
            die ("Could not found json response for parse");
        }

        $response = new \GuzzleHttp\Psr7\Response(200, [], 
                            \GuzzleHttp\Psr7\stream_for(fopen($jsonFile, 'r')));

        $kwResponse = new Response($response);
        $keywords = $kwResponse->getKeywords();

        $this->assertEquals(1483, count($keywords));
        foreach ($keywords as $keyword) {
            $this->assertEquals(['kw', 'vol'], array_keys($keyword));
            $this->assertInternalType('int', $keyword['vol']);
            $this->assertInternalType('string', $keyword['kw']);
            $this->assertNotEmpty($keyword['kw']);
        }
    }
}
