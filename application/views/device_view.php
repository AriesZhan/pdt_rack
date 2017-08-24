<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>

<div id="container">

	<?php foreach ($devices as $row) :?>
		<h1>Device Information - [ <?php echo "$row->name";?> ]</h1>
		<div id=<?php echo $row->name;?>>
			<table id="<?php echo $row->name;?>_tb" cellspacing="0px" cellpadding="3px" style="position:relative; left:10px; border-width:0px; text-align:left;">
				<?php
					$device_vars = get_object_vars($row);
					ksort($device_vars);
					$tag = 0;
					$row_bgcolor = "rgba(208,208,208,0.4)";
				?>
				<?php foreach ($device_vars as $field_name => $value) :?>
					<?php if (strcmp($field_name, 'interfaces') != 0) :?>
						<tr style="background-color:<?php echo $row_bgcolor;?>;">
							<td style="width:160px; font-weight:600; font-size:16px;"><b><?php echo $field_name;?> :</b></td>
							<td style="width:1616px; font-weight:500; font-size:16px;"><code><?php echo $value;?></code></td>
						</tr>
						<?php 
							if ($tag == 0) {
								$tag ++;
								$row_bgcolor = "white";
							} elseif ($tag == 1) {
								$tag --;
								$row_bgcolor = "rgba(208,208,208,0.4)";
							}
						?>
					<?php endif;?>
				<?php endforeach;?>
				<tr style="background-color:<?php echo $row_bgcolor;?>;">
					<td style="width:160px; font-weight:600; font-size:16px;"><b>interfaces :</b></td>
					<td style="width:1616px; font-weight:500; font-size:16px;">
						<code><table id="<?php echo $row->name;?>_intf_tb" cellspacing="0px" style="border-width:0px; text-align:left;">
							<?php $connection_ls = preg_split('/;/', $device_vars['interfaces']);?>
							<?php asort($connection_ls);?>
							<?php foreach($connection_ls as $connection) :?>
								<?php if(preg_match('/\w+/', $connection)) : ?>
									<?php $connection_items = preg_split('/,/', $connection);?>
									<?php $intf = $connection_items[0];$intf_sw = $connection_items[1]?>
									<?php if(preg_match('/\w+/', $intf)) :?>
										<tr style="background-color:<?php echo $row_bgcolor;?>;">
											<td style="width:100px;"><?php echo $intf;?></td>
											<td style="width:60px; text-align:center;">--></td>
											<td style="width:500px;"><?php echo $intf_sw;?></td>
										</tr>
									<?php endif;?>
								<?php endif;?>
							<?php 
								if ($tag == 0) {
									$tag ++;
									$row_bgcolor = "white";
								} elseif ($tag == 1) {
									$tag --;
									$row_bgcolor = "rgba(208,208,208,0.4)";
								}
							?>
							<?php endforeach;?>
						</table></code>
					</td>
				</tr>
			</table>
			<!-- 
			<pre>
				<?php print_r($device_vars)?>
			</pre>
			 -->
		</div>
	<?php endforeach;?>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  ' <strong> CNRD PDT Team Lab Resource Management System. </strong>' : '' ?></p>

</div>

</body>
