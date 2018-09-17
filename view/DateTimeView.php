<?php

namespace view;

require_once('model/time.php');


class DateTimeView {

	public function show() {

		$currentTime = \model\getTime();
		return '<p>' .  $currentTime . '</p>';
	}
}