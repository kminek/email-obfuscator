<?php

namespace Kminek;

/**
 * EmailObfuscator
 */
class EmailObfuscator
{
    public static function obfuscate($email)
    {
        $email = strtolower($email);
        $coded = '';
        $unmixedkey = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.@';
        $inprogresskey = $unmixedkey;
        $mixedkey = '';
        $unshuffled = strlen($unmixedkey);
        for ($i = 0; $i < strlen($unmixedkey); $i++) {
            $ranpos = rand(0, $unshuffled - 1);
            $nextchar = $inprogresskey[$ranpos];
            $mixedkey .= $nextchar;
            $before = substr($inprogresskey, 0, $ranpos);
            $after = substr($inprogresskey, $ranpos + 1, $unshuffled - ($ranpos + 1));
            $inprogresskey = $before . '' . $after;
            $unshuffled -= 1;
        }
        $cipher = $mixedkey;
        $shift = strlen($email);
        for ($j = 0; $j < strlen($email); $j++) {
            if (strpos($cipher, $email{$j}) == -1) {
                $chr = $email[$j];
                $coded .= $email[$j];
            } else {
                $chr = (strpos($cipher, $email[$j]) + $shift) % strlen($cipher);
                $coded .= $cipher[$chr];
            }
        }
        $javascript = <<<JAVASCRIPT
<script type="text/javascript" language="javascript">
<!--
(function(){
    document.write('test!');
})();
//-->
</script>
JAVASCRIPT;
        return $javascript;
    }
}
