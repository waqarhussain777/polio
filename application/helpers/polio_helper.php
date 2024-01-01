<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('is_household_selected')) {
    function is_household_selected($householdId, $currentWorkerId = null) {
        // Get CI instance
        $CI =& get_instance();

        // Load model if not already loaded
        $CI->load->model('Main_model');

        // Call a method from the Household_model to check the household status
        return $CI->Main_model->check_household_selection($householdId, $currentWorkerId);
    }
}

