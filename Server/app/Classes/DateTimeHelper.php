<?php namespace App\Classes;

use DateTime;
use Exception;

class DateTimeHelper
{
    /**
     * Just a persian date like ۱۳۹۴/۰۵/۱۳
     */
    const DATE = 0;

    /**
     * Just a persian time like ۱۶:۲۰:۰۰
     */
    const TIME = 1;

    /**
     * A persian datetime like ۱۳۹۴/۰۵/۱۳ ۱۶:۲۰:۰۰
     */
    const DATETIME = 2;

    /**
     * Type of originalInput
     */
    protected $type;

    /**
     * Origianl datetime
     *
     * @var string
     */
    protected $originalInput;

    /**
     * Parsed original datetime to DateTime
     *
     * @var DateTime
     */
    protected $dateTime;

    /**
     * Hour when type is self::TIME
     */
    protected $hour;

    /**
     * Minute when type is self::TIME
     */
    protected $minute;

    public function __construct($type, $input)
    {
        $this->type = $type;
        $this->originalInput = $input;

        switch ($type) {
            case self::DATETIME:
                $this->processDateTime();
                break;

            case self::DATE:
                $this->processDate();
                break;

            case self::TIME:
                $this->processTime();
                break;
        }
    }

    /**
     * Convert persian datetime to DateTime
     *
     * @return void
     */
    public function processDateTime()
    {
        $dateTime = tr_num($this->originalInput);
        $dateTime = $this->seperator($dateTime);
        if ($dateTime === false) return null;

        $date = jalali_to_gregorian($dateTime['year'], $dateTime['month'], $dateTime['day']);
        $date = new DateTime("{$date[0]}-{$date[1]}-{$date[2]}");
        $date->setTime($dateTime['hour'], $dateTime['minute']);

        $this->dateTime = $date;
    }

    /**
     * Convert persian date to DateTime
     *
     * @return void
     */
    public function processDate()
    {
        $dateTime = tr_num($this->originalInput);
        $dateTime = $this->seperator($dateTime);
        if ($dateTime === false) return null;

        $date = jalali_to_gregorian($dateTime['year'], $dateTime['month'], $dateTime['day']);
        $date = new DateTime("{$date[0]}-{$date[1]}-{$date[2]}");

        $this->dateTime = $date;
    }

    /**
     * Convert persian time to DateTime
     *
     * @return void
     */
    public function processTime()
    {
        $dateTime = tr_num($this->originalInput);
        $dateTime = DateTime::createFromFormat('H:i', $dateTime);
        if ($dateTime === false) return null;

        $this->hour = $dateTime->format('H');
        $this->minute = $dateTime->format('i');
    }

    /**
     * Seperator for jalali datetime
     */
    public function seperator($dateTime)
    {
        $patterns = array(
            "YmdHis" => "/(\d{4})\/(\d{2})\/(\d{2})\s\s(\d{2}):(\d{2}):(\d{2})/",
            "Ymd" => "/(\d{4})\/(\d{1,2})\/(\d{1,2})/",
        );

        $result = false;
        foreach ($patterns as $output => $pattern) {
            $s;
            $patternOutput = $output;
            preg_match($pattern, $dateTime, $s);
            if (count($s) === 0) continue;
            else {
                $result = true;
                break;
            }
        }

        if ($result) {
            switch ($patternOutput) {
                case 'YmdHis':
                    return ['year' => $s[1], 'month' => $s[2], 'day' => $s[3], 'hour' => $s[4], 'minute' => $s[5], 'second' => $s[6]];
                    break;

                case 'Ymd':
                    return ['year' => $s[1], 'month' => $s[2], 'day' => $s[3]];
                    break;
            }
        }

        return false;
    }

    /**
     * Set time for current dateTime
     *
     * @param DateTimeHelper $dth self must not a TIME type of DateTimeHelper
     *
     * @return $this
     * @throws Exception
     */
    public function setTime(DateTimeHelper $dth)
    {
        if ($this->type == self::TIME) throw new Exception('A TIME type of DateTimeHelper cannot use setTime() method');

        $this->dateTime->setTime($dth->getHour(), $dth->getMinute());

        return $this;
    }

    /**
     * Add minutes to current dateTime
     * @param DateTimeHelper $dth
     * @return \DateInterval|false
     * @throws Exception
     */
    public function diff(DateTimeHelper $dth)
    {
        if ($this->type == self::TIME || $dth->getType() == self::TIME) throw new Exception('A TIME type of DateTimeHelper cannot use diff() method, [BOTH].');

        return $this->dateTime->diff($dth->getDateTime());
    }

    /**
     * Add days to current dateTime
     *
     * @param int $days count of days
     *
     * @return $this
     */
    public function addDay($days = 1)
    {
        if ($this->type == self::TIME) throw new Exception('A TIME type of DateTimeHelper cannot use addDay() method.');

        $this->dateTime->modify("+$days day");

        return $this;
    }

    /**
     * Sub days to current dateTime
     *
     * @param int $days count of days
     *
     * @return $this
     */
    public function subDay($days = 1)
    {
        if ($this->type == self::TIME) throw new Exception('A TIME type of DateTimeHelper cannot use subDay() method.');

        $this->dateTime->modify("-$days day");

        return $this;
    }

    /**
     * Add minutes to current dateTime
     *
     * @param DateTimeHelper $dth
     *
     * @return $this
     */
    public function addMinutes(DateTimeHelper $dth)
    {
        if ($this->type !== self::TIME) {
            $this->dateTime->modify("+{$dth->toMinutes()} minute");
        } else {
            throw new Exception('TODO: Add support for TIME type');
        }

        return $this;
    }

    /**
     * Sub minutes to current dateTime
     *
     * @param DateTimeHelper $dth
     *
     * @return $this
     */
    public function subMinutes(DateTimeHelper $dth)
    {
        if ($this->type !== self::TIME) {
            $this->dateTime->modify("-{$dth->toMinutes()} minute");
        } else {
            throw new Exception('TODO: Add support for TIME type');
        }

        return $this;
    }

    public function modify($modify)
    {
        if ($this->type !== self::TIME) {
            $this->dateTime->modify($modify);
        } else {
            throw new Exception('TODO: Add support for TIME type');
        }

        return $this;
    }

    /**
     * Sum hours and minutes and retuern it.
     *
     * @return int
     */
    public function toMinutes()
    {
        if ($this->type == self::TIME) {
            return ($this->hour * 60) + $this->minute;
        } else {
            throw new Exception('TODO: Add support for DATE and DATETIME support');
        }
    }

    /**
     * Get hour of datetime
     *
     * @return int
     * @throws Exception
     */
    public function getHour()
    {
        if ($this->type == self::TIME) {
            return $this->hour;
        } else {
            throw new Exception('TODO: Add support for DATE and DATETIME support');
        }
    }

    /**
     * Get minute of datetime
     * @return int
     * @throws Exception
     */
    public function getMinute()
    {
        if ($this->type == self::TIME) {
            return $this->minute;
        } else {
            throw new Exception('TODO: Add support for DATE and DATETIME support');
        }
    }

    /**
     * @param string $format
     * @return string
     * @throws Exception
     */
    public function format($format = "Y-m-d H:i:s")
    {
        if ($this->type == self::TIME) throw new Exception('A TIME type of DateTimeHelper cannot use format() method');

        return $this->dateTime->format($format);
    }

    /**
     * @return DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @return int type of DateTimeHelper
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * A dateTime string to jalali
     *
     * @param string $datTime
     *
     * @return string
     */
    public static function toJalali($dateTime, $withTime = true)
    {
        if (is_null($dateTime)) return '';

        $dateTime = new DateTime($dateTime);

        $date = jdate('Y/m/d', $dateTime->getTimestamp());

        if ($withTime) {
            $time = $dateTime->format('H:i:s');
            $time = tr_num($time, 'fa');
            return $date.'  '.$time;
        }
        return $date;
    }

    /**
     * A dateTime string to jalali
     *
     * @param string $datTime
     *
     * @return string
     */
    public static function convertToJalali($dateTime, $format, $inPersian)
    {
        if (is_null($dateTime)) return '';

        $dateTime = new DateTime($dateTime);

        $l = 'fa';
        if (!$inPersian) $l = 'en';

        $date = jdate($format, $dateTime->getTimestamp(), '', 'Asia/Tehran', $l);

        return $date;
    }

    public static function getLengthAtHours($from, $to)
    {
        $from = new DateTime($from);
        $to = new DateTime($to);

        $i = $from->diff($to);
        $hours = ($i->h) + ($i->days * 24);

        return ['h' => $hours, 'm' => $i->i];
    }

    public static function ago(int $timestamp)
    {
        $currentTime     = time();
        $time_elapsed     = $currentTime - $timestamp;
        $seconds     = $time_elapsed ;
        $minutes     = round($time_elapsed / 60 );
        $hours         = round($time_elapsed / 3600);
        $days         = round($time_elapsed / 86400 );
        $weeks         = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years         = round($time_elapsed / 31207680 );

        // Seconds
        if($seconds <= 60) {
            if ($seconds  == 0)
                return 'همین حالا';

            return "$seconds ثانیه قبل";
        }

        //Minutes
        else if($minutes <=60){
            if($minutes==1)
                return "یک ماه پیش";
            else
                return "$minutes دقیقه قبل";
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "یک ساعت قبل";
            }else{
                return "$hours ساعت قبل";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "دیروز";
            }else{
                return "$days روز قبل";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "یک هفته پیش";
            }else{
                return "$weeks هفته پیش";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "یک ماه پیش";
            }else{
                return "$months ماه پیش";
            }
        }
        //Years
        else{
            if($years==1){
                return "یک سال پیش";
            }else{
                return "$years سال پیش";
            }
        }
    }

    public function __clone()
    {
        $this->dateTime = clone $this->dateTime;
    }
}
