<?php session_start();?>
<?php include_once ("includes/Business.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Home</title>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
<link rel="stylesheet" href="css/style.css"></link>
</head>
<body>

	<div id="lee">


 	<?php
	if ( isset($_GET['sortvalue']) )
	{
		$_SESSION['sortvalue'] = $_GET['sortvalue'];
	}
	else
	{
		$_SESSION['sortvalue']= "event_id";
	}
	?>

	<?php

	echo "</br></br><b><center>Logging Event Information</center></b><br><br>";

	$i=0;
	?>

		<form method="post" action="Search.php">
			<input type="submit" name="btnsearch" value="Search Data"
				onclick="Search.php"></input>
		</form>


		<table align="center" width='500' height='100'>
			<tr>
				<th><b><a href="index.php?sortvalue=event_id")>Event_id </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=timestmp">TimeStamp </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=formatted_message">FormattedMessage</a>
				
				</th>
				<th><b><a href="index.php?sortvalue=logger_name">Logger Name</a>
				
				</th>
				<th><b><a href="index.php?sortvalue=level_string">Level String </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=thread_name">Thread Name</a>
				
				</th>
				<th><b><a href="index.php?sortvalue=reference_flag">Reference Flag</a>
				
				</th>
				<th><b><a href="index.php?sortvalue=arg0">Argument 0 </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=arg1">Argument 1 </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=arg2">Argument 2</a>
				
				</th>
				<th><b><a href="index.php?sortvalue=arg3">Argument 3</a>
				
				</th>
				<th><b><a href="index.php?sortvalue=caller_filename">Caller FileName
					</a>
				
				</th>
				<th><b><a href="index.php?sortvalue=caller_class">Caller Class </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=caller_method">Caller Method </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=caller_line">Caller Line </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=marker_type")>Marker type </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=mapped_key"> Mapped Key</a>
				
				</th>
				<th><b><a href="index.php?sortvalue=mapped_value">Mapped Value </a>
				
				</th>
				<th><b><a href="index.php?sortvalue=i"> I</a>
				
				</th>
				<th><b><a href="index.php?sortvalue=trace_line">Trace Line </a>
				
				</th>
			</tr>
			
			
			
			
				<?php 
				if($_SESSION['sortvalue']=='event_id')
				{
					$_SESSION['sortvalue'] = 'le.event_id';
				}
			
			
			$result = GetValuesLoggingEvent();
			
			
			$numlee=mysql_num_rows($result);
						
			
	while ($i < $numlee) {
		
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			?>			
			<tr>
				<td><?php echo "{$row['event_id']}"?> </td>				
				<td><?php echo "{$row['timestmp']} <br>";?></td>
				<td><?php echo "{$row['formatted_message']} <br>"; ?></td>
				<td><?php echo "{$row['logger_name']} <br>"; ?></td>
				<td><?php echo "{$row['level_string']} <br>";?></td>
				<td><?php echo "{$row['thread_name']} <br>"; ?></td>
				<td><?php echo "{$row['reference_flag']} <br>"; ?></td>
				<td><?php echo "{$row['arg0']} <br>";?></td>
				<td><?php echo "{$row['arg1']} <br>"; ?></td>
				<td><?php echo "{$row['arg2']} <br>"; ?></td>
				<td><?php echo "{$row['arg3']} <br>";?></td>
				<td><?php echo "{$row['caller_filename']} <br>"; ?></td>
				<td><?php echo "{$row['caller_class']} <br>"; ?></td>
				<td><?php echo "{$row['caller_method']} <br>";?></td>
				<td><?php echo "{$row['caller_line']} <br>"; ?></td>
				<td><?php echo "{$row['mapped_key']} <br>"; ?></td>
				<td><?php echo "{$row['mapped_value']} <br>"; ?></td>
				<td><?php echo "{$row['i']} <br>"; ?></td>
				<td><?php echo "{$row['trace_line']} <br>"; ?></td>
			</tr>
		
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>	
	<?php }?>
	
			</table>
		
		
		
		
			<?php 		
	
		$i++;
	}
	
	?>

	</div>




</body>

</html>
