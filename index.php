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
    <p>This is obfuscated email: <?php echo EmailObfuscator::obfuscate('kontakt@kminek.pl'); ?></p>
    <pre><?php echo htmlentities(EmailObfuscator::obfuscate('kontakt@kminek.pl')); ?></pre>
</body>
</html>
