<html>
<head>
<title>Database Backup Using Codeigniter</title>
</head>
<body>
<style>
h3{
font-family: Verdana;
font-size: 18pt;
font-style: normal;
font-weight: bold;
color:red;
text-align: center;
}

table{
font-family: Verdana;
color:black;
font-size: 12pt;
font-style: normal;
font-weight: bold;
text-align:left;
border-collapse: collapse;
}
.error{
color:red;
font-size: 11px;
}
</style>
<h3>Database Backup Using Codeigniter</h3>
<?php echo form_open('backup/database',array('name' => 'backup')); ?>
<table align="center" cellpadding = "5">
<tr>
<td colspan="5" align="center">
<input type="submit" name="backup" value="Take Backup"/></td>
</tr>
</table>
<?php echo form_close();?>
</body>
</html>