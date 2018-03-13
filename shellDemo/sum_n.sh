#! /bin/bash

n=0
while [ $n -lt 1 ];do
	read -p "Please input a number, it must greater than 1:" n
done

sum=0
for i in `seq 1 $n`;do
	sum=$[$i+$sum]
done

echo $sum
