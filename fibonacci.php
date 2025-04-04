<?php
function fibonacci($n){
$first=0;
$second=1;
 echo "$first,$second";

for($i=2;$i<$n;$i++)
{
$next=$first+$second;
echo ",$next";
$first=$second;
$second=$next;
}
  }
$n=10;
fibonacci($n);
?>
