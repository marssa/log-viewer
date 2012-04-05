<?php include_once ("includes/dataclass.php");?>
<?php
function populatecallerclogic()
{
	$allcallerclassess = populatecc();
	return $allcallerclassess;
}


function populatemarkertype()
{
	$mt = populatemt();
	return $mt;
}

function populatelevelstrings()
{
	$ls = populatelevel();
	return $ls;
}

function populateloggernames()
{
	$ln = populateloggername();
	return $ln;
}

function getallvalues()
{
	$getallv = GetValuesAll();
	return $getallv;
}

function getvaluescc($class)
{
	$getvcallerclass = GetValuesCallerClass($class);
	return $getvaluecc;
}

function getvaluesfrom2t()
{
	$getvaluesfrom2 = GetValuesAllfrom2tables();
	return $getvaluesfrom2;
}


function getvaluesfrom1t()
{
	$getvaluesfrom1 = GetValuesAllfrom1table();
	return $getvaluesfrom1;
}

function getvaluesusingtimestamp($from, $to)
{
	$getvaluetimestamp = GetValuesTimestmpRange($from, $to);
	return $getvaluetimestamp;
}

function getrowresult($result)
{
	$getresult = mysql_num_rows($result);
	return $getresult;
}

function getfetchrow($result)
{
	$getfetchrowresult = mysql_fetch_row($result);
	return $getfetchrowresult;
}



?>

