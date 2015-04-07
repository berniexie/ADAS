#!/bin/bash
for f in ./tests/* 
do
  echo  "\n"
  echo  $f
  echo  "\n"

  vendor/bin/phpunit $f
done
