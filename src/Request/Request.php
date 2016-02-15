<?php
namespace KWTClient\Request;

use GuzzleHttp\Psr7\Uri;

class Request implements RequestInterface
{
    /**
     * @var string
     */
    protected $serviceUri;

    /**
     * @var
     */
    protected $params;

    /**
     * Request constructor.
     *
     * @param string $keyword
     * @param string $serviceUri
     */
    public function __construct($keyword, $serviceUri)
    {
        $this->serviceUri = $serviceUri;
        $this->addQueryParam('keyword', $keyword);
    }

    /**
     * Country, you want to get keyword suggestions for.
     *
     * @param string $countryCode Two characters of country code
     *
     * @return $this
     */
    public function country($countryCode = 'us')
    {
        $this->addQueryParam('country', $countryCode);
        return $this;
    }

    /**
     * Language, you want to get keyword suggestions for.
     *
     * @param string $countryCode Two characters of country code
     *
     * @return $this
     */
    public function language($language = 'en')
    {
        $this->addQueryParam('language', $language);
        return $this;
    }

    /**
     * Use this parameter to specify negative keywords, i.e. the keywords that you want to exclude from your results.
     * For example, an API call that contains "keyword=iphone&exclude=case|game|price" will return keyword suggestions
     * for the keyword "iphone" but there will be no keyword suggestions that contain words "case", "game", or "price".
     * Meaning the keyword suggestion "best iphone price" will not show up in the results.
     *
     * @param array $keywords
     *
     * @return $this
     */
    public function excludeKeywords(array $keywords = [])
    {
        $this->addQueryParam('exclude', join('|', $keywords));
        return $this;
    }

    /**
     * Allows to get Search Volume, CPC and AdWords Competition data for
     * keywords in English language if this parameter is set to "true".
     *
     * @param bool $flag [Default: false]
     *
     * @return $this
     */
    public function metrics($flag = false)
    {
        $this->addQueryParam('metrics', !!$flag ? "true" : "false");
        return $this;
    }

    /**
     * Type of search query.
     * Available types are: "suggestions" and "questions".
     *
     * @param string $type [Default: suggestions]
     *
     * @return $this
     */
    public function type($type = 'suggestions')
    {
        $this->addQueryParam('type', $type);
        return $this;
    }

    /**
     * Allows to get the full set of autocomplete results.
     * Please note that certain percent of requests might return an error
     * if this parameter is set to "true".
     *
     * @param bool|false $flag [Default: false]
     *
     * @return $this
     */
    public function complete($flag = false)
    {
        $this->addQueryParam('complete', !!$flag ? "true" : "false" );
        return $this;
    }

    /**
     * @param string $paramName
     * @param string $paramValue
     */
    protected function addQueryParam($paramName, $paramValue)
    {
        $this->params[$paramName] = $paramValue;
    }

    /**
     * @return \Psr\Http\Message\UriInterface
     */
    public function getUri()
    {
        $uri = new Uri($this->serviceUri);
        return $uri->withQuery(\GuzzleHttp\Psr7\build_query($this->params));
    }
}
