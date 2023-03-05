<?php
/** set your paypal credential **/

$config['client_id'] = 'ASe416sAb6ZVamzixbvs0KQn1AKb3w75nWLkyh9S1b_T9QqXiYcADnatHyJajtSBeSVwUxFFH8pGOPK4';
$config['secret'] = 'EK7mxlQWcT6_lRrTAxgz8EpE6jfSG2zPhKJ8NZh07iEuxwdgds6psCnaWw8aBC2GIm5FpGSgpg0RpJ1A';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);
