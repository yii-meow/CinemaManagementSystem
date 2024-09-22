<?php
/**
 * Author: Chong Kah Yan
 */
namespace App\controllers;

use App\core\Controller;

class ReportManage
{
    use Controller;
    public function index(){

        // Check if user is logged in and has the SuperAdmin role
        if (isset($_SESSION['admin']) && $_SESSION['admin']['role'] === 'SuperAdmin') {
            // Allow access to the Report Manage page
            $this->view("Admin/Report/ReportManage");
        } else {
            // Redirect to permission denied page if user is not a SuperAdmin
            $this->view("Admin/403PermissionDenied");
        }
    }
}