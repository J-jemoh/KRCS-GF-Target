<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Database Settings
    |--------------------------------------------------------------------------
    */

    'loggerDatabaseConnection'  => 'mysql',
    'loggerDatabaseTable'       => 'laravel_logger_activity',

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Roles Settings - (laravel roles not required if false)
    |--------------------------------------------------------------------------
    */

    'rolesEnabled'   => false,
    'rolesMiddlware' => 'role:admin',

    /*
    |--------------------------------------------------------------------------
    | Enable/Disable Laravel Logger Middlware
    |--------------------------------------------------------------------------
    */

    'loggerMiddlewareEnabled'   => true,
    'loggerMiddlewareExcept'    => [], // Assuming you don't want any exceptions initially

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Authentication Listeners Enable/Disable
    |--------------------------------------------------------------------------
    */
    'logAllAuthEvents'      => false,   // May cause a lot of duplication.
    'logAuthAttempts'       => false,   // Successful and Failed -  May cause a lot of duplication.
    'logFailedAuthAttempts' => true,    // Failed Logins
    'logLockOut'            => true,    // Account Lockout
    'logPasswordReset'      => true,    // Password Resets
    'logSuccessfulLogin'    => true,    // Successful Login
    'logSuccessfulLogout'   => true,    // Successful Logout

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Search Enable/Disable
    |--------------------------------------------------------------------------
    */
    'enableSearch'      => true,

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Search Parameters
    |--------------------------------------------------------------------------
    */
    'searchFields'  => 'description,user,method,route,ip',

    /*
    |--------------------------------------------------------------------------
    | Laravel Default Models
    |--------------------------------------------------------------------------
    */

    'defaultActivityModel' => 'jeremykenedy\LaravelLogger\App\Models\Activity',
    'defaultUserModel'     => 'App\Models\User',

    /*
    |--------------------------------------------------------------------------
    | Laravel Default User ID Field
    |--------------------------------------------------------------------------
    */

    'defaultUserIDField' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Disable automatic Laravel Logger routes
    | If you want to customise the routes the package uses, set this to true.
    | For more information, see the README.
    |--------------------------------------------------------------------------
    */

    'disableRoutes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Pagination Settings
    |--------------------------------------------------------------------------
    */
    'loggerPaginationEnabled' => false,
    'loggerPaginationPerPage' => 25,

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Databales Settings - Not recommended with pagination.
    |--------------------------------------------------------------------------
    */

    'loggerDatatables'              => true,
    'loggerDatatablesCSScdn'        => 'https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css',
    'loggerDatatablesJScdn'         => 'https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js',
    'loggerDatatablesJSVendorCdn'   => 'https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js',

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Dashboard Settings
    |--------------------------------------------------------------------------
    */

    'enableSubMenu'     => true,
    'enableDrillDown'   => true,

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Failed to Log Settings
    |--------------------------------------------------------------------------
    */

    'logDBActivityLogFailuresToFile' => true,

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Flash Messages
    |--------------------------------------------------------------------------
    */

    'enablePackageFlashMessageBlade' => true,

    /*
    |--------------------------------------------------------------------------
    | Blade settings
    |--------------------------------------------------------------------------
    */

    // The parent Blade file
    'loggerBladeExtended'       => 'layouts.admin',

    // Switch Between bootstrap 3 `panel` and bootstrap 4 `card` classes
    'bootstapVersion'           => '4',

    // Additional Card classes for styling -
    // See: https://getbootstrap.com/docs/4.0/components/card/#background-and-color
    // Example classes: 'text-white bg-primary mb-3'
    'bootstrapCardClasses'      => '',

    // Blade Extension Placement
    'bladePlacement'            => 'yield',
    'bladePlacementCss'         => 'template_linked_css',
    'bladePlacementJs'          => 'footer_scripts',

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Dependencies - allows for easier builds into other projects
    |--------------------------------------------------------------------------
    */

    // jQuery
    'enablejQueryCDN'           => true,
    'JQueryCDN'                 => 'https://code.jquery.com/jquery-3.2.1.slim.min.js',

    // Bootstrap
    'enableBootstrapCssCDN'     => true,
    'bootstrapCssCDN'           => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'enableBootstrapJsCDN'      => true,
    'bootstrapJsCDN'            => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
    'enablePopperJsCDN'         => true,
    'popperJsCDN'               => 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',

    // Font Awesome
    'enableFontAwesomeCDN'      => true,
    'fontAwesomeCDN'            => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',

    // LiveSearch for scalability
    'enableLiveSearch'          => true,

];

