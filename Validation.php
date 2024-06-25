<?php
class Validation
{
    public function check_empty($data, $fields)
    {
        $msg = null;
        foreach ($fields as $value) {
            if (empty($data[$value])) {
                $msg .= "$value field empty <br />";
            }
        }
        return $msg;
    }

    public function is_quantity_valid($quantity)
    {

        if (preg_match("/^[0-9]+$/", $quantity)) {
            return true;
        }
        return false;
    }

    public function is_category_valid($category)
    {

        if (filter_var($category, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    public function is_date_valid($date)
    {
        // Check if the date is in YYYY-MM-DD format
        $pattern = "/^\d{4}-\d{2}-\d{2}$/";
        if (preg_match($pattern, $date)) {
            // Check if the date is a valid date
            $parts = explode('-', $date);
            if (checkdate($parts[1], $parts[2], $parts[0])) {
                return true;
            }
        }
        return false;
    }
}