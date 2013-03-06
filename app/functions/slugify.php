<? function slugify ($string) {
  $string = utf8_decode($string);
  $string = html_entity_decode($string);
 
  $a = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ';
  $b = 'AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn';
  $string = strtr($string, utf8_decode($a), $b);
 
  $ponctu = array("?", ".", "!", ",");
  $string = str_replace($ponctu, "", $string);
 
  $string = trim($string);
  $string = preg_replace('/([^a-z0-9]+)/i', '-', $string);
  $string = strtolower($string);
 
  if (empty($string)) return 'n-a';
 
  return utf8_encode($string);
}