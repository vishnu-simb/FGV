<style type="text/css">
<!--
	
	table.page_header {width: 100%; border: none; background-color: #eee; border-bottom: solid 1mm #444; padding: 2mm }
	table.page_content {width: 100%; border: none;}
	table.page_footer {width: 100%; border: none; background-color: #eee; border-top: solid 1mm #444; padding: 2mm}
	table.prediction {width: 100%; border: none; background-color: #fff;}
	tr{width: 100%; padding: 2mm}
	tr.head  {background-color: #eee; padding: 2mm}
	
	th{text-align: left;};
-->
</style>

<?php
foreach($VARS['blocks'] as $block){
	$sprayDates = $VARS['sprayDates'][$block->id];
?>

<page pageset="old" backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 9pt">
	<pageheader>
		<table class="page_header">
			<tr>
				<td style="width: 100%; text-align: left">
					<?=$VARS['hasFollowYear']?> - <?=$VARS['grower']->name?> - CropWatch Report 
				</td>
			</tr>
		</table>
	</pageheader>
  <div class="standard">
	<h1></h1>
	<h2><?=$block->name;?> - <?=$block->property->name?></h2>
	
	<h4>Spray Predictions</h4>
	
	<?php 
	//$VARS['sprayInverse']
	?>
	<table class="page_content">
	<tr class="head">
		<th width="28%">Spray</th>
		<?php
		$h = array();
		$next = '';
		foreach($sprayDates as $pest=>$v){
			$h[] = '<th>'.$pest.'</th>'.$next;
			$next = '';
			
			if($v->secondCohortSprays){
				$next = '<th>'.$pest.'<br /> (2nd Cohort)</th>';
			}	
		}
		echo implode('', $h);
		?>
	</tr>
	<tr class="single">
		<td style="width: 28%; text-align: left">Biofix Date:</td>
		<?php 
		$h = array();
		foreach($sprayDates as $pest=>$v){
			$biofix = (date('Y',strtotime($v->biofix)) == $VARS['hasFollowYear'])?DateHelper::dateOutput($v->biofix):"";
			$h[] = '<td style="width: 18%; text-align: left">'.DateHelper::dateOutput($biofix).'</td>'.$next;
			$next = ' ';
			
			if($v->secondCohortSprays){
				$next = '<td>'.DateHelper::dateOutput($v->secondCohortBiofix).'</td>';
			}
		}
		echo implode('', $h);
		?>
	</tr>
	<?php 
	$firstToBoldMap = array();
	
	for($i=1;$i<=6;$i++){
		$row = array();
		$next = null;
		foreach($sprayDates as $pest=>$s){
			$row[$pest] = array($s->sprays[$i]);
			if($next !== null){
				$row[$pest][] = $next;
				$next = null;
			}
			if(isset($s->secondCohortSprays[$i]) && $s->secondCohortSprays[$i]->sprayDate){
				$next = $s->secondCohortSprays[$i];
			}elseif(count($s->secondCohortSprays)){
				$next = '';
			}
		}
			
		echo '<tr>';
		$h = array();
		echo '<td>'.Number::Ordinal($i).' Spray/Gen '.$i.' Complete:</td>';
		foreach($row as $k=>$ss){
			foreach($ss as $sk=>$s){
				echo '<td>';
				if($s instanceof SprayResult){
					$tb = false;
					if(!isset($firstToBoldMap[$sk]) && strtotime($s->sprayDate) > time()){
						$firstToBoldMap[$sk] = true;
						$tb = true;
						echo '<b>';
					}
					echo DateHelper::dateOutputCurrentSeason($s->sprayDate, $VARS['hasFollowYear']);
					if($tb)
						echo '</b>';
				}
				echo '</td>';
			}
		}
		echo '</tr>';
		echo '<tr>';
		echo '<td>Cover required until:','</td>';
		foreach($row as $k=>$ss){
			foreach($ss as $s){
				echo '<td>';
				if($s instanceof SprayResult)
					echo DateHelper::dateOutputCurrentSeason($s->coverUntil, $VARS['hasFollowYear']);
				echo '</td>';
			}
		}
		echo '</tr>';
	}
	?>
</table>

	<h4>Spray Logs</h4>
	<table class="page_content">
		<tr class="head">
			<th>Date</th>
			<th>Chemical</th>
			<th>Quantity</th>
			<th>Cost</th>
		</tr>
		<?php 
		$total_cost = 0;
        $spray_records = $block->getSprays($VARS['hasFollowYear']+1);
		if ($spray_records)
        {
            foreach($spray_records as $spray){
    			echo '<tr><td>'.DateHelper::dateOutput($spray->date).'</td>';
    			echo '<td>'.$spray->chemical->name.'</td>';
    			echo '<td>'.$spray->quantity.'</td>';
    			$cost = $spray->quantity * $spray->chemical->getCost();
    			echo '<td>$'.number_format($cost,2).'</td></tr>';
    			$total_cost += $cost;
    		}	
        }
		?>
		<tr class="total">
			<td colspan="3" style="width: 80%; text-align: left">Total cost:</td>
			<td style="width: 20%; text-align: right">$<?=number_format($total_cost,2)?></td>
		</tr>
	</table>
</div>
	<pagefooter>
		<table class="page_footer">
			<tr>
				<td style="width: 100%; text-align: right">
					Created by Fruit Growers Victoria. Report problems to <b>growerservices@fgv.com.au</b>
				</td>
			</tr>
		</table>
	</pagefooter>
</page>	


	<pagebreak></pagebreak>
<?php 
}
?>