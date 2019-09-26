<?

    const DEBUG = false;
    
    // Time thresholds
    $threshold = array(
        "warning" => 60*60*24*2, // 2 days
        );
        
    $taskStatus = array(
        0 => "Not Complete",
        1 => "Complete",
        );
    
    $DB = array(
    'HOST' => 'localhost',
    'USER' => 'mbedynek_web',
    'PASS' => 'w-pF#Q)Q=0F2',
    'NAME' => 'mbedynek_tasker',
    );

    $pdo_opts = [
        PDO::ATTR_EMULATE_PREPARES   => false, 
            // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
            //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
            //make the default fetch be an associative array
    ];
?>
