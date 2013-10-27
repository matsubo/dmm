<?php

class DMMAffiliate
{
    const SERVICE_DIGITAL = 'digital';

    private $api_id;
    private $affiliate_id;
    private $word;
    private $service;
    public function __construct($api_id, $affiliate_id)
    {
        $this->api_id = $api_id;
        $this->affiliate_id = $affiliate_id;
    }

    public function setKeyword($word)
    {
        $this->word = $word;
    }

    public function setService($service = null)
    {
        $this->service = $service;
    }

    public function getResult()
    {
        $contents = file_get_contents(sprintf('http://affiliate-api.dmm.com/?api_id=%s&affiliate_id=%s&operation=ItemList&version=2.00&timestamp=2012-01-13%%2014%%3A08%%3A16&site=DMM.co.jp&service=%s&keyword=%s',
            $this->api_id,
            $this->affiliate_id,
            $this->service,
            urlencode(mb_convert_encoding($this->word, 'EUC-JP', 'UTF-8'))));

        $contents = mb_convert_encoding($contents, 'UTF-8', 'EUC-JP');
        $contents = str_replace('euc-jp','utf8', $contents);


        $array = new SimpleXMLElement($contents);

        return $array;
    }

}




$dmm = new DMMAffiliate('HnewL5HcLPsefmeUpzL0', 'pornjapan-990');
$dmm->setKeyword('スク水');
$array = $dmm->getResult();



foreach ($array->result->items->item as $item) {
    $title = $item->title;
    $affiliate_url = $item->affiliateURL;


    if (!isset($item->sampleImageURL->sample_s)) {
        continue;
    }


    $image_url = $item->sampleImageURL->sample_s->image[7];

    print sprintf('<li><a href="%s" title="%s" target="dmm"><img alt="%s" src="%s"></a></li>', $affiliate_url, $title, $title, $image_url);
    print "\n";
}

