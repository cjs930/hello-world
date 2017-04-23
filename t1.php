<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$c = oci_connect("ntpsm", "ntpsm", "192.168.0.25/XE");
if (!$c) {
    $m = oci_error();
    trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
}

$s = oci_parse($c, "select * from codds where rownum<=10");
$r = oci_execute($s);
echo "<table border='1'>\n";
while (($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    echo "<tr>";
    foreach ($row as $item) {
        echo "<td>";
        echo $item!==null?htmlspecialchars($item, ENT_QUOTES|ENT_SUBSTITUTE):"&nbsp;";
        echo "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

?>