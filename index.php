<?php

require 'vendor/autoload.php';

use Kminek\EmailObfuscator;

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email Obfuscator</title>
</head>
<body>
    <h1>Email Obfuscator</h1>
    <?php
    $email1 = EmailObfuscator::obfuscate('contact@sample.com');
    ?>
    <p>This is obfuscated email: <?php echo $email1; ?></p>
    <pre><?php echo htmlentities($email1); ?></pre>
    <hr>
    <?php
    $email2 = obfuscate_email('contact@sample.com', 'Contact us', ['class' => 'some-class', 'id' => 'some-id', 'noscript' => 'Custom noscript contents']);
    ?>
    <p>This is obfuscated email: <?php echo $email2; ?></p>
    <pre><?php echo htmlentities($email2); ?></pre>
</body>
</html>
