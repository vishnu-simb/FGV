<?php 
function dateOutputp($date){
	$date = dateOutput($date);
	return preg_replace('#(\-[0-9]+)$#','<span class="hide portrait">$1</span>',$date);
	return $date;
}
?>

<div class="ui-collapsible-heading">
	<span class="ui-btn ui-corner-top ui-btn-up-b tableheading">
		<span class="ui-btn-inner ui-corner-top ui-corner-bottom th">
		<?php 
		echo '<span>&nbsp;</span>';
		$second_cohort = false;
		foreach($VAR['spray_data'] as $pest=>$vv){
			if($VAR['pests'][$pest]->hasSecondCohort($VAR['block']->id)){
				$second_cohort = true;
			}
		}
		foreach($VAR['spray_data'] as $pest=>$vv){
			echo '<span';
			if(!$second_cohort && $pest == 'Codling Moth'){
				echo ' class="doublewidth"';
			}
			echo '>';
			echo $pest.'</span>';
			if($VAR['pests'][$pest]->hasSecondCohort($VAR['block']->id)){
				echo '<span><span class="doublewidth portrait">(2nd Cohort)</span>&nbsp;</span>';
			}
		}
		?>
		</span>
	</span>
</div>
<div class="ui-collapsible-content ui-body-d ui-corner-bottom tablebody">
<?php 
	$pm = array();
	foreach($VAR['spray_inverse'] as $sprayNo=>$vv){
		if($vv){
			echo '<div class="th"><span>'.$sprayNo.'st</span>	';
			
			foreach($vv as $pest=>$spray){
				
				if($spray){
					$date = $spray->getDate($VAR['block']->id);
					$ds = strtotime($date);
					if($ds >= time() && !isset($pm[$pest])){
						echo '<span class="new';
						if(!$second_cohort && $pest == 'Codling Moth'){
							echo ' doublewidth"';
						}
						echo '">';
						$pm[$pest] = true;
					}else{
						echo '<span';
						if(!$second_cohort && $pest == 'Codling Moth'){
							echo ' class="doublewidth"';
						}
						echo '>';
					}
					$d = dateOutputp($date);
					if($d){
						echo $d;
					}else{
						echo ' - ';
					}
					echo '</span>';
					
					if($VAR['pests'][$pest]->hasSecondCohort($VAR['block']->id)){
						/*if($spray->hasLowPopulation()){
							$lowPop = clone $spray;
							$lowPop->swapPopulationValues();
						}*/
						
						$date = $spray->getDate($VAR['block'],true);
						$ds = strtotime($date);
						if($ds >= time() && !isset($pm[$pest.'|2'])){
							echo '<span class="new"';
							if(!$second_cohort && $pest == 'Codling Moth'){
								echo ' doublewidth"';
							}
							echo '">';
							$pm[$pest.'|2'] = true;
						}else{
							echo '<span';
							if(!$second_cohort && $pest == 'Codling Moth'){
								echo ' class="doublewidth"';
							}
							echo '>';
						}
						$d = dateOutputp($date);
						if($d){
							echo $d;
						}else{
							echo ' - ';
						}
						echo '</span>';
					}
				}else{
					echo '<span';
					if(!$second_cohort && $pest == 'Codling Moth'){
						echo ' class="doublewidth"';
					}
					echo '>';
					echo ' - </span>';
					if($VAR['pests'][$pest]->hasSecondCohort($VAR['block']->id)){
						echo '<span';
						if(!$second_cohort && $pest == 'Codling Moth'){
							echo ' class="doublewidth"';
						}
						echo '>';
						echo ' - </span>';
					}
				}
			}
			echo '</div>';
			
			echo '<div class="th"><span><span class="portrait">Cover until:</span>&nbsp;</span>	';
			foreach($vv as $pest=>$spray){
				echo '<span';
				if(!$second_cohort && $pest == 'Codling Moth'){
					echo ' class="doublewidth"';
				}
				echo '>';
				if($spray){
					$d = dateOutputp($spray->getCoverRequired($VAR['block']->id));
					if($d){
						echo $d;
					}else{
						echo ' - ';
					}
					if($VAR['pests'][$pest]->hasSecondCohort($VAR['block']->id)){
						$d = dateOutputp($spray->getCoverRequired($VAR['block']->id,true));
						echo '</span><span>';
						if($d){
							echo $d;
						}else{
							echo ' - ';
						}
					}
				}else{
					echo ' - ';
					if($VAR['pests'][$pest]->hasSecondCohort($VAR['block']->id)){
						echo '</span><span> - ';
					}
				}
				echo '</span>';
			}
			echo '</div>';
		}
	}
	Yii::app()->end();
?>

</div>