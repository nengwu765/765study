#!/bin/sh -e
# upstart-job
#
# rsync_real_time

COMMAND="$1"

case $COMMAND in
stop)
    /bin/bash /home/nwqian/rsync+inotify/kill_rsync_real_time.sh
    exit 0;
    ;;
start)
    if [ $# -eq 2 ] && ( [ $2 -eq 1 ] || [ $2 -eq 2] );then
        echo "current $$"
        echo '同步进程rsync_real_time' $2'已经重新启动'
        nohup /bin/bash /home/nwqian/rsync+inotify/rsync_real_time.sh $2 > /home/nwqian/user/rsync_log/rsync_real_time.log 2>&1 &
    else
        echo "参数不正确(stop|start [type])"
        exit 1;
    fi
    exit 0;
    ;;
*)
    echo "参数不正确(stop|start [type])"
    exit 1
esac
