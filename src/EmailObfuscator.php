<?php

namespace Kminek;

/**
 * EmailObfuscator
 */
class EmailObfuscator
{
    /**
     * Obfuscate email
     *
     * @param  string $email
     * @param  null|string $text
     * @param  array $options
     * @return string
     */
    public static function obfuscate($email, $text = null, $options = [])
    {
        $defaults = [
            'noscript' => 'Enable JavaScript to see this email address',
        ];
        $options = array_merge($defaults, $options);
        $email = strtolower($email);
        $coded = '';
        $unmixedkey = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.@-';
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
        $vars = [];
        foreach (['coded', 'key', 'link', 'text', 'ltr'] as $var) {
            do {
                $rnd = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 10);
            } while (in_array($rnd, array_values($vars)));
            $vars[$var] = $rnd;
        }
        $text = ($text == null) ? "var {$vars['text']} = {$vars['link']}" : "var {$vars['text']} = '{$text}'";
        $attrs = '';
        foreach ($options as $k => $v) {
            if (in_array($k, array_keys($defaults))) {
                continue;
            }
            $attrs .= " {$k}=\"{$v}\"";
        }
        $javascript = <<<JAVASCRIPT
<script type="text/javascript" language="javascript">
<!--
// Email obfuscator script 2.1 by Tim Williams, University of Arizona
// Random encryption key feature by Andrew Moulden, Site Engineering Ltd
// This code is freeware provided these four comment lines remain intact
// A wizard to generate this code is at http://www.jottings.com/obfuscator/
(function(){
    var {$vars['coded']} = '{$coded}';
    var {$vars['key']} = '{$cipher}';
    var {$vars['link']} = '';
    for (var i=0; i < {$vars['coded']}.length; i++) {
        if ({$vars['key']}.indexOf({$vars['coded']}.charAt(i)) == -1) {
            var {$vars['ltr']} = {$vars['coded']}.charAt(i);
            {$vars['link']} += ({$vars['ltr']});
        } else {
            var {$vars['ltr']} = ({$vars['key']}.indexOf({$vars['coded']}.charAt(i)) - {$vars['coded']}.length + {$vars['key']}.length) % {$vars['key']}.length;
            {$vars['link']} += ({$vars['key']}.charAt({$vars['ltr']}));
        }
    }
    {$text};
    document.write('<a href="mailto:' + {$vars['link']} + '"{$attrs}>' + {$vars['text']} + '</a>');
})();
//-->
</script><noscript>{$options['noscript']}</noscript>
JAVASCRIPT;
        return $javascript;
    }
}
