<style>
    td {
        border: 1px solid black;
        text-align: center;
        padding: 5px;
    }
    table  {
        border-collapse: collapse;
    }
</style>
<?php
echo "<table>\n<tr><th></th>";
for ($x = 11; --$x;) {
    echo "<th>$x</th>";
}
echo "</tr>\n";
for ($i = 11; --$i;) {
    echo "<tr><th>$i</th>";
    for ($j = 11; --$j;) {
        //=======first
        if (($i % 2 == 0) && ($j % 2 == 0)) {
            echo '<td>(' . ($i * $j) . ')</td>';
        } elseif (($i % 2 == 1) && ($j % 2 == 1)) {
            echo '<td>[' . ($i * $j) . ']</td>';
        } else {
            echo '<td>' . ($i * $j) . '</td>';
        }
        //=====second
//        if (($i % 2 == 0) && ($j % 2 == 0)) {
//            echo '<td>(' . ($i * $j) . ')</td>';
//        } elseif (($i % 2 == 0) xor ($j % 2 == 0)) {
//            echo '<td>' . ($i * $j) . '</td>';
//        } else {
//            echo '<td>[' . ($i * $j) . ']</td>';
//        }
    }
    echo "</tr>\n";
}
echo "</table>";
