#!/bin/bash

for f in ./tests/* 
do
  echo -e "\n"
  echo  $f
  echo -e  "\n"

  vendor/bin/phpunit $f
done
cucumber
