<?php
$dsn = "mysql:host=gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com;port=4000;dbname=sys";
$username = "2wMIUWWQBdRFLNB.root";
$password = "zSsX0gZwO8uLVS2m";
$options = [
    PDO::MYSQL_ATTR_SSL_CA => "c:\\Users\\Prince\\Desktop\\last-mile-delivery\\cacert.pem",
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
    echo "Connected successfully with PDO!\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}
