<script>tinymce.init({selector:"textarea.editME"});</script>
<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
?>
<table class = "table table-striped">
<form method = "post">
<tr><th>Description</th><th style="width:80%;">Text</th></tr>
<?php
$result = mysql_query("SELECT * FROM wp_copy ORDER BY id");
while ($row = mysql_fetch_array($result))
{
	echo '<tr><td>'.stripslashes($row['description']).'</td><td><textarea name = "text[]" class = "'.$row['tinyMCE'].'" rows="6" cols="80">'.stripslashes($row['text']).'</textarea><input type="hidden" name="copyID[]" value="'.$row['id'].'"></td></tr>';
}
?>
<tfoot><tr><td colspan = "2" align = "right"><input type="hidden" name="page" value="adminCopyUpdate"><button type="submit" value="save" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Save</button></td></tr></tfoot>
</form></table>