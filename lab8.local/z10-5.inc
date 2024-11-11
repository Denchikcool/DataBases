<?php
function get_field_flags($flags) {
    $flag_names = array();

    if ($flags & 1) $flag_names[] = "NOT_NULL";
    if ($flags & 2) $flag_names[] = "PRIMARY_KEY";
    if ($flags & 4) $flag_names[] = "UNIQUE_KEY";
    if ($flags & 8) $flag_names[] = "MULTIPLE_KEY";
    if ($flags & 16) $flag_names[] = "BLOB";
    if ($flags & 32) $flag_names[] = "UNSIGNED";
    if ($flags & 64) $flag_names[] = "ZEROFILL";
    if ($flags & 128) $flag_names[] = "BINARY";
    if ($flags & 256) $flag_names[] = "ENUM";
    if ($flags & 512) $flag_names[] = "AUTO_INCREMENT";
    if ($flags & 1024) $flag_names[] = "TIMESTAMP";

    return implode(", ", $flag_names); //объединение в строку всех параметров
}
function vid_structure() {
    $structure = $_GET["structure"];
    global $conn;
    $mysql_data_type_hash = array(
        1=>'tinyint',
        2=>'smallint',
        3=>'int',
        4=>'float',
        5=>'double',
        7=>'timestamp',
        8=>'bigint',
        9=>'mediumint',
        10=>'date',
        11=>'time',
        12=>'datetime',
        13=>'year',
        16=>'bit',
        246=>'decimal',
        253=>'varchar',
        254=>'char'
    );
    print "<dl><dd>\n";
    foreach($structure as $table) {
        print "<h4>Структура таблицы $table</h4>\n";
        $query_res = mysqli_query($conn, "SELECT * from $table");
        $num_fields = mysqli_num_fields($query_res);
        print "<dl><dd>\n";
        for ($x=0; $x<$num_fields; $x++) {
            $properties = mysqli_fetch_field_direct($query_res, $x);
            print "<i>".$mysql_data_type_hash[$properties->type]."</i> <i>$properties->length</i> <b>$properties->name</b> <i>".get_field_flags($properties->flags)."</i><br>\n";
        }
        print "</dl>\n";
    }
    print "</dl>\n";
}

function vid_content() {
    $content = $_GET["content"];
    $rus_name = array (
        'snum' => "Номер продавца",
        'sname' => "Имя продавца",
        'city' => "Город",
        'comm' => "Комиссионные продавца",
        'cnum' => "Номер покупателя",
        'cname' => "Имя покупателя",
        'rating' => "Рейтинг покупателя",
        'onum' => "Номер заказа",
        'amt' => "Сумма заказа",
        'odate' => "Дата заказа"
    );
    global $conn;
    foreach($content as $table) {
        print "<h4>Содержимое таблицы $table</h4>\n";
        $result = mysqli_query($conn, "SELECT * FROM $table");
        $num_fields = mysqli_num_fields($result);
        print "<p><table border 1>\n";
        print "<tr>\n";
        for ($x = 0; $x < $num_fields; $x++) {
            $name = mysqli_fetch_field_direct($result, $x)->name;
            print "\t<th>$rus_name[$name]<br>$name</th>\n";
        }
        print "</tr>\n";
        while ($a_row = mysqli_fetch_row($result))
		{
            print "<tr>\n";
            foreach ($a_row as $field)
                print "\t<td>$field</td>\n";
            print "</tr>\n";
        }
        print "</table>\n";
    }
}

if (isset($_GET["structure"]))
    vid_structure();

if (isset($_GET["content"]))
    vid_content();

print "<p><a href='z10-1.htm'>Возврат к выбору таблицы</a></p>";
?>