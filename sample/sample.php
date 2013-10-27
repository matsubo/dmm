<?php

require __DIR__ . '/../vendor/autoload.php';


use DMM\Affiliate;

$dmm = new Affiliate('HnewL5HcLPsefmeUpzL0', 'pornjapan-990');
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

