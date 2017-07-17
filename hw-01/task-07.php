<?php
echo "<table >\n<tr>";

for ($i = 11; --$i;) {
//    echo " <td>$i</td>";
    for ($j = 11; --$j;) {
        if ($i % 2 == 0 && $j % 2 == 0) {
            echo "<td>(" . ($i * $j) . ")</td>";
        } elseif ($i % 2 == 1 && $j % 2 == 1) {
            echo "<td>[" . ($i * $j) . "]</td>";
        } else {
            echo "<td>&nbsp" . ($i * $j) . "</td>";
        }
    }
    echo ($i != 1) ? "</tr>\n<tr>" : "</tr>\n";
}
echo "</table>";
