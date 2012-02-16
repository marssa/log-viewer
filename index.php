<?php
	require_once('preheader.php');
	include ('ajaxCRUD.class.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?
    $tblDemo = new ajaxCRUD("Item", "logging_event_exception", "pkID", "../");
    $tblDemo->omitPrimaryKey();
    $tblDemo->displayAs("fldField1", "Field1");
    $tblDemo->displayAs("fldField2", "Field2");
    $tblDemo->displayAs("fldCertainFields", "Certain Fields");
    $tblDemo->displayAs("fldLongField", "Long Field");
    $tblDemo->setTextareaHeight('fldLongField', 100);

    $allowableValues = array("Allowable Value 1", "Allowable Value2", "Dropdown Value", "CRUD");
    $tblDemo->defineAllowableValues("fldCertainFields", $allowableValues);

    $tblDemo->setLimit(5);
    $tblDemo->addAjaxFilterBox('fldField1');
	$tblDemo->formatFieldWithFunction('fldField1', 'makeBlue');
	$tblDemo->formatFieldWithFunction('fldField2', 'makeBold');
	$tblDemo->showTable();

	echo "<br /><hr ><br />\n";


	function makeBold($val){
		return "<b>$val</b>";
	}

	function makeBlue($val){
		return "$val";
	}

?>