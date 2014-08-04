<?php

$sapi_type = php_sapi_name();

if (!preg_match('/cli|cgi/', $sapi_type)) {
    exit('Please test script on CLI mode!');
}

// include twitter API
require_once(dirname(__FILE__) . '/tmhOAuth/tmhOAuth.php');

$tmhOAuth = new tmhOAuth(array(
    'consumer_key' => 'THFmF2pztkchaWBHNFUw6g',
    'consumer_secret' => 'dyFOfeRn41aC2dexNuTUrJP8sPcUDfCSYH5huoU6d0',
    'token' => '505799272-xYtOcU0TVphRc0hLOqjSte0TCwlXtR0gek4Y7iLv',
    'secret' => 'US3yYLe7PFPTBxphgW0wGxbNeZDGc0LXg5EefvUMI',
        ));

echo "\n Twitter username :";
$username = trim(fgets(STDIN));


// configuration paramter
$params = array(
    'screen_name' => $username,
    'include_rts' => 'true',
    'exclude_replies' => 'true',
    'count' => 5,
);

$response_code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline.json'), $params);

if ($response_code == 200) {
    $data = json_decode($tmhOAuth->response['response'], true);

    foreach ($data as $tweet) {
        echo "\n" . $tweet['text'];
        echo "\n username: " . $tweet['user']['name'];
        echo "\n followers: " . $tweet['user']['followers_count'];
    }
} else {
    echo 'Bad tmhOAuth response code.';
}