# Email Obfuscator

Effective email obfuscation in PHP

## Background

http://www.celticproductions.net/articles/10/email/php+email+obfuscator.html

I've created Composer package from above code with minor additions (code clean-up, random
variable names).

## Usage

```php
// helper function
echo obfuscate_email('contact@sample.com');
echo obfuscate_email('contact@sample.com', 'Contact us');

// class
echo \Kminek\EmailObfuscator::obfuscate('contact@sample.com');
echo \Kminek\EmailObfuscator::obfuscate('contact@sample.com', 'Contact us');
```
