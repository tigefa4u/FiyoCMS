<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');
 
$newVisitor = $allVisitor = $dateList = '';
for($x = 10; $x >= 0; $x--) {
	$dateList .= "'".date('d M',strtotime("-$x days"))."'";
	if($x != 0) $dateList .= ",";
}

for($x = 10; $x >= 0; $x--) {
	$dtf = date('Y-m-d 00:00:00',strtotime("-$x days"));
	$z = $x-1;
	$dts = date('Y-m-d 00:00:00',strtotime("-$z days"));	
	$v = FQuery('statistic',"time BETWEEN '$dtf' AND '$dts'","","","time ASC");
	if(empty($v))  $allVisitor .= 0; else $allVisitor .= $v;
	if($x != 0) $allVisitor .= ",";
}
$z = 1;
for($x = 10; $x >= 0; $x--) {
	$dtf = date('Y-m-d 00:00:00',strtotime("-$x days"));
	$t = $x-1;
	$dtf = date('Y-m-d 00:00:00',strtotime("-$t days"));	
	

	$db = new FQuery();  
	$db -> connect();	
	$sql = $db->select(FDBPrefix."statistic","*,COUNT(DISTINCT ip) AS q","time < '$dtf'","time ASC");
	$row = mysql_fetch_array($sql); 
		$unique = $row['q'] - $z; 
		if($unique < 0 ) $unique = 0;
	$z = $row['q'];
	if(empty($unique))  $newVisitor .= 0; else $newVisitor .= $unique;
	if($x != 0) $newVisitor .= ",";

}
 
echo "
<script>
$(function () {
    var chart;
	var allVisitor = [$allVisitor];
	var newVisitor = [$newVisitor];
	var dateList = [$dateList];
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'statistic',
                type: 'area'
            },
            title: {
                text: '',
            },
            xAxis: {
                categories: dateList,
                title: {
                    text: ''
                }
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.y +' Visits</b><br/>'+
                        this.x+' ".date('Y')."';
                }
            },
            series: [{
                name: 'All Visitors',				
                data: allVisitor,
            },{
                name: 'New Visitor(s)',
                data: newVisitor,
            }]
        });
    });
    
});
</script>";
?>
<li>
	<h3>Website Information</h3>
	<div class="isi">
		<span class='hide' id="dateStatistic"><?php date('d')-10;?></span>
		<div class="acmain open">
		<div id="statistic" style="min-width: 420px; height: 200px; margin: 10px 5px 0 -5px;">
		
		</div>						
		<div class='box-v'><span class='left'><b><?php echo date('l, F d, Y'); ?></b></span><span class='right'>Total Visitors : <b><?php echo angka(FQuery('statistic')); ?></b></div>
		</div>
	</div>	
</li>