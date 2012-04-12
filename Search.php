<?php session_start();?>
<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>
<?php include_once ("includes/data.php");?>
<?php include_once ("includes/Business.php");?>


<?php
if ( isset($_GET['sortvalue']) )
{
	$_SESSION['sortvalue'] = $sortvalue;
}
else
{
	$_SESSION['sortvalue'] = 'le.event_id';
}

if (isset($_POST['button'])) {
	extract($_POST);
	
	$_SESSION['optionr'] = $optionr;

	$_SESSION['txtto'] = $txtto;

	$_SESSION['txtfrom'] = $txtfrom;
	
	$_SESSION['caller_class'] = $caller_class;
	 
	$_SESSION['marker_type'] = $marker_type;
	
	
	$_SESSION['level_string'] = $level_string;
	
	
	$_SESSION['logger_name'] = $logger_name;
}
extract($_SESSION);
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Home</title>
<link type="text/css" href="css/redmond/jquery-ui-1.8.17.custom.css"
	rel="stylesheet" />
</head>
<body>
	<div id="lee">
		<form action="Search.php" method="post" name="Search" id="Search">
		
		<?php echo "</br></br><b><center>Logging Event Information</center></b><br><br>"; ?>

			<table>
				<tr>
					<td>
					<?php echo 'Search '?></br>
					</td>
					<td></td>
				</tr>
				<tr>				
					
							
				<?php echo "class = ". $caller_class;	?><br>
				<?php echo "markertype = ". $marker_type;?><br>
				<?php echo "levelstring = ". $level_string?><br>
				<?php echo "loggername = ". $logger_name?><br>			
				<?php //echo $caller; ?>
				
				
					<td><Input type='Radio' Name="optionr" value="t3"
					<?= (isset($optionr) && $optionr == "t3")? 'checked' : '' ?> /> All	3 tables</Input>
					</td>
					<td></td>

				</tr>

				<tr>
					<td><Input type='Radio' Name="optionr" value="t2"
					<?= (isset($optionr) && $optionr == "t2")? 'checked' : '' ?> />
						Event and it's property</Input></td>
					<td></td>

				</tr>

				<tr>
					<td><Input type='Radio' Name="optionr" value="t1"
					<?= (isset($optionr) && $optionr == "t1")? 'checked' : '' ?> />
						Event and it's Exception</td>
					<td></td>

				</tr>
				<tr>
					<td><label for="txtfrom">From</label>
					</td>
					<td><input type="text" id="txtfrom" name="txtfrom"	
					value="<?= (isset($txtfrom) )? $txtfrom : '' ?>"/> <label for="txtto">To</label>
					<input type="text" id="txtto" name="txtto"
					value="<?= (isset($txtto) )? $txtto : '' ?>"/> </br>
					</td>
				</tr>

				<tr>

				<?php 		

				$searchCriterias = compact("txtto", "txtfrom", "caller_class", "marker_type", "level_string", "logger_name");
				
				?>
					<td>
						<label>Caller Class</label>
					</td>
					<td>
					<?php					
					
					//$allcallerclasses = $object->populatecallerc();

					$allcallerclasses = populatecallerclogic();

					?>
						<div>
							<select name="caller_class">
							
								<option value=''>Select</option>
																
							<?php while ($row=getfetchrow ($allcallerclasses))
							{
								$Name = $row[0];
								$selected = ((isset($caller_class) && $caller_class == $Name) ? ' selected="yes"' : '');
								print ("<option value='$Name'$selected> $Name</option>");
							}
							?>
							</select>
						</div> </br>
					</td>
				</tr>
				<tr>
					<td><label>Marker Type</label></td>
					<td>
					<?php $allmarkertypes = populatemarkertype();?>
						<div>
							<select name="marker_type">	    
								<option value=''>Select</option>
							<?php 
							
							while ($row=getfetchrow($allmarkertypes))
							{
								$Name = $row[0];
								$selected = ((isset($marker_type) && $marker_type == $Name) ? ' selected="yes"' : '');
								print ("<option value='$Name'$selected>$Name</option>\n");
							}
							
							?>
							</select>							
						</div> <br />
					</td>
				</tr>

				<tr>
					<td><label>Level String</label></td>
					<td>
					<?php $alllevelstrings = populatelevelstrings();?>
						<div>
							<select name="level_string">	    
							<option value=''>Select</option>
							<?php 							
							while ($row=getfetchrow($alllevelstrings))
							{
								$Name = $row[0];
								$selected = ((isset($level_string) && $level_string == $Name) ? ' selected="yes"' : '');
								print ("<option value='$Name'$selected>$Name</option>\n");
							}
							
							?>
							</select>
						</div> <br />
					</td>
				</tr>
				<tr>
					<td><label>Logger Name</label></td>
					<td>
					<?php $allloggernames = populateloggernames();?>
						<div>
							<select name="logger_name">	    
							<option value=''>Select</option>
							<?php
							
							while ($row=getfetchrow($allloggernames))
							{
								$Name = $row[0];
								$selected = ((isset($logger_name) && $logger_name == $Name) ? ' selected="yes"' : '');
								print ("<option value='$Name'$selected>$Name</option>\n");
							}
							
							?>
							</select>
						</div> <br />
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="button" value="Go!"></input>
					</td>

				</tr>

			</table>
		</form>
		<?php

		

		$i=0;
		?>
			<table align="center"  height='100' >
				<tr>
					<th width = 200px ><b>Event_id </a> <!-- </th> -->
							<!-- <th><b><a href="search.php?sortvalue=i")>I </a> --> <!--	</th> -->
							<!-- <th><b><a href="search.php?sortvalue=trace_line")>Trace_line </a> -->
					
					</th>
					<th width = 200px><b>TimeStamp </a>
					
					</th>
					<th><b>FormattedMessage</a>
					
					</th>
					<th><b>Logger Name</a>
					
					</th>
					<th><b>Level String </a>
					
					</th>
					<th><b>Thread Name</a>
					
					</th>
					<th><b>Reference Flag</a>
					
					</th>
					<th><b>Argument 0 </a>
					
					</th>
					<th><b>Argument 1 </a>
					
					</th>
					<th><b>Argument 2</a>
					
					</th>
					<th><b>Argument 3</a>
					
					</th>
					<th><b>Caller FileName </a>
					
					</th>
					<th><b>Caller Class </a>
					
					</th>
					<th><b>Caller Method </a>
					
					</th>
					<th><b>Caller Line </a>

					</th>
					<th><b>Marker type </a> 
					
					</th>
					<th><b>Mapped Key</a>
					
					</th>
					<th><b>Mapped Value </a>
					
					</th>
					<th ><b>I</a>
					
					</th>
					<th><b>Trace Line </a>
					
					</th>
				</tr>			
								
				<!-- <input name="btnsearch" type="button" value="Go" >-->
	
				<?php

				if (isset($_POST["optionr"])){
					if((  $_POST["optionr"] == "t3") || ( $_POST["optionr"] == null))
					{						
						$result =  getall($searchCriterias, "t3");
					}
					else if( $_POST["optionr"] == "t2")
					{
						$result =getall($searchCriterias, "t2");
					}
					else if( $_POST["optionr"] == "t1")
					{
						
					$result =getall($searchCriterias, "t1");
					}
				}				
				
				if(! isset($result)){
					//TODO add parameter optionr
					$result = getall($searchCriterias);
				}
				$num=getrowresult($result);
				
				//$result = GetValuesTimestmpRange($_POST["txtfrom"],$_POST["txtto"]);
				while ($i < $num) {
					
					while($row = mysql_fetch_array($result,MYSQL_ASSOC))
					{
						?>
							<tr>
								<td><?php  echo "{$row['event_id']}"  ?> </td>	
																	
								<td><?php echo "{$row['timestmp']}" ?></td>
																				
								<td><?php echo "{$row['formatted_message']} "?></td>
																				
								<td><?php  echo "{$row['logger_name']} " ?></td>
																				
								<td><?php echo "{$row['level_string']} "?></td>
										
								<td><?php echo "{$row['thread_name']}"?></td>
										
								<td><?php echo "{$row['reference_flag']}"?></td>
										
								<td><?php echo "{$row['arg0']} "?></td>
										
								<td><?php echo "{$row['arg1']} "?></td>
										
								<td><?php echo "{$row['arg2']}" ?></td>
										
								<td><?php echo "{$row['arg3']}"?></td>
										
								<td><?php echo "{$row['caller_filename']}"?></td>
										
								<td><?php echo "{$row['caller_class']}"?></td>
										
								<td><?php echo "{$row['caller_method']}"?></td>
										
								<td><?php echo "{$row['caller_line']}"?></td>
										
								<td><?php echo "{$row['marker_type']}"?></td>
										
								<td><?php if (isset($_POST["optionr"])){
 										  if(( $_POST["optionr"] == "t1"))echo "<B>"."Not applicable";											  
 										  else echo  "{$row['mapped_key']}" ;} 
								?></td>
								
										
								<td><?php if (isset($_POST["optionr"])){
 										  if(( $_POST["optionr"] == "t1"))echo "<B>"."Not applicable";											  
 											  else echo  "{$row['mapped_value']}" ;} 
								?></td>
									
								<td><?php if (isset($_POST["optionr"])){
 										  if(( $_POST["optionr"] == "t2"))echo "<B>"."Not applicable";											  
 										  else echo  "{$row['i']}" ;} 
									?></td>
										
								<td><?php if (isset($_POST["optionr"])){
 										  if(( $_POST["optionr"] == "t2"))echo "<B>"."Not applicable";											  
 										  else echo  "{$row['trace_line']}" ;} 
								?></td>
								
							</tr>
						
						<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>	
	<?php }?>
	
			</table>
			<?php 		
				$i++;}
	?>
</form>
	</div>
</body>

</html>
