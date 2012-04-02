<?php session_start();?>
<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>
<?php include ("includes/dataclass.php");?>
<?php include ("includes/data.php");?>

<?php
if ( isset($_GET['sortvalue']) )
{
	$_SESSION['sortvalue'] = $_GET['sortvalue'];
}
else
{
	$_SESSION['sortvalue']='le.event_id';
}

if (isset($_POST['button'])) {

	$optionr = $_POST['optionr'];

	$to = $_POST['txtto'];
	$_SESSION['to'] = $to;
	$from = $_POST['txtfrom'];
	$_SESSION['from'] = $from;
	//$class =
	$_SESSION['class'] =$_POST['txtcallerclass'];
	$markertype = $_POST['txtmarkertype'];
	$_SESSION['markertype'] = $markertype;
	$levelstring = $_POST['txtlevelstring'];
	$_SESSION['levelstring'] = $levelstring;
	$loggername = $_POST['txloggername'];
	$_SESSION['loggername'] = $loggername;
}

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
					
					
					
				<?php echo "optionr = ".$_SESSION['optionr'];?><br>					
				<?php echo "class = ". $_SESSION['class'];	?><br>
				<?php echo "markertype = ". $_SESSION['markertype'];?><br>
				<?php echo "levelstring = ". $_SESSION['levelstring'];?><br>
				<?php echo "loggername = ". $_SESSION['loggername'];?><br>
				
				
				<?php echo $caller; ?>
					<td><Input type='Radio' Name="optionr" value="t3"
					<?= (isset($optionr) && $optionr == "t3")? 'checked' : '' ?> /> All
						3 tables</Input>
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
					<?= (isset($from) )? 'txtfrom' : '$from' ?> /> <label for="txtto">To</label>
						<input type="text" id="txtto" name="txtto" /> </br>
					</td>

				</tr>

				<tr>

					<td><label>Caller Class</label>
					</td>
					<!--<td><input type="text" id="txtcallerclass" name="txtcallerclass" /> -->
					<td>
					<?php
					$allcallerclasses = populatecc();

					?>
						<div>
							<select name="txtcallerclass">                     	
							<?php if($_POST['submit'] == true){?>
								<option value="<?php echo $_POST['txtcallerclass']; ?>"
									selected="selected">				

									<?php echo $_POST['txtcallerclass']; ?></option>

									<?php } else { ?>
								<option>Select</option>
								<?php } ?>
																
							<?php while ($row=mysql_fetch_row ($allcallerclasses))
							{
								$Name = $row[0];
								print ("<option value='$Name'> $Name</option>\n");
								
								$caller = $Name;
								echo $txtcallerclass;
							}
							?>
							</select>
							<script type="text/javascript">
							<?php if (isset($class)){ ?> 
							document.getElementById('<?php echo $class ?>').value == ( <?php echo $class ?>)
							<?php } ?>
							</script>
						</div> </br>
					</td>
				</tr>
				<tr>
					<td><label>Marker Type</label></td>
					<td>
					<?php $allmarkertypes = populatemt();?>
						<div>
							<select name="txtmarkertype">	    
							<?php
							print ("<option>Select</option>");
							while ($row=mysql_fetch_row($allmarkertypes))
							{
								$Name = $row[0];
								print ("<option value='$Name'>$Name</option>\n");
							}
							?>
							</select>
							<script type="text/javascript">
							 <? if (isset($txtmarkertype)) document.getElementById('$txtmarkertype').value == (print $txtmarkertype); ?>
							</script>
						</div> <br />
					</td>
				</tr>

				<tr>
					<td><label>Level String</label></td>
					<td>
					<?php $alllevelstrings = populatelevel();?>
						<div>
							<select name="txtlevelstring">	    
							<?php
							print ("<option>Select</option>");
							while ($row=mysql_fetch_row($alllevelstrings))
							{
								$Name = $row[0];
								print ("<option value='$Name'>$Name</option>\n");
							}
							?>
							</select>
						</div> <br />
					</td>
				</tr>
				<tr>
					<td><label>Logger Name</label></td>
					<td>
					<?php $allloggernames = populateloggername();?>
						<div>
							<select name="txloggername">	    
							<?php
							print ("<option>Select</option>");
							while ($row=mysql_fetch_row($allloggernames))
							{

								$Name = $row[0];
								print ("<option value='$Name'>$Name</option>\n");
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
				
			 if ($_POST)
			{
				
				
 								
				if($to == null && $from == NULL && $class == "Select")
				{
					if (isset($_POST["optionr"])){
						if(( $_POST["optionr"] == "t3") || ( $_POST["optionr"] == null))
						{
							
							$result = GetValuesAll();
						}
						else if( $_POST["optionr"] == "t2")
						{	
							
							$result =GetValuesAllfrom2tables();
						}
						else if( $_POST["optionr"] == "t1")
						{
							
							$result =GetValuesAllfrom1table();
						}
					}
				}
				else if($to == null && $class == 'Select')
				{
					$result = GetValuesAll();
						
				}
				else if($from == null && $class == 'Select')
				{
					$result = GetValuesAll();
						
				}
				
				else if($to == null && $from == NULL && $class != 'Select')
				{
					
					$result = GetValuesCallerClass($class);
				}
				
				else if($class == 'Select' && $to != null && $from != NULL)
				{
					$result = GetValuesTimestmpRange($from ,$to);
				}
				
				
				if(! isset($result)){
					$result = GetValuesAll();
				}
				$num=mysql_num_rows($result);
				
				//$result = GetValuesTimestmpRange($_POST["from"],$_POST["to"]);
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
	}
	?>
</form>
	</div>
</body>

</html>
