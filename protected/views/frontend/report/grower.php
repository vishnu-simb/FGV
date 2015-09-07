 <style type="text/css" media="all">
	/******** Normalise.css ********/
		
		article, aside, details, figcaption, figure, footer, header, hgroup, nav, section { display: block; }
		audio[controls], canvas, video { display: inline-block; *display: inline; *zoom: 1; }
		
		html { font-size: 100%; overflow-y: scroll; -webkit-tap-highlight-color: rgba(0,0,0,0); -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
		
		body { margin: 0; font-size: 13px; line-height: 1.231; }
		
		body, button, input, select, textarea { font-family: sans-serif; color: #222; }
		
		::-moz-selection { background: #fe57a1; color: #fff; text-shadow: none; }
		::selection { background: #fe57a1; color: #fff; text-shadow: none; }
		
		a { color: #00e; }
		a:visited { color: #551a8b; }
		a:focus { outline: thin dotted; }
		
		a:hover, a:active { outline: 0; }
		
		abbr[title] { border-bottom: 1px dotted; }
		
		b, strong { font-weight: bold; }
		
		blockquote { margin: 1em 40px; }
		
		dfn { font-style: italic; }
		
		hr { display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; }
		
		ins { background: #ff9; color: #000; text-decoration: none; }
		
		mark { background: #ff0; color: #000; font-style: italic; font-weight: bold; }
		
		pre, code, kbd, samp { font-family: monospace, monospace; _font-family: 'courier new', monospace; font-size: 1em; }
		
		pre { white-space: pre; white-space: pre-wrap; word-wrap: break-word; }
		
		q { quotes: none; }
		q:before, q:after { content: ""; content: none; }
		
		small { font-size: 85%; }
		
		sub, sup { font-size: 75%; line-height: 0; position: relative; vertical-align: baseline; }
		sup { top: -0.5em; }
		sub { bottom: -0.25em; }
		
		ul, ol { margin: 1em 0; padding: 0 0 0 40px; }
		dd { margin: 0 0 0 40px; }
		nav ul, nav ol { list-style: none; margin: 0; padding: 0; }
		
		img { border: 0; -ms-interpolation-mode: bicubic; vertical-align: middle; }
		svg:not(:root) { overflow: hidden; }
		
		figure { margin: 0; }
		
		form { margin: 0; }
		fieldset { border: 0; margin: 0; padding: 0; }
		legend { border: 0; *margin-left: -7px; padding: 0; }
		label { cursor: pointer; }
		button, input, select, textarea { font-size: 100%; margin: 0; vertical-align: baseline; *vertical-align: middle; }
		button, input { line-height: normal; *overflow: visible; }
		table button, table input { *overflow: auto; }
		button, input[type="button"], input[type="reset"], input[type="submit"] { cursor: pointer; -webkit-appearance: button; }
		input[type="checkbox"], input[type="radio"] { box-sizing: border-box; }
		input[type="search"] { -moz-box-sizing: content-box; -webkit-box-sizing: content-box; box-sizing: content-box; }
		button::-moz-focus-inner, input::-moz-focus-inner { border: 0; padding: 0; } 
		textarea { overflow: auto; vertical-align: top; resize: vertical; }
		input:valid, textarea:valid {  }
		input:invalid, textarea:invalid { background-color: #f0dddd; }
		
		table { border-collapse: collapse; border-spacing: 0; }
		
		/*** Begin custom styles ***/
		
		body {
			font-family: Helvetica, Arial, sans-serif;	
			font-size: 10pt;
			background: white;
			color: #333;
		}
		
		img {
			max-width: 100%;
			border: 1px solid #777;
		}
		
		table {
			width: 100%;
		}
		
		table.header {
			text-align: center;
			color: #444;
			font-size: 12pt;
			
			vertical-align: center;
		}
		
		tr.total {
			border-top: 2px double #666;
		}
		
		table.header span {
			color: #666;
			font-size: 18pt;
		}
		
		table.header h1 {
			color: #222;
			display: inline;
		}
		
		h1 {
			font-size: 14pt;
			font-weight: bold;
		}
		
		h2 {
			font-size: 20pt;
			color: #333;
			
		}
		
		h3 {
			font-size: 16pt;
			color: #666;
		}
		
		h4 {
			font-size: 14pt;
			margin-bottom: 10px;
			margin-left: 5px;
		}
		
		h1, h2, h3, h4, table.header {
			font-family: "Minion Pro", Georgia, sans-serif;
			
		}
		
		h2, h3 {
			margin-bottom: 0;
		}
		
		td, th  {
			padding: 5px;
			text-align: left;
		}
		
		.block {
			border-top: 2px solid #333;
			border-right: 1px dotted #aaa;
			padding-right: 10px;
			page-break-after:always;
		}
		
		.block table {
			margin-bottom: 20px;
			border: 1px solid #777 !important;
		}
		
		.prediction tr:last-child {
			border-bottom: 1px solid #777 !important;
		}
		
		.prediction tr:nth-child(even) {
			border-bottom: 1px solid #ddd;
		}
		
		.prediction tr:nth-child(even) td {
			padding-bottom: 15px;
		}
		
		.prediction tr:nth-child(odd) td {
			padding-top: 15px;
		}
		
		tr.head {
			background: #eee;	
			border-bottom: 3px solid #444 !important;
		}
		
		tr.head th {
			padding: 10px 5px;
		}
	
	tr.light {
		color: #777;
	}
	
	b {
		border-bottom: 1px dotted #aaa;
	}
	
	tr.single td {
		padding-bottom: 5px !important;
	}
	
	div#print-footer {
		display: block; 
		position: fixed; 
		bottom: 0; 
		width: 100%; 
		text-align: center;
	}
	
	</style>
	
	<style type="text/css" media="screen">
	html {
		background: #efefef;
	}
	
	body {
		width: 920px;
		margin: 50px auto;
		border: 1px solid #bbb;
		box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
		padding: 20px;
	}
	
	div#print-footer {
		position: static; 
		text-align: center;
	}
	</style>
<?php
	if(!empty($VARS['email'])){
		echo '<a href="',$VARS['link'],'">If this email doesnt load correctly, goto: ',$VARS['link'],'</a>';
	}
?>
<table class="header">
	<tr>
		<td width="25%" ><h1><?=$VARS['hasFollowYear']?></h1></td>
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
			$biofix = (date('Y',strtotime($v->biofix)) == $VARS['hasFollowYear'])?DateHelper::dateOutput($v->biofix):"";
			$h[] = '<td>'.DateHelper::dateOutput($biofix).'</td>'.$next;
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
					if(!isset($firstToBoldMap[$k]) && strtotime($s->sprayDate) > time()){
						$firstToBoldMap[$k] = true;
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
        
         <?php
            if (empty($VARS['graphMiteData'][$block->id]))
                echo 'There is no data for Graph.';
            else
                $this->Widget('ext.highcharts.HighchartsWidget', array(
								'options'=>$VARS['graphMiteData'][$block->id]
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
		if ($block->getSprays())
        {
            foreach($block->getSprays() as $spray){
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
