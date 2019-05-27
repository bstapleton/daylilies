$sth = mysqli_query("SELECT name, price FROM plant LIMIT 10");
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
print json_encode($rows);
