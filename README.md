# Email Obfuscator

Effective email obfuscation in PHP

## Background

http://www.celticproductions.net/articles/10/email/php+email+obfuscator.html

I've created Composer package from above code with minor additions (code clean-up, random
variable names).

## Usage

```php
// helper function
obfuscate_email('contact@sample.com');
obfuscate_email('contact@sample.com', 'Contact us');

// class
\Kminek\EmailObfuscator::obfuscate('contact@sample.com');
\Kminek\EmailObfuscator::obfuscate('contact@sample.com', 'Contact us');
```
