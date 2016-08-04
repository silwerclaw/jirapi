<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 04.08.16
 * Time: 17:33
 */


return [
    
    'basic' => [

        /*
        |--------------------------------------------------------------------------
        | Jira host
        |--------------------------------------------------------------------------
        | Base host where to send queries. Basucally must be smth like "https://yourcompany.atlassian.net" for cloud
        */

        'host' => env('JIRA_HOST', ''),

         /*
         |--------------------------------------------------------------------------
         | Jira account login
         |--------------------------------------------------------------------------
         | Login of account that will communicate through api
         */

        'login' => env('JIRA_LOGIN', ''),

         /*
         |--------------------------------------------------------------------------
         | Jira password
         |--------------------------------------------------------------------------
         | Password to account that will communicate through api
         */

        'password' => env('JIRA_PASSWORD', '')
        
    ]

    
    
];