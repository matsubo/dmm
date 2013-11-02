<?php
/**
 * DMM Affiliate API client
 *
 * @category Affiliate
 * @package  DMM
 * @author   Yuki Matsukura <matsubokkuri@gmail.com>
 * @license  PHP Version 3.0
 * @version  $Id$
 * @link     http://github.com/matsubo/dmm
 */
namespace DMM;
/**
 * DMM\Affiliate
 *
 * @category Affiliate
 * @package   DMM
 * @author    Yuki Matsukura <matsubokkuri@gmail.com>
 * @copyright 1997-2005 The PHP Group
 * @license   PHP Version 3.0
 * @link      http://github.com/matsubo/dmm
 */
class Affiliate
{
    /** @const hostname */
    const HOST = 'affiliate-api.dmm.com';

    /** @const API version */
    const VERSION = '2.00';

    /** @private int $app_id */
    private $api_id;

    /** @private string your own affiliate ID */
    private $affiliate_id;

    /** @private string keyword to search */
    private $word;

    /** @private string service name */
    private $service;

    /** @private string category name */
    private $floor;

    /** @private int offset of result */
    private $offset;

    /** @private string name of sort key */
    private $sort;

    /** @prvate string name of operation */
    private $operation = 'ItemList';

    /**
     * @private
     * Domain of API target
     *
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
        $url = sprintf('http://%s/' .
            '?api_id=%s&affiliate_id=%s&operation=%s&version=%s' .
            '&timestamp=%s&site=%s&service=%s&floor=%s&offset=%d&sort=%s&keyword=%s',
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
            urlencode(mb_convert_encoding($this->word, 'EUC-JP', 'UTF-8'))
        );

        $contents = file_get_contents($url);

        $contents = mb_convert_encoding($contents, 'UTF-8', 'EUC-JP');
        $contents = str_replace('euc-jp', 'utf8', $contents);

        $array = new \SimpleXMLElement($contents);

        return $array;
    }
}
