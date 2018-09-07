<?php

class DateTimeView {


	public function show() {

		$timeString = time();

		$currentTime = date("Y-m-d", $timeString);

		return '<p>' . $currentTime . '</p>';
	}
}