<?php

$chan = new chan();

go(function () use ($chan) {
    for ($i = 0; $i < 2; $i++) {
        $result = $chan->pop();
        var_dump($result);
    }
    $chan->close();
    echo 'pop over!'. PHP_EOL;
});

go(function () use ($chan) {
    $chan->push('before');
    co::sleep(1);
    $retval = [2,23,2];
    if (isset($chan)) {
        $chan->push($retval);
    }
    $chan->push($retval);
    echo '444';
});

go(function () use ($chan){
    $eee = "hello word";
    $chan->push($eee);
});

echo 'master end' . PHP_EOL;
exit(555);