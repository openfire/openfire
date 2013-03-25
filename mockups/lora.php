<form action='' method='post'>
<input name='theName'> <button type='submit'>Show The Name</button>
</form>

<?

if(!empty($_POST)){

echo "<pre>";
print_r($_POST);
echo "</pre>";
}
