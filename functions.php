<?php

	/*
		THIS IS ONLY A WRAPPER FOR JAVASCRIPT FUNCTIONS IN PHP.
	*/

	function js($code) {
		echo "<script>$code;</script>";
	}

	function alert($msg) {
		js("alert('$msg')");
	}

	function assign($loc) {
		js("window.location.assign($loc)");
	}

	function console_log($msg) {
		js("console.log('$msg')");
	}

	function printCard($content) {
		echo "<li><h5>$content</h5></li>";
	}

?>