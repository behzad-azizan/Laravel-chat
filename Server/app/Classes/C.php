<?php


class C
{
    const SEX_MALE = 'male';
    const SEX_FEMALE = 'female';
    const SEX_OTHER = 'other';

    const STATUS_PENDING = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    const DATE_FORMAT = 'Y-m-d';

    const TIME_FORMAT = 'H:i';

    const TIME_DETAILED_FORMAT = 'H:i:s';

    const YES = 'yes';
    const NO = 'no';

    const MARITAL_SINGLE = 'single';
    const MARITAL_MARRIED = 'married';

    public static function getSexes()
    {
        return [
            self::SEX_MALE => 1,
            self::SEX_FEMALE => 0,
            self::SEX_OTHER => -1
        ];
    }

    /**
     * @return int[]
     */
    public static function getYesNoStatuses()
    {
        return [
            self::YES => 1,
            self::NO => 0
        ];
    }

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            'active' => self::STATUS_ACTIVE,
            'pending' => self::STATUS_PENDING,
            'inactive' => self::STATUS_INACTIVE
        ];
    }

    /**
     * @return int[]
     */
    public static function getMaritalStatuses()
    {
        return [
            self::MARITAL_MARRIED => 2,
            self::MARITAL_SINGLE => 1
        ];
    }
}
