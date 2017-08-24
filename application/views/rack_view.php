
<body>

<script type="text/javascript" src="<?php echo base_url()?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.cookie.js"></script>

<script type="text/javascript">
	document.cookie = "screenwidth=" + window.screen.width;
	document.cookie = "screenheight=" + window.screen.height;
	document.cookie = "bodyheight=" + document.body.scrollHeight;
	$(document).ready(function(){
		var obj_ls = document.getElementsByClassName('show');
		var showCodes = new Array();
		function showContent(d1,u1) {
			$(d1).mouseover(function(){
				$(u1).show();
			});
		}
		for (var i=0; i < obj_ls.length; i ++) {
			var d = obj_ls[i];
			var u_ls_tmp = d.getElementsByClassName('hide');
			var u = u_ls_tmp[0];
			showCodes.push(showContent(d,u));
		}
	    $(".show").mouseout(function(){  
	        $(".hide").hide();  
	    });	
	 });
</script>

<div id="container">
	<h1>Welcome to PDT Rack Information Webpage.</h1>
	<div id="body">
		<div id="modList" style="position:relative; left:0px; top:0px;">
			<table id="modList_tb" cellspacing="0" cellpadding="3" style="border-style:solid; border-width:0px; border-color:black">
				<?php $models = array_keys($mods); ?>		
				<?php while (count($models) > 0) :?>
					<tr>
						<?php for($colId = 0; $colId < 10; $colId ++) :?>
						    <?php
							    if (count($models) > 0) {
							    	$model = array_shift($models);
							    	$mod_cnt = $mods[$model]['count'];
							    	$mod_rgb = $mods[$model]['rgb'];
							    } else {
							    	break;
							    }
						    ?>
							<td style="width:280px; border-style:solid; border-width:1px; text-align:left; background-color:<?php echo $mod_rgb?>;">
								<b><?php echo "$model";?></b>
							</td>
							<td style="width:20px;border-style:solid; border-width:1px; text-align:center">
								<?php echo $mod_cnt;?>
							</td>
						<?php endfor;?>
					</tr>
				<?php endwhile;?>
			</table>
		</div>
		<?php 
			$screen_width = $_COOKIE['screenwidth'];
			$screen_height = $_COOKIE['screenheight'];
			$body_height = $_COOKIE['bodyheight'];
			#echo "$screen_width:$screen_height, $body_height";
		?>
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  ' <strong> CNRD PDT Team Lab Resource Management System. </strong>' : '' ?></p>
		<div style="height:30px; width:<?php echo ($screen_width - 150);?>px; float:left"><hr style="border:0px;" /></div>
		<?php
			$racksId = array_keys($racks);
			$i = 1;
			if ($screen_width >= 1200 && $screen_width < 1600) {
				$tb_num_per_row = 4;
			} elseif ($screen_width >= 1600 && $screen_width < 2000) {
				$tb_num_per_row = 5;
			} elseif ($screen_width >= 2000) {
				$tb_num_per_row = 6;
			}
			$gap_width = (int)(($screen_width - 150 - $tb_num_per_row * 280) / ($tb_num_per_row - 1));
		?>
		<?php for($id = 0; $id < count($racksId); $id ++) :?>
			<?php
				#$left_pos = $id % $tb_num_per_row * 380;
				#$top_pos = ($id % $tb_num_per_row) * (-1060);
			?>
			<?php if ($i == 1) :?>
				<div style="float:left;">
			<?php endif;?>
			<div id="<?php echo $racksId[$id];?>" style="float:left;">
				<table id="<?php echo $racksId[$id];?>_tb" cellspacing="0px" style="border-style:solid; border-width:2px; border-color:black; width:280px;">
					<tr>
						<th colspan="2" style="border-style:solid; border-width:1px; color:white; background-color:green; font-weight:800; font-size:18px;">
							<?php echo $racksId[$id];?>
						</th>
					</tr>
					<?php for($unitId = 45; $unitId >= 1; $unitId --) :?>
						<tr style="height:20px;">
							<td style="border-style:solid; border-width:1px; text-align:center; width:20px"><b><?php echo $unitId;?></b></td>
							<td id="<?php echo $racksId[$id].'_'.$unitId;?>" style="border-style:solid; border-width:1px; text-align:center; font-weight:500; font-size:14px;">
								<?php if (array_key_exists($unitId, $racks[$racksId[$id]])) :?>
									<?php 
										$data_rows = $racks[$racksId[$id]][$unitId];
										$mod0 = $data_rows[0]->model;
										$show_name = $data_rows[0]->name;
										if (count($data_rows) == 1) {
											echo "[$mod0] : <a href=\"".site_url()."/device/index/name/$show_name\">$show_name</a>";
										}
										echo "<style type='text/css'>";
										echo '#'.$racksId[$id].'_'.$unitId.' {background-color:'.$mods[$mod0]['rgb'].';}';
										echo '</style>';
									?>
									<?php if (count($data_rows) > 1) :?>
										<div class="show" id="<?php echo $racksId[$id].'_'.$unitId;?>_div">
											<?php echo "[$mod0] : more...";?>
											<ul class="hide" id="<?php echo $racksId[$id].'_'.$unitId;?>_div_ul" style="text-align:left; display:none">
												<?php foreach($data_rows as $row) :?>
													<li><a href="<?php echo site_url()."/device/index/name/$row->name"?>"><?php echo $row->name?></a></li>
												<?php endforeach;?>
											</ul>
										</div>
									<?php endif;?>
								<?php endif;?>
							</td>
						</tr>
					<?php endfor;?>
				</table>
			</div>
			<?php if ($i < $tb_num_per_row) :?>
				<div style="width:<?php echo $gap_width;?>px; height:920px; float:left;">
					<hr style="border:0px;" />
				</div>
			<?php elseif ($i == $tb_num_per_row) :?>
				</div>
				<div style="height:30px; width:<?php echo ($screen_width - 150);?>px; float:left;"><hr style="border:0px;" /></div>
				<?php $i = 0;?>
			<?php endif;?>
			<?php $i ++;?>
		<?php endfor;?>
		<div style="height:30px; width:<?php echo ($screen_width - 150);?>px; float:left;"><hr style="border:0px" /></div>
		<!-- <pre><?php print_r($racks);?></pre> -->
	</div>
</div>

</body>

