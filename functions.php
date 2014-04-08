<?php

/**
 * @author http://www.exorithm.com/algorithm/view/unique_image
 */
function unique_image($string)
{
  $size=200;
  $steps=5;
  $step=$size/$steps;

  $image = image_create_alpha($size, $size);

  $n = 0;
  $prev = 0;
  $len = strlen($string);
  $sum = 0;
  for ($i=0;$i<$len;$i++) $sum += ord($string[$i]);

  for ($i=0;$i<$steps;$i++) {
    for ($j=0;$j<$steps;$j++) {
      $letter = $string[$n++ % $len];
      
      $u = ($n % (ord($letter)+$sum)) + ($prev % (ord($letter)+$len)) + (($sum-1) % ord($letter));
      $color = imagecolorallocate($image, pow($u*$prev+$u+$prev+5,2)%256, pow($u*$prev+$u+$prev+3,2)%256, pow($u*$prev+$u+$prev+1,2)%256);
      if (($u%2)==0)
        imagefilledpolygon($image, array($i*$step, $j*$step, $i*$step+$step, $j*$step, $i*$step, $j*$step+$step), 3, $color);
      $prev = $u;

      $u = ($n % (ord($letter)+$len)) + ($prev % (ord($letter)+$sum)) + (($sum-1) % ord($letter));
      if (($u%2)==0)
        imagefilledpolygon($image, array($i*$step, $j*$step+$step, $i*$step+$step, $j*$step+$step, $i*$step+$step, $j*$step), 3, $color);
      $prev = $u;

    }
  }

  return $image;
}
