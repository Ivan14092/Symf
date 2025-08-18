<?php
$url = "https://api.quotable.io/random";

$ch = curl_init ();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close ($ch);

$data = json_decode ($response, true);

echo "Цитата:" . $data['content'] .PHP_EOL;
echo "Автор" . $data['author'] . PHP_EOL;
)
<?php
