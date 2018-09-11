<?php 

function getTime() {

  date_default_timezone_get('Europe/Stockholm');

  $time = getDate();

  $second = $time['seconds'];
  $minute = $time['minutes'];
  $hour = $time['hours'];
  $day = $time['mday'];
  $weekDay = $time['weekday'];
  $month = $time['month'];

  return "$weekDay, the $day th of $month , The time is $hour:$minute:$second ";

}