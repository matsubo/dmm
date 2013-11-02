<?php
namespace DMM;
/**
 * DMM\Affiliate
 *
 */
class Affiliate
{
    const HOST = 'affiliate-api.dmm.com';
    const SERVICE_DIGITAL = 'digital';
    const VERSION = '2.00';

    private $api_id;
    private $affiliate_id;
    private $word;
    private $service;
    private $floor;
    private $offset;
    private $sort;

    private $operation = 'ItemList';

    /**
     * - DMM.co.jp: DMM R18
     * - DMM.com: DMM All
     */
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
     * setFloor
     *
     * @param mixed $floor
     * @access public
     * @return void
     */
    public function setFloor($floor = null)
    {
        $This->floor = $floor;
    }
    /**
     * setOffset
     *
     * @param mixed $offset
     * @access public
     * @return void
     */
    public function setOffset($offset = null)
    {
        $this->offset = $offset;
    }
    /**
     * setSort
     *
     * @param mixed $sort
     * @access public
     * @return void
     */
    public function setSort($sort = null)
    {
        $this->sort = $sort;
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
        $contents = file_get_contents(sprintf('http://%s/?api_id=%s&affiliate_id=%s&operation=%s&version=%s&timestamp=%s&site=%s&service=%s&floor=%s&offset=%d&sort=%s&keyword=%s',
            self::HOST,
            $this->api_id,
            $this->affiliate_id,
            $this->operation,
            self::VERSION,
            urlencode(date('Y-m-d H:i:s')),
            $this->site,
            $this->service,
            $this->floor,
            $this->offset,
            $this->sort,
            urlencode(mb_convert_encoding($this->word, 'EUC-JP', 'UTF-8'))));

        $contents = mb_convert_encoding($contents, 'UTF-8', 'EUC-JP');
        $contents = str_replace('euc-jp','utf8', $contents);

        $array = new \SimpleXMLElement($contents);

        return $array;
    }
}
