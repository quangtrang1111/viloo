<?php
/* ------------------------------------------------------------------------------------
*  COPYRIGHT AND TRADEMARK NOTICE
*  Copyright 2008-2015 Arnan de Gans. All Rights Reserved.
*  ADROTATE is a trademark of Arnan de Gans.

*  COPYRIGHT NOTICES AND ALL THE COMMENTS SHOULD REMAIN INTACT.
*  By using this code you agree to indemnify Arnan de Gans from any
*  liability that might arise from it's use.
------------------------------------------------------------------------------------ */

/*-------------------------------------------------------------
 Name:      adrotate_draw_graph

 Purpose:   Draw graph using ElyCharts
 Receive:   $id, $labels, $clicks, $impressions
 Return:    -None-
 Since:		3.8
-------------------------------------------------------------*/
function adrotate_draw_graph($id = 0, $labels = 0, $clicks = 0, $impressions = 0) {

	if($id == 0 OR !is_numeric($id) OR strlen($labels) < 1 OR strlen($clicks) < 1 OR strlen($impressions) < 1) {
		echo 'Syntax error, graph can not de drawn!';
	} else {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#chart-'.$id.'").chart({ 
			    type: "line",
			    margins: [5, 45, 45, 45],
		        values: {
		            serie1: ['.$clicks.'], serie2: ['.$impressions.']
		        },
        		labels: ['.$labels.'],
			    tooltips: function(env, serie, index, value, label) {
			        return "<div class=\"adrotate_label\">" + label + "<br /><span class=\"adrotate_clicks\">Clicks:</span> " + env.opt.values[\'serie1\'][index] + "<br /><span class=\"adrotate_impressions\">Impressions:</span> " + env.opt.values[\'serie2\'][index] + "</div>";
			    },
			    defaultSeries: {
					plotProps: { "stroke-width": 3 }, dot: true, rounded: true, dotProps: { stroke: "white", size: 5, "stroke-width": 1, opacity: 0 }, highlight: { scaleSpeed: 0, scaleEasing: "", scale: 1.2, newProps: { opacity: 1 } }, tooltip: { height: 55, width: 120, padding: [0], offset: [-10, -10], frameProps: { opacity: 0.95, stroke: "#000" } }
			    },
			    series: {
			        serie1: {
			            fill: true, fillProps: { opacity: .1 }, color: "#26B",
			        },
			        serie2: {
			            axis: "r", color: "#F80", plotProps: { "stroke-width": 2 }, dotProps: { stroke: "white", size: 3, "stroke-width": 1 }
			        }
			    },
			    defaultAxis: {
			        labels: true, labelsProps: { fill: "#777", "font-size": "10px", }, labelsAnchor: "start", labelsMargin: 5, labelsDistance: 8, labelsRotate: 65
			    },
 			    axis: {
			        l: { // left axis
			            labels: true, labelsDistance: 0, labelsSkip: 1, labelsAnchor: "end", labelsMargin: 15, labelsDistance: 4, labelsProps: { fill: "#26B", "font-size": "11px", "font-weight": "bold" }
			        },
			        r: { // right axis
			            labels: true, labelsDistance: 0, labelsSkip: 1, labelsAnchor: "start", labelsMargin: 15, labelsDistance: 4, labelsProps: { fill: "#F80", "font-size": "11px", "font-weight": "bold" }
			        }
			    },
			    features: {
			        mousearea: {
			            type: "axis"
			        },
			        tooltip: {
			            positionHandler: function(env, tooltipConf, mouseAreaData, suggestedX, suggestedY) {
			                return [mouseAreaData.event.pageX, mouseAreaData.event.pageY, true]
			            }
			        },
			        grid: {
			            draw: true, // draw both x and y grids
			            forceBorder: [true, true, true, true], // force grid for external border
			            props: {
			                stroke: "#eee" // color for the grid
			            }
			        }
			    }
			});
		});
		</script>
		';
	}

}

/*-------------------------------------------------------------
 Name:      adrotate_stats

 Purpose:   Generate latest number of clicks and impressions
 Receive:   $ad, $when
 Return:    $stats
 Since:		3.8
-------------------------------------------------------------*/
function adrotate_stats($ad, $when = 0, $until = 0) {
	global $wpdb;
	
	if($when > 0 AND is_numeric($when) AND $until > 0 AND is_numeric($until)) {
		$whenquery =  " AND `thetime` >= '$when' AND `thetime` <= '$until' GROUP BY `ad` ASC";
	} else if($when > 0 AND is_numeric($when) AND $until == 0) {
		$until = $when + 86400;
		$whenquery =  " AND `thetime` >= '$when' AND `thetime` <= '$until'";
	} else {
		$whenquery = "";
	}

	$ad_query = '';
	if(is_array($ad)) {
		$ad_query .= '(';
		foreach($ad as $key => $value) {
			$ad_query .= '`ad` = '.$value.' OR ';
		}
		$ad_query = rtrim($ad_query, " OR ");
		$ad_query .= ')';
	} else {
		$ad_query = '`ad` = '.$ad;
	}
	$stats = $wpdb->get_row("SELECT SUM(`clicks`) as `clicks`, SUM(`impressions`) as `impressions` FROM `{$wpdb->prefix}adrotate_stats` WHERE {$ad_query}{$whenquery};", ARRAY_A);

	if(empty($stats['clicks'])) $stats['clicks'] = '0';
	if(empty($stats['impressions'])) $stats['impressions'] = '0';

	return $stats;

}

/*-------------------------------------------------------------
 Name:      adrotate_stats_nav

 Purpose:   Create browsable links for graph
 Receive:   $type, $id, $month, $year
 Return:    $nav
 Since:		3.8
-------------------------------------------------------------*/
function adrotate_stats_nav($type, $id, $month, $year) {
	global $wpdb;

	$lastmonth = $month-1;
	$nextmonth = $month+1;
	$lastyear = $nextyear = $year;
	if($month == 1) {
		$lastmonth = 12;
		$lastyear = $year - 1;
	}
	if($month == 12) {
		$nextmonth = 1;
		$nextyear = $year + 1;
	}
	$months = array(__('January', 'adrotate'), __('February', 'adrotate'), __('March', 'adrotate'), __('April', 'adrotate'), __('May', 'adrotate'), __('June', 'adrotate'), __('July', 'adrotate'), __('August', 'adrotate'), __('September', 'adrotate'), __('October', 'adrotate'), __('November', 'adrotate'), __('December', 'adrotate'));
	
	if($type == 'ads') $page = 'adrotate-ads&view=report&ad='.$id;
	if($type == 'groups') $page = 'adrotate-groups&view=report&group='.$id;
	
	$nav = '<a href="admin.php?page='.$page.'&month='.$lastmonth.'&year='.$lastyear.'">&lt;&lt; '.__('Previous', 'adrotate').'</a> - ';
	$nav .= '<strong>'.$months[$month-1].' '.$year.'</strong> - ';
	$nav .= '(<a href="admin.php?page='.$page.'">'.__('This month', 'adrotate').'</a>) - ';
	$nav .= '<a href="admin.php?page='.$page.'&month='.$nextmonth.'&year='.$nextyear.'">'. __('Next', 'adrotate').' &gt;&gt;</a>';

	return $nav;
}

/*-------------------------------------------------------------
 Name:      adrotate_stats_graph

 Purpose:   Generate graph
 Receive:   $type, $id, $chartid, $start, $end
 Return:    $output
 Since:		3.8
-------------------------------------------------------------*/
function adrotate_stats_graph($type, $id, $chartid, $start, $end) {
	global $wpdb;

	if($type == 'ads' OR $type == 'advertiser') {
		$stats = $wpdb->get_results($wpdb->prepare("SELECT `thetime`, SUM(`clicks`) as `clicks`, SUM(`impressions`) as `impressions` FROM `{$wpdb->prefix}adrotate_stats` WHERE `ad` = %d AND `thetime` >= %d AND `thetime` <= %d GROUP BY `thetime` ASC;", $id, $start, $end), ARRAY_A);
	}

	if($type == 'groups') {
		$stats = $wpdb->get_results($wpdb->prepare("SELECT `thetime`, SUM(`clicks`) as `clicks`, SUM(`impressions`) as `impressions` FROM `{$wpdb->prefix}adrotate_stats` WHERE `group` = %d AND `thetime` >= %d AND `thetime` <= %d GROUP BY `thetime` ASC;", $id, $start, $end), ARRAY_A);
	}

	if($type == 'global-report') {
		$stats = $wpdb->get_results($wpdb->prepare("SELECT `thetime`, SUM(`clicks`) as `clicks`, SUM(`impressions`) as `impressions` FROM `{$wpdb->prefix}adrotate_stats` WHERE `thetime` >= %d AND `thetime` <= %d GROUP BY `thetime` ASC;", $start, $end), ARRAY_A);
	}
	
	if($type == 'advertiser-global') {
		$stats = $wpdb->get_results($wpdb->prepare("SELECT `thetime`, SUM(`clicks`) as `clicks`, SUM(`impressions`) as `impressions` FROM `{$wpdb->prefix}adrotate_stats`, `{$wpdb->prefix}adrotate_linkmeta` WHERE `{$wpdb->prefix}adrotate_stats`.`ad` = `{$wpdb->prefix}adrotate_linkmeta`.`ad` AND `{$wpdb->prefix}adrotate_linkmeta`.`user` = %d AND (`{$wpdb->prefix}adrotate_stats`.`thetime` >= %d AND `{$wpdb->prefix}adrotate_stats`.`thetime` <= %d) GROUP BY `thetime` ASC;", $id, $start, $end), ARRAY_A);
	}

	if($stats) {
		$dates = $clicks = $impressions = '';

		foreach($stats as $result) {
			if(empty($result['clicks'])) $result['clicks'] = '0';
			if(empty($result['impressions'])) $result['impressions'] = '0';
			
			$dates .= ',"'.date_i18n("d M", $result['thetime']).'"';
			$clicks .= ','.$result['clicks'];
			$impressions .= ','.$result['impressions'];
		}

		$dates = trim($dates, ",");
		$clicks = trim($clicks, ",");
		$impressions = trim($impressions, ",");
		
		$output = '';
		$output .= '<div id="chart-1" style="height:300px; width:100%;"></div>';
		$output .= adrotate_draw_graph($chartid, $dates, $clicks, $impressions);
		unset($stats, $dates, $clicks, $impressions);
	} else {
		$output = __('No data to show!', 'adrotate');
	} 

	return $output;
}

/*-------------------------------------------------------------
 Name:      adrotate_ctr

 Purpose:   Calculate Click-Through-Rate
 Receive:   $clicks, $impressions, $round
 Return:    $ctr
 Since:		3.7
-------------------------------------------------------------*/
function adrotate_ctr($clicks = 0, $impressions = 0, $round = 2) { 

	if($impressions > 0 AND $clicks > 0) {
		$ctr = round($clicks/$impressions*100, $round);
	} else {
		$ctr = 0;
	}
	
	return $ctr;
} 

/*-------------------------------------------------------------
 Name:      adrotate_date_start

 Purpose:   Get and return the localized UNIX time for the current hour, day and start of the week
 Receive:   $what
 Return:    int
 Since:		3.8.5.1
-------------------------------------------------------------*/
function adrotate_date_start($what) {
	$now = adrotate_now();
	$string = gmdate('Y-m-d H:i:s', time());
	preg_match('#([0-9]{1,4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $string, $matches);

	switch($what) {
		case 'hour' :
			$string_time = gmmktime($matches[4], 0, 0, $matches[2], $matches[3], $matches[1]);
			$result = gmdate('U', $string_time + (get_option('gmt_offset') * HOUR_IN_SECONDS));
		break;
		case 'day' :
			$timezone = get_option('timezone_string');
			if($timezone) {
				$server_timezone = date('e');
				date_default_timezone_set($timezone);
				$result = strtotime('00:00:00') + (get_option('gmt_offset') * HOUR_IN_SECONDS);
				date_default_timezone_set($server_timezone);
			} else {
				$result = gmdate('U', gmmktime(0, 0, 0, gmdate('n'), gmdate('j')));
			}
		break;
		case 'week' :
			$timezone = get_option('timezone_string');
			if($timezone) {
				$server_timezone = date('e');
				date_default_timezone_set($timezone);
				$result = strtotime('Last Monday', $now) + (get_option('gmt_offset') * HOUR_IN_SECONDS);
				date_default_timezone_set($server_timezone);
			} else {
				$result = gmdate('U', gmmktime(0, 0, 0));
			}
		break;
	}
	
	return $result;
}

/*-------------------------------------------------------------
 Name:      adrotate_now

 Purpose:   Get and return the localized UNIX time for "now"
 Receive:   -None-
 Return:    int
 Since:		3.8.6.2
-------------------------------------------------------------*/
function adrotate_now() {
	return time() + (get_option('gmt_offset') * HOUR_IN_SECONDS);
}

/*-------------------------------------------------------------
 Name:      adrotate_count_impression

 Purpose:   Count Impressions where needed
 Receive:   $ad, $group
 Return:    -None-
 Since:		3.10.12
-------------------------------------------------------------*/
function adrotate_count_impression($ad, $group = 0, $blog_id = 0) { 
	global $wpdb, $adrotate_config, $adrotate_debug;

	if(($adrotate_config['enable_loggedin_impressions'] == 'Y' AND is_user_logged_in()) OR !is_user_logged_in()) {
		$now = adrotate_now();
		$hour = adrotate_date_start('hour');
		$remote_ip 	= adrotate_get_remote_ip();

		if($adrotate_debug['timers'] == true) {
			$impression_timer = $now;
		} else {
			$impression_timer = $now - $adrotate_config['impression_timer'];
		}

		$transientkey = "adrotate_impression_".md5($ad.$remote_ip);
		$saved_timer = get_transient($transientkey);
		if(false === $saved_timer) {
			$saved_timer = 0;
		}

		if($saved_timer < $impression_timer AND adrotate_is_human()) {
			$stats = $wpdb->get_var($wpdb->prepare("SELECT `id` FROM `{$wpdb->prefix}adrotate_stats` WHERE `ad` = %d AND `group` = %d AND `thetime` = {$hour};", $ad, $group));
			if($stats > 0) {
				$wpdb->query("UPDATE `{$wpdb->prefix}adrotate_stats` SET `impressions` = `impressions` + 1 WHERE `id` = {$stats};");
			} else {
				$wpdb->insert($wpdb->prefix.'adrotate_stats', array('ad' => $ad, 'group' => $group, 'thetime' => $hour, 'clicks' => 0, 'impressions' => 1));
			}

			set_transient($transientkey, $now, $adrotate_config['impression_timer']);
		}
	}
} 

/*-------------------------------------------------------------
 Name:      adrotate_impression_callback

 Purpose:   Register a impression for dynamic groups
 Receive:   $_POST
 Return:    -None-
 Since:		3.10.14
-------------------------------------------------------------*/
function adrotate_impression_callback() {
	define('DONOTCACHEPAGE', true);
	define('DONOTCACHEDB', true);
	define('DONOTCACHCEOBJECT', true);

	global $adrotate_debug;

	$meta = $_POST['track'];
	if($adrotate_debug['track'] != true) {
		$meta = base64_decode($meta);
	}

	$meta = esc_attr($meta);
	// Don't use $impression_timer - It's for impressions used in javascript
	list($ad, $group, $blog_id, $impression_timer) = explode(",", $meta, 4);
	adrotate_count_impression($ad, $group, $blog_id);

	wp_die();
}


/*-------------------------------------------------------------
 Name:      adrotate_click_callback

 Purpose:   Register clicks for clicktracking
 Receive:   $_POST
 Return:    -None-
 Since:		3.10.14
-------------------------------------------------------------*/
function adrotate_click_callback() {
	define('DONOTCACHEPAGE', true);
	define('DONOTCACHEDB', true);
	define('DONOTCACHCEOBJECT', true);

	global $wpdb, $adrotate_config, $adrotate_debug;

	$meta = $_POST['track'];

	if($adrotate_debug['track'] != true) {
		$meta = base64_decode($meta);
	}
	
	$meta = esc_attr($meta);
	// Don't use $impression_timer - It's for impressions used in javascript
	list($ad, $group, $blog_id, $impression_timer) = explode(",", $meta, 4);

	if(is_numeric($ad) AND is_numeric($group) AND is_numeric($blog_id)) {
		if(($adrotate_config['enable_loggedin_clicks'] == 'Y' AND is_user_logged_in()) OR !is_user_logged_in()) {	
			$remote_ip = adrotate_get_remote_ip();

			if(adrotate_is_human() AND $remote_ip != "unknown" AND !empty($remote_ip)) {
				$now = adrotate_now();
				$hour = adrotate_date_start('hour');

				if($adrotate_debug['timers'] == true) {
					$click_timer = $now;
				} else {
					$click_timer = $now - $adrotate_config['click_timer'];
				}
	
				$transientkey = "adrotate_click_".md5($ad.$remote_ip);
				$saved_timer = get_transient($transientkey);
				if(false === $saved_timer) {
					$saved_timer = 0;
				}

				if($saved_timer < $click_timer) {
					$stats = $wpdb->get_var($wpdb->prepare("SELECT `id` FROM `{$wpdb->prefix}adrotate_stats` WHERE `ad` = %d AND `group` = %d AND `thetime` = {$hour};", $ad, $group));
					if($stats > 0) {
						$wpdb->query("UPDATE `{$wpdb->prefix}adrotate_stats` SET `clicks` = `clicks` + 1 WHERE `id` = {$stats};");
					} else {
						$wpdb->insert($wpdb->prefix.'adrotate_stats', array('ad' => $ad, 'group' => $group, 'thetime' => $hour, 'clicks' => 1, 'impressions' => 1));
					}

					set_transient($transientkey, $now, $adrotate_config['click_timer']);
				}
			}
		}

		unset($remote_ip, $track, $meta, $ad, $group, $remote, $banner);
	}

	wp_die();
}
?>