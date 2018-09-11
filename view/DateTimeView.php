<?php

	require_once('model/time.php');

class DateTimeView {

	public function show() {

		$currentTime = getTime();
		return '<p>' .  $currentTime . '</p>';
	}
}