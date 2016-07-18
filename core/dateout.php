<?php
class DateOut{

	var $mdate;
	var $ddate;
	var $ydate;
	var $hours;
	var $minits;
	var $seconds;

	var $_adate;
	var $awdate;
	var $amdate;
	var $amdates;
	var $addate;

	function qdate($qdate, $format = 3){
		if($format == 6) {
			$yf1 = substr($qdate, 0, 4);
			$mf1 = substr($qdate, 5, 2);
			$df1 = substr($qdate, 8, 2);
			$yf2 = substr($qdate, 10, 4);
			$mf2 = substr($qdate, 15, 2);
			$df2 = substr($qdate, 18, 2);
		} else {
			$yf = substr($qdate, 0, 4);
			$yfs = substr($qdate, 2, 2);
			$mf = substr($qdate, 5, 2);
			$df = substr($qdate, 8, 2);
			$hf = substr($qdate, 11, 2);
			$if = substr($qdate, 14, 2);
			$sf = substr($qdate, 17, 2);
		}

		//array date mon
		$this->amdate = [
		"01"=>"января", 	"02"=>"февраля",
		"03"=>"марта",		"04"=>"апреля",
		"05"=>"мая",		"06"=>"июня",
		"07"=>"июля",		"08"=>"августа",
		"09"=>"сентября",	"10"=>"октября",
		"11"=>"ноября",		"12"=>"декабря"];

		//array date mon
		$this->amdates = [
		"01"=>"янв", 	"02"=>"фев",
		"03"=>"мар",	"04"=>"апр",
		"05"=>"мая",	"06"=>"июн",
		"07"=>"июл",	"08"=>"авг",
		"09"=>"сен",	"10"=>"окт",
		"11"=>"ноя",	"12"=>"дек"];

		//array date mon
		$this->addate = [
		"01"=>"1",		"02"=>"2",		"03"=>"3",		"04"=>"4",		"05"=>"5",
		"06"=>"6",		"07"=>"7",		"08"=>"8",		"09"=>"9",		"10"=>"10",
		"11"=>"11",		"12"=>"12",		"13"=>"13",		"14"=>"14",		"15"=>"15",
		"16"=>"16",		"17"=>"17",		"18"=>"18",		"19"=>"19",		"20"=>"20",
		"21"=>"21",		"22"=>"22",		"23"=>"23",		"24"=>"24",		"25"=>"25",
		"26"=>"26",		"27"=>"27",		"28"=>"28",		"29"=>"29",		"30"=>"30",
		"31"=>"31"];

		//var Year date
		$this->ydate = date($yf);
		$this->ydates = date($yfs);

		//var Mon date
		$this->mdate = date($mf);

		//var Day date
		$this->ddate = date($df);

		//var time
		$this->hours = date($hf);
		$this->minits = date($if);
		$this->seconds = date($sf);

		$day = $this->addate[$this->ddate];
		$mon = $this->amdate[$this->mdate];
		$year = $this->ydate;
		$h = $this->hours;
		$i = $this->minits;

		if($format == "1"){ //DayMonYear
			$day = $this->addate[$this->ddate];
			$mon = $this->amdate[$this->mdate];
			$year = $this->ydate;
			$rusdate = "$day $mon, $year";
			return $rusdate;
		} elseif($format == "2"){ //HourMinSec
			$h = $this->hours;
			$i = $this->minits;
			$s = $this->seconds;
			$rusdate = "$h:$i";
			return $rusdate;
		} elseif($format == "3"){ //DayMonYearHourMin
			$day = $this->addate[$this->ddate];
			$mon = $this->amdate[$this->mdate];
			$year = $this->ydate;
			$h = $this->hours;
			$i = $this->minits;
			$rusdate = "$day $mon $year, $h:$i";
			return $rusdate;
		} elseif($format == "4"){ //DMY
			$day = $this->addate[$this->ddate];
			$mon = $this->amdate[$this->mdate];
			$year = $this->ydate;
			$rusdate = "$day $mon $year";
			return $rusdate;
			return $rusdate;
		} elseif($format == "5"){ //DMY
			$rusdate = "$df.$mf.$yf";
			return $rusdate;
		} elseif($format == "6"){ //DMY
			$day1 = $this->addate[$df1];
			$day2 = $this->addate[$df2];
			$mon1 = $this->amdate[$mf1];
			$mon2 = $this->amdate[$mf2];
			$year = $yf1;
			if ($mon1 == $mon2 && $day1 == $day2) $rusdate = "$day1 $mon1 $year";
			elseif ($mon1 == $mon2 && $day1 != $day2) $rusdate = "$day1-$day2 $mon1 $year";
			else $rusdate = "$day1 $mon1 - $day2 $mon2 $year";
			return $rusdate;
		}
	}

	/**
	 *
	 * @param String $start - Y-m-d
	 * @param String $end  - Y-m-d
	 * @return String   date-date
	 */
	function diapazon($start,$end){
	    $st=trim($this->qdate($start),':, ');
	    $en=trim($this->qdate($end),':, ');
	    list($a[0],$a[1],$a[2])=  explode(" ", $st);
	    list($b[0],$b[1],$b[2])=  explode(" ", $en);
	    if($a[2]!=$b[2])
	        return $a[0]." ".$a[1]." ".$a[2]."-".$b[0]." ".$b[1]." ".$b[2];
	    if($a[1]!=$b[1])
	        return $a[0]." ".$a[1]."-".$b[0]." ".$b[1]." ".$b[2];
	    if($a[0]!=$b[0])
	        return $a[0]."-".$b[0]." ".$b[1]." ".$b[2];
	        return $a[0]." ".$b[1]." ".$b[2];
	}
}
?>