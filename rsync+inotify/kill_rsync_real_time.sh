#!/bin/bash

echo "current $$"
function kill_process_by_name()
{
    local name sum process_id kill_id
    name="$1"
    sum=`ps -ef | grep $name | grep -v "grep" | wc -l`
    sleep 1
    if [ $sum -gt 1 ];then
        process_id=`ps -ef | grep $name | grep -v "grep" | awk '{print $2}'`
        for kill_id in $process_id;do
            if [ $$ -eq $kill_id ];then
                echo '已经将名为：'$name'的进程杀死'
            else
                ps aux | awk '{print $2 }' | grep -q $kill_id 2> /dev/null
                if [ $? -eq 0  ];then
                    kill $kill_id
                fi
            fi
        done
    fi
}
kill_process_by_name "rsync_real_time.sh"
kill_process_by_name "inotifywait"
sleep 1


