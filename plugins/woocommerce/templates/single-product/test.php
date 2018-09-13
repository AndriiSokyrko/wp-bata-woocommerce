<?php
	/**
	 * Created by PhpStorm.
	 * User: user
	 * Date: 03.03.2017
	 * Time: 20:41
	 */
	echo ob_get_level();              // 1
	ob_start();
	echo ob_get_level();          // 2
	ob_start();
	echo ob_get_level();      // 3
	ob_start();
	echo ob_get_level();  // 4
	ob_end_flush();
	ob_end_flush();
	ob_end_flush();