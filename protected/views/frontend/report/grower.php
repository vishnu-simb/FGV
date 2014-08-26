<?php
	if(!empty($VARS['email'])){
		echo '<a href="',$VARS['link'],'">If this email doesnt load correctly, goto: ',$VARS['link'],'</a>';
	}
?>
<table class="header">
	<tr>
		<td width="25%" ><?=date('d-m-Y')?></td>
		<td width="50%" style="text-align: center"><h1>CropWatch Report</h1> </td>
		<td width="25%" style="text-align: right"><?=$VARS['grower']->name?></td>
	</tr>
</table>

<?php
foreach($VARS['blocks'] as $block){
	$sprayDates = $VARS['sprayDates'][$block->id];
?>
<table>
	<tr>
		<td><h2><?=$block->name;?></h2></td>
		<td style="text-align: right"><h3><?=$block->property->name?></h3></td>
	</tr>
</table>
<div class="block">
	<h4>Spray Predictions</h4>
	
	<?php 
	//$VARS['sprayInverse']
	?>
	<table class="prediction">
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
		<td>Biofix Date:</td>
		<?php 
		$h = array();
		foreach($sprayDates as $pest=>$v){
			$h[] = '<td>'.DateHelper::dateOutput($v->biofix).'</td>'.$next;
			$next = '';
			
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
					echo DateHelper::dateOutput($s->sprayDate);
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
					echo DateHelper::dateOutput($s->coverUntil);
				echo '</td>';
			}
		}
		echo '</tr>';
	}
	?>
</table>
		
	<h4>Population Graph</h4>
    <div class="graph">
        <?php
            if (empty($VARS['graphData'][$block->id]))
                echo 'There is no data for Graph.';
            else
                $this->Widget('ext.highcharts.HighchartsWidget', array(
								'options'=>$VARS['graphData'][$block->id]
						));
        ?>
    </div>

	<h4>Spray Logs</h4>
	<table>
		<tr class="head">
			<th>Date</th>
			<th>Chemical</th>
			<th>Quantity</th>
			<th>Cost</th>
		</tr>
		<?php 
		$total_cost = 0;
        $sql = "SELECT * FROM ". Spray::model()->tableName();
		$sql .= " WHERE block_id = {$block->id} AND ((YEAR(date) = YEAR(NOW()) AND MONTH(date) < 6) OR (YEAR(date) = YEAR(NOW())-1 AND MONTH(date) >= 6))";
		$sql .= " ORDER BY date";
		
		$res = Yii::app()->db->createCommand($sql)->query();
        $sprays = $res?$res->readAll():'';
		if ($sprays)
        {
            foreach($sprays as $spray){
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
			<th colspan="3">Total cost:</th>
			<td>$<?=number_format($total_cost,2)?></td>
		</tr>
	</table>
</div>
<?php 
}
?>
<input type="hidden" id="grower_id" value="<?=$VARS['grower']->id?>" />
<input type="hidden" id="date_from" value="<?=$VARS['dateRange']['date_from']?>" />
<input type="hidden" id="date_to" value="<?=$VARS['dateRange']['date_to']?>" />
<div id="print-footer">Created by Fruit Growers Victoria. Report problems to <b>fido@fgv.com.au</b></div>
</body>