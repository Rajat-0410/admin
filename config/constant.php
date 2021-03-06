<?php

return [

    /*
    |--------------------------------------------------------------------------
    | No Reocrds Available
    |--------------------------------------------------------------------------
    | Global text for all pages to show no records present
    |
    */
    'NO_RECORDS_FOUND' => 'No Record/s Available',
    
    /*
    |--------------------------------------------------------------------------
    | No Reocrds Available
    |--------------------------------------------------------------------------
    | Global text for all pages to show no records present
    |
    */
    'PAGINATE' => 20,
    
    /*
    |--------------------------------------------------------------------------
    | Status Array
    |--------------------------------------------------------------------------
    | Global statuses
    |
    */
    'STATUS' => [
        0 => 'In-Active',
        1 => 'Active'
    ],
        
    /*
    |--------------------------------------------------------------------------
    | Menu Types Array
    |--------------------------------------------------------------------------
    | For menu group types
    |
    */
    'MENU_TYPES' => [
        1 => 'Main',
        2 => 'Header',
        3 => 'Sub-header',
        4 => 'Footer',
        5 => 'Sub-Footer',
        6 => 'Custom 1',
        7 => 'Custom 2'
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Image Accepted
    |--------------------------------------------------------------------------
    | Global text for all pages to show image accepted
    |
    */
    // 'IMAGE_ACCEPTED' => 'Jpg,Jpeg,png,gif',
    'ALLOW_FILE_TYPE_TEXT' => 'Allow file type',
    'File_TYPE' => 'jpg,jpeg,png,gif',

    /*
    |--------------------------------------------------------------------------
    | cloudfront Image Accepted  
    |--------------------------------------------------------------------------
    | Global text for all pages to show image accepted
    |
    */
    'CLOUD_FRONT_ASSET_URL' => '',

    /*
    |--------------------------------------------------------------------------
    | Google Map Key
    |--------------------------------------------------------------------------
    | For Google Maps
    |
    */
    'GOOGLE_MAP_KEY' => '',
    
    /*
    |--------------------------------------------------------------------------
    | APP ID'S
    |--------------------------------------------------------------------------
    | For Social
    |
    */
    'APP_ID' => array(
        'FACEBOOK' => ''
    ),
    
    /*
    |--------------------------------------------------------------------------
    | Support Email Ids
    |--------------------------------------------------------------------------
    | For 
    |
    */
    'ERROR_EMAIL_TO' => [''],
    
    /*
    |--------------------------------------------------------------------------
    | AWS S3 Bucket Upload Path
    |--------------------------------------------------------------------------
    | For 
    |
    */
    'AWS_S3_UPLOAD_PATH' => '',
    
    /*
    |--------------------------------------------------------------------------
    | Contact Us Email Ids
    |--------------------------------------------------------------------------
    | For
    |
    */
    'CONTACT_US_EMAIL_TO' => [''],
    'SUPPORT_EMAIL_BCC' => [''],

    /*
    |--------------------------------------------------------------------------
    | Role Type
    |--------------------------------------------------------------------------
    |
    */
	'ADMIN' => 2,
	'PATIENT' => 3,
	'DOCTOR' => 4,
    
];
