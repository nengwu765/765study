#! /bin/bash

square() {
	res=$[$1 * $1]
	return $res
}

square $2
result=$?
echo $result


