<style>
    table, th, td {
        border: 1px solid black;
        text-align: center;
    }
    td {

    }
    table {
        border-collapse: collapse;
    }

</style>
<?php
echo "<table>\n<tr><td></td>";
for ($x = 11; --$x;) {
    echo "<th>$x</th>";
}
echo "</tr>\n<tr>";
for ($i = 11; --$i;) {
    echo "<th>$i</th>";
    for ($j = 11; --$j;) {
        if ($i % 2 == 0 && $j % 2 == 0) {
            echo "<td>(" . ($i * $j) . ")</td>";
        } elseif ($i % 2 == 1 && $j % 2 == 1) {
            echo "<td>[" . ($i * $j) . "]</td>";
        } else {
            echo "<td>" . ($i * $j) . "</td>";
        }
    }
    echo ($i != 1) ? "</tr>\n<tr>" : "</tr>\n";
}
echo "</table>";
