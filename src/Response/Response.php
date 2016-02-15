<?php
namespace KWTClient\Response;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var array
     */
    protected $keywords = [];

    /**
     * @var array | null
     */
    protected $decodedRaw = null;

    /**
     * @var array
     */
    protected $queries = [];

    /**
     * KeywordsResponse constructor.
     *
     * @param PsrResponseInterface $response
     */
    public function __construct(PsrResponseInterface $response)
    {
        $this->response = $response;
    }

    protected function initKeywordsData()
    {
        if (!empty($this->decodedRaw)) {
            return;
        }

        $contents = $this->response->getBody()->getContents();
        if (empty($contents)) {
            return;
        }

        $this->decodedRaw = \GuzzleHttp\json_decode($contents);
        if ($this->decodedRaw->results) {
            foreach ($this->decodedRaw->results as $k=>$res) {
                if ($k == '_empty_') {
                    $this->keywords[] = ['kw'=>$res[0]->string,
                                         'vol'=>intval($res[0]->volume)];
                    continue;
                }

                foreach ($res as $keyword) {
                    $volume = 0;
                    if (!empty($keyword->volume)) {
                        $volume = intval($keyword->volume) > 0 ? intval($keyword->volume) : 0;
                    }
                    $this->keywords[] = ['kw'=>$keyword->string,
                                         'vol'=>$volume];
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getKeywords()
    {
       $this->initKeywordsData();
       return $this->keywords;
    }
}
