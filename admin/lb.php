<script language = "JavaScript">
var onecount;
onecount=0;
subcat = new Array();
<?
mysql_connect("127.0.0.1","root","root");
mysql_select_db( "mooc" );
$sql = "select * from subject";
$result = mysql_query( $sql );
$count = 0;
while($res = mysql_fetch_row($result)){
?>
subcat[<?=$count?>] = new Array("<?=$res[0]?>","<?=$res[1]?>","<?=$res[2]?>");
<?
$count++;
}
echo "onecount=$count;";
?>
//联动函数
function changelocation(locationid)
{
document.myform.ctype.length = 0;
var locationid=locationid;
var i;
for (i=0;i < onecount; i++)
{
if (subcat[i][2] == locationid)
{
//var newOption1=new Option(subcat[i][1], subcat[i][0]);
//document.all.ctype.add(newOption1);
document.myform.ctype.options[document.myform.ctype.length] = new Option(subcat[i][1], subcat[i][0]);
}
}

}
</script>
<form method="post" name="myform" action="ru_query.php">
<select name="type" onChange="changelocation(document.myform.type.options[document.myform.type.selectedIndex].value)" size="1">
<option selected value="">请指定主分类</option>

<?
$sql = "select * from depart";
$result = mysql_query( $sql );
while($res = mysql_fetch_row($result)){
?>
<option value="<? echo $res[0]; ?>"><? echo $res[1]; ?></option>
<? } ?>

</select>

<select name="ctype">
<option selected value="">请指定小分类</option>
</select>
<input type="submit" name="Submit" value="搜索">
</form>