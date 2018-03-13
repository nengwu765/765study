#!/bin/bash

#bash get current file directory
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
source "$DIR/rsync_config.sh";
###########################
# 添加监控shell是否已经开启，开启则kill掉之前的重新启动
##########################

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
                echo '同步进程'$name'正在重新启动'
            else
                ps aux | awk '{print $2 }' | grep -q $kill_id 2> /dev/null
                if [ $? -eq 0  ];then
                    kill $kill_id
                fi
            fi
        done
    fi
}
kill_process_by_name "$0"
kill_process_by_name "inotifywait"
sleep 1


###########################
# 在这里配置本地文件夹,目标host,目标的rsync_module。rsync_module在同步机器的/etc/rsyncd.conf文件中配置
# 逗号前后不要有空格
# 可以使用模块或者路径 root@10.10.3.208::$module_name root@10.10.3.208:$path
#sync[0]='/home/www/aifang/site/,root@10.10.3.208:/home/www/source/aifang/aifang-site' 
#sync[1]='/home/www/aifang/pages/,root@10.10.3.208:/home/www/source/aifang/aifang-pages' 
# sync[1]='/path/to/local/dir,user@host::rsync_module'
###########################,qq

for item in ${sync[@]}; do

dir=`echo $item | awk -F"," '{print $1}'`
host_path=`echo $item | awk -F"," '{print $2}'`

inotifywait -mrq --timefmt '%d/%m/%y %H:%M' --format  '%T %w%f %e' \
 --event CLOSE_WRITE,create,move,delete  $dir | while read  date time file event
    do
        echo $event'-'$file
        case $event in
            CLOSE_WRITE,CLOSE|MODIFY|CREATE|MOVE|MODIFY,ISDIR|CREATE,ISDIR|MODIFY,ISDIR)
                if [ "${file: -4}" != '4913' ]  && [ "${file: -1}" != '~' ]; then
                    cmd="rsync -avz --progress --exclude='*' --include=$file $dir $host_path"
                    # echo $cmd
                    $cmd
                fi
                ;;

            MOVED_FROM|MOVED_FROM,ISDIR|DELETE|DELETE,ISDIR)
                if [ "${file: -4}" != '4913' ]  && [ "${file: -1}" != '~' ]; then
                    cmd="rsync -avz --progress --delete-excluded --exclude="$file" $dir $host_path"
                    # echo $cmd
                    $cmd
                fi
                ;;
        esac
    done &
done
