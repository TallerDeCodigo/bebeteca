<?php
ini_set('display_errors', 1);
error_reporting(~0);

include('Google_Client.php');              
include('contrib/Google_AnalyticsService.php');

$keyfile = '141071fb5c74db10a16ae6cfb76fbb482d3e6f0c-privatekey.p12';

// Initialise the Google Client object
$client = new Google_Client();
$client->setApplicationName('FutbolTotal más visitados');

$client->setAssertionCredentials(
    new Google_AssertionCredentials(
        '1036156140098-boioktpuva2668nereflb19hgl55j9ej@developer.gserviceaccount.com',
        array('https://www.googleapis.com/auth/analytics.readonly'),
        file_get_contents($keyfile)
    )
);

// Get this from the Google Console, API Access page
$client->setClientId('1036156140098-boioktpuva2668nereflb19hgl55j9ej.apps.googleusercontent.com');
$client->setAccessType('offline_access');
$analytics = new Google_AnalyticsService($client);

// We have finished setting up the connection,
// now get some data and output the number of visits this week.

// Your analytics profile id. (Admin -> Profile Settings -> Profile ID)
$analytics_id   = 'ga:485178';
$ayer      = date('Y-m-d', strtotime('-1 day'));
$hoy          = date('Y-m-d');


/*
$endDate = date( 'Y-m-d' ); $startDate = date( 'Y-m-d', strtotime( '-1 day' ) ); 
"ids" value comes from this URL in the last portion of the URL, after the "p": https://www.google.com/analytics/web/#dashboard/default/a381759w192893p9122283/ Or use http://code.google.com/apis/analytics/docs/gdata/gdataExplorer.html to show the GA ID for each your Analytics accounts "key" is the API key that you'd set up in the Google APIs console, restricted to certain IP addresses
$url = 'https://www.googleapis.com/analytics/v3/data/ga?' . 'key=AIzaSyBgKpenjBz4-TZBTr0ugOjEefV39ZLu-f8&ids='.$analytics_id.'&start-date=' . $startDate . '&end-date=' . $endDate . '&metrics=ga:pageviews&sort=-ga:pageviews&dimensions=ga:pagePath&max-results=10'; 
$ch = curl_init(); 
$timeout = 5; 
curl_setopt( $ch, CURLOPT_URL, $url ); 
curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer ' . $result['access_token'] ) ); 
curl_setopt( $ch, CURLOPT_RETURNTRANSFER,1 ); 
curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout ); 
$data = curl_exec( $ch ); 
curl_close( $ch ); 
$mostViewedRaw = json_decode( $data, true ); 
var_dump( $mostViewedRaw );
*/


/*
try {
    $results = $analytics->data_ga->get($analytics_id,$ayer,$hoy,'ga:uniquePageviews');
                        
        
    echo '<b>Vistas unicas:</b> ';
    echo $results['totalsForAllResults']['ga:uniquePageviews'];
    var_dump($results);
} catch(Exception $e) {
    echo 'Error: - ' . $e->getMessage();
}
*/



    $results = $analytics->data_ga->get($analytics_id,$ayer,$hoy,'ga:uniquePageviews',
                array(
                    'dimensions' => 'ga:hostname, ga:pagePath, ga:pageTitle',
                    'sort' => '-ga:uniquePageviews',
                    'max-results' => '6'
                
                )
                );
                        
        
    //echo '<b>Vistas unicas:</b> ';
    echo $results['totalsForAllResults']['ga:uniquePageviews'];
    echo '<br />';
    
    
    $resultados = $results['rows'];
    
    
    print_r($resultados);
    echo '<br />';
    $i = 0;
    foreach($resultados as $resultado){
	    if($resultado[1] != '/'){
		    foreach($resultado as $dato){
			    echo $dato;
			    echo '<br />';
		    };
		    echo '<br />';
		    echo '<br />';
	    };
    };

    
    echo '<br /><br />';
    var_dump($results);





?>