<?php
echo '444';

echo ucwords('mel_hh').PHP_EOL;
echo ucwords('7mel_hh').PHP_EOL;
echo ucwords('mel hh').PHP_EOL;
echo ucwords('model hh').PHP_EOL;
echo ucwords('model hello').PHP_EOL;
echo ucwords('model_hello').PHP_EOL;



$aerialPhotoInfos = [
[
'scene_key' =>1,
],
[
'scene_key' =>1,
],
[
'scene_key' =>'',
],
];
$newCounterValue = 0;
array_walk($aerialPhotoInfos, function($item, $key, &$newCounterValue) {
                !empty($item['scene_key']) && $newCounterValue++ ;
}, &$newCounterValue);

echo $newCounterValue;
