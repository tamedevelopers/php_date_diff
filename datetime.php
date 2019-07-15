<?php

/*
|--------------------------------------------------------------------------
| Created by Fredrick Peter
|--------------------------------------------------------------------------
| Email: tekhdevteam@gmail.com
| Website: tekhdev.com
| Github: tekhdev
*/


class Date{
    protected static $newDate;
    protected static $convertdate;
    protected static $getdate;
    
    protected static $weeks;
    protected static $case;
    
    protected static function init(){
        //execute your static __contruct like code here and call right inside any func
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | Returns assoc arrays of complete date info
    |--------------------------------------------------------------------------
    |
    */
    public static function getFullDates($datetocheck){
        /*
        |--------------------------------------------------------------------------
        | Check if value passed is not an int
        |--------------------------------------------------------------------------
        |
        */
        if (!is_int($datetocheck)) {
            $datetocheck = strtotime($datetocheck);
        }
        
        self::$newDate = new DateTime();
        self::$convertdate = date("Y-m-d G:i:s", $datetocheck);
        self::$getdate = self::$newDate->diff(new DateTime(self::$convertdate));
        
        $daysTotal = self::$getdate->days; // return total days
        $year = self::$getdate->y;
        $month = self::$getdate->m;
        $days = self::$getdate->d;
        $hour = self::$getdate->h;
        $mins = self::$getdate->i;
        $seconds = self::$getdate->s;

        return [
            'year' => $year,
            'month' => $month,
            'days' => $days,
            'hour' => $hour,
            'mins' => $mins,
            'sec' => $seconds,
            'total_days' => $daysTotal
        ];
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | Returns formated date query
    |--------------------------------------------------------------------------
    |
    */
    public static function getWeeks($datetocheck){
        /*
        |--------------------------------------------------------------------------
        | Check if value passed is not an int
        |--------------------------------------------------------------------------
        |
        */
        if (!is_int($datetocheck)) {
            $datetocheck = strtotime($datetocheck);
        }
        
        self::$weeks = self::getFullDates($datetocheck);
        
        switch (self::$weeks) {
            // If day is today. Hour is 0 and mins is 0
            case self::$weeks['total_days']===0&&self::$weeks['hour']===0&&self::$weeks['mins']===0:
                self::$case = 'Just now';
                break;
            // If the day is today. Hour is 0 and mins is greater than 0
            case self::$weeks['total_days']===0&&self::$weeks['hour']===0&&self::$weeks['mins']>0:
                self::$case = self::$weeks['mins'] . 'm ' . self::$weeks['sec'] . 's ago';
                break;
            // If the day is today. Hour is greater than 0 and mins is equal to 0
            case self::$weeks['total_days']===0&&self::$weeks['hour']>0&&self::$weeks['mins']===0:
                self::$case = self::$weeks['hour'] . 'h ' . self::$weeks['sec'] . 's ago';
                break;
            // If the day is today. Hour is greater than 0 and mins is greater than 0
            case self::$weeks['total_days']===0&&self::$weeks['hour']>0&&self::$weeks['mins']>=0:
                self::$case = self::$weeks['hour'] . 'h ' . self::$weeks['mins'] . 'm ' . self::$weeks['sec'] . 's ago';
                break;
            // If the day is greater than today and less than 2 days 
            case self::$weeks['total_days']>0&&self::$weeks['total_days']<2:
                self::$case = self::$weeks['total_days'] . 'day ago';
                break;
            // If the day is greater than or equal to 2 and less than 7 days 
            case self::$weeks['total_days']>=2&&self::$weeks['total_days']<7:
                self::$case = self::$weeks['total_days'] . 'days ago';
                break;
            // If the day is greater than or equal to 7 and month is less than 366
            case self::$weeks['total_days']>=7&&self::$weeks['total_days']<366:
                // calculate the days to get the week out - Now we will use the floor to round the num to the lowest numeric figure
                $calWeek = floor(self::$weeks['total_days'] / 7);
                self::$case = $calWeek == 1 ? $calWeek . 'week ago' : $calWeek . 'weeks ago';
                break;
            case self::$weeks['total_days']>=366&&self::$weeks['total_days']<732:
                self::$case = self::$weeks['year'] . 'yr ago';
                break;
            case self::$weeks['total_days']>=732:
                self::$case = self::$weeks['year'] . 'yrs ago';
                break;
        }

        return self::$case;
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | Use case defined
    |--------------------------------------------------------------------------
    | You don't instantiate static class, just call the class directly 
    | with the class name or assign to a var.
    |
    | Best date format type: 2019-03-25 as YYYY-MM-DD
    |
    | (HOW TO USE)
    | echo Date::getWeeks("2019-03-25");
    | echo Date::getWeeks(1553472000);
    | *************************************
    | $date = Date::getWeeks(1553472000);
    | echo $date;
    |
    | ************************************* 
    | 
    | //return arrays
    | Date::getFullDates("2019-03-25");
    | Date::getFullDates(1553472000); 
    |
    |
    |
    */
}
