<?php

class Helpers {

	public static function get_timeago( $ptime )
	{
		$etime = time() - $ptime;

		if( $etime < 1 )
		{
			return 'less than 1 second ago';
		}

		$a = array(
			12 * 30 * 24 * 60 * 60  =>  'year',
			30 * 24 * 60 * 60       =>  'month',
			24 * 60 * 60            =>  'day',
			60 * 60             		=>  'hour',
			60                  		=>  'minute',
			1                   		=>  'second'
		);

		foreach( $a as $secs => $str )
		{
			$d = $etime / $secs;

			if( $d >= 1 )
			{
				$r = round( $d );
				return 'ongeveer ' . $r . ' ' . Str::plural($str, $r) . ' geleden';
			}
		}
	}

	public static function get_timetogo( $ptime )
	{
		$etime = $ptime - time();

		if( $etime < 1 )
		{
			return 'less than 1 second ago';
		}

		$a = array(
			12 * 30 * 24 * 60 * 60  =>  'year',
			30 * 24 * 60 * 60       =>  'month',
			24 * 60 * 60            =>  'day',
			60 * 60             		=>  'hour',
			60                  		=>  'minute',
			1                   		=>  'second'
		);

		foreach( $a as $secs => $str )
		{
			$d = $etime / $secs;

			if( $d >= 1 )
			{
				$r = round( $d );
				return 'ongeveer ' . $r . ' ' . Str::plural($str, $r) . ' te gaan';
			}
		}
	}
}