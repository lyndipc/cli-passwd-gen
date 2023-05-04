<?php
$options = getopt('l:t:', ['length:', 'types:']);

$length = isset($options['l']) ? (int)$options['l'] : (int)$options['length'];
$types = isset($options['t']) ? $options['t'] : $options['types'];


// Parse and validate command line args
if (!$length || $length <= 0) {
    exit("Error: Password length must be a positive integer\n");
}

if (!$types || !preg_match('/^[luns]*$/', $types)) {
    exit("Error: Password types must be a string containing only 'l', 'u', 'n', and/or 's'\n");
}

$lowercase = 'abcdefghijklmnopqrstuvwxyz';
$uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$numbers = '0123456789';
$special = '!@#$%^&*()_+-={}[];\',./<>?:"|\\';
$chars = '';

// Find the first occurrence of each substring (l, u, n, or s) within $types
if (strpos($types, 'l') !== false) {
    $chars .= $lowercase;
}

if (strpos($types, 'u') !== false) {
    $chars .= $uppercase;
}

if (strpos($types, 'n') !== false) {
    $chars .= $numbers;
}

if (strpos($types, 's') !== false) {
    $chars .= $special;
}

$password = '';
for ($i = 0; $i < $length; $i++) {
    $index = random_int(0, strlen($chars) - 1);
    $password .= $chars[$index];
}

echo $password . "\n";