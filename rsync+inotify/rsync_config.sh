#!/bin/bash

declare -a sync
if ! [ $# -eq 1 ];then
    echo "没有可用的配置信息";
    exit;
elif [ $1 -eq 1 ];then
    sync[2]='/home/nwqian/anjuke/nengwuqian/kfs/,evans@10.249.7.81:/home/www/releases/php/nengwuqian/kfs/'
    sync[3]='/home/nwqian/anjuke/nengwuqian/cms/,evans@10.249.7.81:/home/www/releases/php/nengwuqian/cms/'
    sync[4]='/home/nwqian/anjuke/nengwuqian/crm/,evans@10.249.7.81:/home/www/releases/php/nengwuqian/crm/'
    sync[5]='/home/nwqian/anjuke/broker/ajkbroker/,evans@10.249.9.120:/home/www/release/nengwuqian/ajkbroker/'
else
    echo "没有可用的配置信息";
    exit;
fi


