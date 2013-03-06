<? function get_enum_values( $table, $field )
{

	global $dbh;

	$sth = $dbh->prepare("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

    preg_match('/^enum\((.*)\)$/', $result['Type'], $matches);
    foreach( explode(',', $matches[1]) as $value )
    {
         $enum[] = trim( $value, "'" );
    }
    return $enum;
}