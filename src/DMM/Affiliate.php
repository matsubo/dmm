<?php
namespace DMM;
/**
 * DMM\Affiliate
 *
 */
class Affiliate
{
    const SERVICE_DIGITAL = 'digital';

    private $api_id;
    private $affiliate_id;
    private $word;
    private $service;

    private $operation = 'ItemList';
    private $site = 'DMM.co.jp';

    /**
     * __construct
     *
     * @param mixed $api_id
     * @param mixed $affiliate_id
     * @access public
     * @return void
     */
    public function __construct($api_id, $affiliate_id)
    {
        $this->api_id = $api_id;
        $this->affiliate_id = $affiliate_id;
    }

    /**
     * setKeyword
     *
     * @param mixed $word
     * @access public
     * @return void
     */
    public function setKeyword($word)
    {
        $this->word = $word;
    }

    /**
     * setService
     *
     * @param mixed $service
     * @access public
     * @return void
     */
    public function setService($service = null)
    {
        $this->service = $service;
    }

    /**
     * setOperation
     *
     * @param string $operation
     * @access public
     * @return void
     */
    public function setOperation($operation = 'ItemList')
    {
        $this->operation = $operation;
    }

    /**
     * setSite
     *
     * @param string $site
     * @access public
     * @return void
     */
    public function setSite($site = 'DMM.co.jp')
    {
        $this->site = $site;
    }

    /**
     * getResult
     *
     * @access public
     * @return array
     */
    public function getResult()
    {
        $contents = file_get_contents(sprintf('http://affiliate-api.dmm.com/?api_id=%s&affiliate_id=%s&operation=%s&version=2.00&timestamp=2012-01-13%%2014%%3A08%%3A16&site=%s&service=%s&keyword=%s',
            $this->api_id,
            $this->affiliate_id,
            $this->operation,
            $this->site,
            $this->service,
            urlencode(mb_convert_encoding($this->word, 'EUC-JP', 'UTF-8'))));

        $contents = mb_convert_encoding($contents, 'UTF-8', 'EUC-JP');
        $contents = str_replace('euc-jp','utf8', $contents);

        $array = new \SimpleXMLElement($contents);

        return $array;
    }
}
