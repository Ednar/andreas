<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<ul>';

foreach ($prints as $title => $print) {
    echo '<li><a href="prints.php?print=' . $print->title . '">' . $print->id . '</a></li>';
}

foreach ($prints as $print) {
    echo $print[0] . $print[1];
}

print_r(array_values($prints));

if (is_null($prints)) {
    echo '$prints är tom';
} else {
    echo '$prints är åtminstone inte tom';
}

echo '</ul>';
?>