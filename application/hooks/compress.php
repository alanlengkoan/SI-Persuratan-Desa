<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function compress()
{
    $CI = &get_instance();

    $buffer = $CI->output->get_output();

    $search = array(
        '#<(img|input)(>| .*?>)#s',
        '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
        '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s',
        '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s',
        '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s',
        '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s',
        '#<(img|input)(>| .*?>)<\/\1\x1A>#s',
        '#(&nbsp;)&nbsp;(?![<\s])#',
        '#&\#(?:10|xa);#',
        '#&\#(?:32|x20);#',
        '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
    );

    $replace = array(
        "<$1$2</$1\x1A>",
        '$1$2$3',
        '$1$2$3',
        '$1$2$3$4$5',
        '$1$2$3$4$5$6$7',
        '$1$2$3',
        '<$1$2',
        '$1 ',
        "\n",
        ' ',
        ""
    );
    
    $buffer = preg_replace($search, $replace, $buffer);

    $CI->output->set_output($buffer);
    $CI->output->_display();
}
