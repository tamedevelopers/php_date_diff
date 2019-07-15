# php_date_diff
PHP TIME difference with Weeks, mins, years ago outputs


Use case defined


    |--------------------------------------------------------------------------
    | You don't instantiate static class, just call the class directly with the class name or assign to a var.
    |


Best date format type: 2019-03-25 as YYYY-MM-DD


    |
    | (HOW TO USE)
    | echo Date::getWeeks("2019-03-25");
    | echo Date::getWeeks(1553472000);
    
    | *************************************
    
    | $date = Date::getWeeks(1553472000);
    | echo $date;
    |
    
    | ************************************* 
    
    | //return arrays
    | Date::getFullDates("2019-03-25");
    | Date::getFullDates(1553472000); 
