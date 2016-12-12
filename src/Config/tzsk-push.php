<?php

return [

    /**
     * Default Connection Name.
     *
     * Here you can define Connection name of the
     * below mentioned connections to use.
     */
    'default' => 'sandbox',

    /**
     * Connection options available for Pushwoosh.
     *
     * Here you can specify as many connection you want.
     */
    'connections' => [

        /**
         * Sandbox App Credentials.
         *
         * Credentials to use for testing.
         */
        'sandbox' => [

            /**
             * APP KEY you create from Pushwoosh.
             */
            'key' => 'APP-API-KEY',

            /**
             * TOKEN you get from Pushwoosh.
             */
            'token' => 'APP-API-TOKEN',

        ],

        /**
         * Production App Credentials.
         *
         * Credentials to use for Production.
         */
        'production' => [

            'key' => 'APP-API-KEY',

            'token' => 'APP-API-TOKEN',

        ],

    ],

    /**
     * General Settings.
     *
     * These are some general settings that you can fill to have consistency of the push.
     * You can also override these settings on runtime.
     */
    'settings' => [

        'icon' => 'HTTP-ICON-URL',

        'title' => 'DEFAULT-PUSH-TITLE',

        'body' => 'DEFAULT-PUSH-BODY',

        'sound' => 'PUSH-SOUND',

        'vibration' => 1,

        'priority' => 1,

        'ibc' => '#33bdfb',

    ],

];
