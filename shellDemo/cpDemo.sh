#! /bin/bash

for f in `ls ~/www/study/studylog`;do
	if [ -d ~/www/study/studylog/$f ];then
		#echo "$f is a direct file"
		cp -r ~/www/study/studylog/$f /tmp/
	fi
done
