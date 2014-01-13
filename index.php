<?php
/*
Plugin Name: Hide Adsense Ads for specific countries
Plugin URI: http://plugins.cbnewsplus.com
Description: Hide Adsense Ads for specific countries
Version: 1.2
Author: Cilene Bonfim 
Author URI: http://cbnewsplus.com
*/

add_action('init', 'haa_config');
register_activation_hook(__FILE__, 'haa_install');
register_deactivation_hook(__FILE__, 'haa_uninstall');

	global $wpdb;
	$prefix = $wpdb->prefix;
	define('HAA_COUNTRY_TABLE', $prefix.'haa_country'); 
	define('HAA_IP_TABLE', $prefix.'haa_ip');
	define('HAA_IP_TEMP', $prefix.'haa_ip_temp');
	define("HAA_DIR",plugins_url().'/hide-adsense-ads');
		
		
function haa_config(){
	if ( is_admin() ){
		wp_register_style('haa-style', HAA_DIR.'/js/style.css');
		wp_enqueue_style( 'haa-style');
		wp_register_script( 'haa_js_select', HAA_DIR.'/js/jquery.multi-select.js', array('jquery'));
		wp_enqueue_script ( 'haa_js_select', HAA_DIR.'/js/jquery.multi-select.js', array('jquery'));
		wp_register_script( 'haa_js_custom', HAA_DIR.'/js/custom.js', array('jquery'));
		wp_enqueue_script ( 'haa_js_custom', HAA_DIR.'/js/custom.js', array('jquery'));
	}
}	

function haa_install() {
	global $wpdb;
	$charset="";
	$collate="";
	if ( $wpdb->has_cap('collation') ) {
      if ( ! empty($wpdb->charset) )
         $charset = "DEFAULT CHARACTER SET $wpdb->charset";
      if ( ! empty($wpdb->collate) )
         $collate = "COLLATE $wpdb->collate";
	}
	haa_create_country_table($charset,$collate);
	haa_create_ip_table($charset,$collate);
	
	
	add_option('haa_country_hide1', '');
	add_option('haa_country_hide2', '');
	add_option('haa_country_hide3', '');
	
	add_option('haa_code_ad1', '');
	add_option('haa_code_ad2', '');
	add_option('haa_code_ad3', '');
		
		
add_option('haa_category_hide1', '');
add_option('haa_category_hide2', '');
add_option('haa_category_hide3', '');

add_option('haa_location_page1', '');
add_option('haa_location_page2', '');
add_option('haa_location_page3', '');

add_option('haa_post_hide1', '');
add_option('haa_post_hide2', '');
add_option('haa_post_hide3', '');
	
	
}

function haa_uninstall () {
    global $wpdb;
		$sql = "DROP TABLE ".HAA_COUNTRY_TABLE."";
		$wpdb->query($sql);
		$sql = "DROP TABLE ".HAA_IP_TABLE."";
		$wpdb->query($sql);
		$sql = "DROP TABLE ".HAA_IP_TEMP."";
		$wpdb->query($sql);
		
	delete_option('haa_country_hide1');
	delete_option('haa_country_hide2');
	delete_option('haa_country_hide3');
	
	delete_option('haa_code_ad1');
	delete_option('haa_code_ad2');
	delete_option('haa_code_ad3');

	delete_option('haa_category_hide1');
	delete_option('haa_category_hide2');
	delete_option('haa_category_hide3');

	delete_option('haa_location_page1');
	delete_option('haa_location_page2');
	delete_option('haa_location_page3');

	delete_option('haa_post_hide1');
	delete_option('haa_post_hide2');
	delete_option('haa_post_hide3');	
	
	
	
}


function haa_create_country_table($charset,$collate) {

	global $wpdb;
	$haa_country_table = HAA_COUNTRY_TABLE;
	
	if ( $wpdb->get_var( "SHOW TABLES LIKE $haa_country_table" ) != $haa_country_table ) {
	$sql = "CREATE TABLE " . $haa_country_table . " (
		id  tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
		name varchar(40) default NULL,
		code varchar(2) default NULL,
		PRIMARY KEY  (id),
		KEY code (code)
		) $charset $collate;";
			$wpdb->query($sql);
	}
	
$sql_1=<<<query1
INSERT INTO $haa_country_table (id, name, code) VALUES
	
	(1,'Anonymous Proxy', 'A1'),
	(2,'Australia', 'AU'),
	(3,'Malaysia', 'MY'),
	(4,'Korea', 'KR'),
	(5,'China', 'CN'),
	(6,'Japan', 'JP'),
	(7,'India', 'IN'),
	(8,'Taiwan', 'TW'),
	(9,'Hong Kong', 'HK'),
	(10,'Thailand', 'TH'),
	(11,'Vietnam', 'VN'),
	(12,'France', 'FR'),
	(13,'Italy', 'IT'),
	(14,'United Arab Emirates', 'AE'),
	(15,'Sweden', 'SE'),
	(16,'Kazakhstan', 'KZ'),
	(17,'Portugal', 'PT'),
	(18,'Greece', 'GR'),
	(19,'Saudi Arabia', 'SA'),
	(20,'Russian Federation', 'RU'),
	(21,'United Kingdom', 'GB'),
	(22,'Denmark', 'DK'),
	(23,'United States', 'US'),
	(24,'Canada', 'CA'),
	(25,'Mexico', 'MX'),
	(26,'Bermuda', 'BM'),
	(27,'Puerto Rico', 'PR'),
	(28,'Virgin Islands, U.S.', 'VI'),
	(29,'Germany', 'DE'),
	(30,'Iran', 'IR'),
	(31,'Bolivia', 'BO'),
	(32,'Montserrat', 'MS'),
	(33,'Netherlands', 'NL'),
	(34,'Israel', 'IL'),
	(35,'Spain', 'ES'),
	(36,'Bahamas', 'BS'),
	(37,'Saint Vincent and the Grenadines', 'VC'),
	(38,'Chile', 'CL'),
	(39,'New Caledonia', 'NC'),
	(40,'Argentina', 'AR'),
	(41,'Dominica', 'DM'),
	(42,'Singapore', 'SG'),
	(43,'Nepal', 'NP'),
	(44,'Philippines', 'PH'),
	(45,'Indonesia', 'ID'),
	(46,'Pakistan', 'PK'),
	(47,'Tokelau', 'TK'),
	(48,'New Zealand', 'NZ'),
	(49,'Cambodia', 'KH'),
	(50,'Macau', 'MO'),
	(51,'Papua New Guinea', 'PG'),
	(52,'Maldives', 'MV'),
	(53,'Afghanistan', 'AF'),
	(54,'Bangladesh', 'BD'),
	(55,'Ireland', 'IE'),
	(56,'Belgium', 'BE'),
	(57,'Belize', 'BZ'),
	(58,'Brazil', 'BR'),
	(59,'Switzerland', 'CH'),
	(60,'South Africa', 'ZA'),
	(61,'Egypt', 'EG'),
	(62,'Nigeria', 'NG'),
	(63,'Tanzania', 'TZ'),
	(64,'Zambia', 'ZM'),
	(65,'Senegal', 'SN'),
	(66,'Ghana', 'GH'),
	(67,'Sudan', 'SD'),
	(68,'Cameroon', 'CM'),
	(69,'Malawi', 'MW'),
	(70,'Angola', 'AO'),
	(71,'Kenya', 'KE'),
	(72,'Gabon', 'GA'),
	(73,'Mali', 'ML'),
	(74,'Benin', 'BJ'),
	(75,'Madagascar', 'MG'),
	(76,'Chad', 'TD'),
	(77,'Botswana', 'BW'),
	(78,'Libya', 'LY'),
	(79,'Cape Verde', 'CV'),
	(80,'Rwanda', 'RW'),
	(81,'Mozambique', 'MZ'),
	(82,'Gambia', 'GM'),
	(83,'Lesotho', 'LS'),
	(84,'Mauritius', 'MU'),
	(85,'Congo', 'CG'),
	(86,'Uganda', 'UG'),
	(87,'Burkina Faso', 'BF'),
	(88,'Sierra Leone', 'SL'),
	(89,'Somalia', 'SO'),
	(90,'Zimbabwe', 'ZW'),
	(91,'Democratic Republic Of The Congo', 'CD'),
	(92,'Niger', 'NE'),
	(93,'Central African Republic', 'CF'),
	(94,'Swaziland', 'SZ'),
	(95,'Togo', 'TG'),
	(96,'Guinea', 'GN'),
	(97,'Liberia', 'LR'),
	(98,'Seychelles', 'SC'),
	(99,'Morocco', 'MA'),
	(100,'Algeria', 'DZ'),
	(101,'Mauritania', 'MR'),
	(102,'Namibia', 'NA'),
	(103,'Djibouti', 'DJ'),
	(105,'Comoros', 'KM'),
	(106,'Reunion', 'RE'),
	(107,'Equatorial Guinea', 'GQ'),
	(108,'Tunisia', 'TN'),
	(109,'Turkey', 'TR'),
	(110,'Poland', 'PL'),
	(111,'Latvia', 'LV'),
	(112,'Ukraine', 'UA'),
	(113,'Belarus', 'BY'),
	(114,'Czech Republic', 'CZ'),
	(115,'Palestinian Territory', 'PS'),
	(116,'Iceland', 'IS'),
	(117,'Cyprus', 'CY'),
	(118,'Hungary', 'HU'),
	(119,'Slovakia', 'SK'),
	(120,'Serbia', 'RS'),
	(121,'Bulgaria', 'BG'),
	(122,'Oman', 'OM'),
	(123,'Romania', 'RO'),
	(124,'Georgia', 'GE'),
	(125,'Norway', 'NO'),
	(126,'Armenia', 'AM'),
	(127,'Austria', 'AT'),
	(128,'Albania', 'AL'),
	(129,'Slovenia', 'SI'),
	(130,'Panama', 'PA'),
	(131,'Brunei Darussalam', 'BN'),
	(132,'Sri Lanka', 'LK'),
	(133,'Montenegro', 'ME'),
	(134,'Europe', 'EU'),
	(135,'Tajikistan', 'TJ'),
	(136,'Iraq', 'IQ'),
	(137,'Lebanon', 'LB'),
	(138,'Moldova', 'MD'),
	(139,'Finland', 'FI'),
	(140,'Estonia', 'EE'),
	(141,'Bosnia and Herzegovina', 'BA'),
	(142,'Kuwait', 'KW'),
	(143,'Aland Islands', 'AX'),
	(144,'Lithuania', 'LT'),
	(145,'Luxembourg', 'LU'),
	(146,'Antigua and Barbuda', 'AG'),
	(147,'Macedonia', 'MK'),
	(148,'San Marino', 'SM'),
	(149,'Malta', 'MT'),
	(150,'Falkland Islands', 'FK'),
	(151,'Bahrain', 'BH'),
	(152,'Uzbekistan', 'UZ'),
	(153,'Azerbaijan', 'AZ'),
	(154,'Monaco', 'MC'),
	(155,'Haiti', 'HT'),
	(156,'Guam', 'GU'),
	(157,'Jamaica', 'JM'),
	(158,'United States Minor Outlying Islands', 'UM'),
	(159,'Micronesia', 'FM'),
	(160,'Ecuador', 'EC'),
	(161,'Peru', 'PE'),
	(162,'Cayman Islands', 'KY'),
	(163,'Colombia', 'CO'),
	(164,'Honduras', 'HN'),
	(165,'Netherlands Antilles', 'AN'),
	(166,'Yemen', 'YE'),
	(167,'Virgin Islands, British', 'VG'),
	(168,'Syria', 'SY'),
	(169,'Nicaragua', 'NI'),
	(170,'Dominican Republic', 'DO'),
	(171,'Grenada', 'GD'),
	(172,'Guatemala', 'GT'),
	(173,'Costa Rica', 'CR'),
	(174,'El Salvador', 'SV'),
	(175,'Venezuela', 'VE'),
	(176,'Barbados', 'BB'),
	(177,'Trinidad and Tobago', 'TT'),
	(178,'Bouvet Island', 'BV'),
	(179,'Marshall Islands', 'MH'),
	(180,'Cook Islands', 'CK'),
	(181,'Gibraltar', 'GI'),
	(182,'Paraguay', 'PY'),
	(247,'South Sudan', 'SS'),
	(184,'Samoa', 'WS'),
	(185,'Saint Kitts and Nevis', 'KN'),
	(186,'Fiji', 'FJ'),
	(187,'Uruguay', 'UY'),
	(188,'Northern Mariana Islands', 'MP'),
	(189,'Palau', 'PW'),
	(190,'Qatar', 'QA'),
	(191,'Jordan', 'JO'),
	(192,'American Samoa', 'AS'),
	(193,'Turks and Caicos Islands', 'TC'),
	(194,'Saint Lucia', 'LC'),
	(195,'Mongolia', 'MN'),
	(196,'Holy See', 'VA'),
	(197,'Aruba', 'AW'),
	(198,'Guyana', 'GY'),
	(199,'Suriname', 'SR'),
	(200,'Isle of Man', 'IM'),
	(201,'Vanuatu', 'VU'),
	(202,'Croatia', 'HR'),
	(203,'Anguilla', 'AI'),
	(204,'Saint Pierre and Miquelon', 'PM'),
	(205,'Guadeloupe', 'GP'),
	(206,'Saint Martin', 'MF'),
	(207,'Guernsey', 'GG'),
	(208,'Burundi', 'BI'),
	(209,'Turkmenistan', 'TM'),
	(210,'Kyrgyzstan', 'KG'),
	(211,'Myanmar', 'MM'),
	(212,'Bhutan', 'BT'),
	(213,'Liechtenstein', 'LI'),
	(214,'Faroe Islands', 'FO'),
	(215,'Ethiopia', 'ET'),
	(216,'Martinique', 'MQ'),
	(217,'Jersey', 'JE'),
	(218,'Andorra', 'AD'),
	(219,'Antarctica', 'AQ'),
	(220,'British Indian Ocean Territory', 'IO'),
	(221,'Greenland', 'GL'),
	(222,'Guinea-Bissau', 'GW'),
	(223,'Eritrea', 'ER'),
	(224,'Wallis and Futuna', 'WF'),
	(225,'French Polynesia', 'PF'),
	(226,'Cuba', 'CU'),
	(227,'Tonga', 'TO'),
	(228,'Timor-Leste', 'TL'),
	(229,'Sao Tome and Principe', 'ST'),
	(230,'French Guiana', 'GF'),
	(231,'Solomon Islands', 'SB'),
	(232,'Tuvalu', 'TV'),
	(233,'Kiribati', 'KI'),
	(234,'Niue', 'NU'),
	(235,'Norfolk Island', 'NF'),
	(236,'Nauru', 'NR'),
	(237,'Mayotte', 'YT'),
	(238,'Pitcairn Islands', 'PN'),
	(239,'Cote D\'Ivoire', 'CI'),
	(240,'Lao', 'LA'),
	(241,'Democratic People\'s Republic of Korea', 'KP'),
	(242,'Svalbard and Jan Mayen', 'SJ'),
	(243,'Saint Helena', 'SH'),
	(244,'Cocos (Keeling) Islands', 'CC'),
	(245,'Western Sahara', 'EH');

query1;
$wpdb->query($sql_1);
	
}

function haa_create_ip_table($charset,$collate) {
	global $wpdb;
	$haa_ip_table = HAA_IP_TABLE;

	if ( $wpdb->get_var( "SHOW TABLES LIKE $haa_ip_table" ) != $haa_ip_table ) {
	$sql = "CREATE TABLE " . $haa_ip_table . " (
		id int(4) unsigned NOT NULL AUTO_INCREMENT,
		begin_ip int(4) unsigned default NULL,
		end_ip int(4) unsigned default NULL,
		country varchar(2),
		number int(2),
		KEY id (id),
		KEY begin_ip (begin_ip)
		) $charset $collate;";
			$wpdb->query($sql);
	}
}

function haa_add_menu() {
	add_options_page('Hide Adsense Ad', 'Hide Adsense Ad', 8, __FILE__, 'haa_options_page');
}

add_action('admin_menu', 'haa_add_menu');

if(isset($_GET['action']) && $_GET['action']=="csv"){ haa_ip_csv_import();}

function haa_options_page() {
	 global $wpdb;
	 $page = $_SERVER['PHP_SELF']."?page=".$_GET['page'];
		if (!isset($_GET['tab'])){$menu_tab=1;}else{$menu_tab=$_GET['tab'];}
?>	
<div class="wrap">
	<h2>Hide Adsense Ad Setting</h2>
	<hr style="margin-bottom:12px;">
	<h2 class="nav-tab-wrapper">
		<a href="<?php echo $page."&amp;tab=1"; ?>" class="nav-tab <?php echo $menu_tab==1 ? "nav-tab-active" : "" ; ?>">[hide-adsense-block number=1]</a>
		<a href="<?php echo $page."&amp;tab=2"; ?>" class="nav-tab <?php echo $menu_tab==2 ? "nav-tab-active" : "" ; ?>">[hide-adsense-block number=2]</a>
		<a href="<?php echo $page."&amp;tab=3"; ?>" class="nav-tab <?php echo $menu_tab==3 ? "nav-tab-active" : "" ; ?>">[hide-adsense-block number=3]</a>
	</h2>
	<div style="margin-bottom:20px;"></div>

<?php
	
hide_setting_configuration($menu_tab);
	
echo "</div>";
}


function hide_setting_configuration ($val=1){
	 global $wpdb;
	$number=$val;
	 
	if(isset($_POST['ssubmit'])) {
                $_POST = stripslashes_deep( $_POST );

		$number = $_POST['ssubmit'];
		$haa_code_ad_a= "haa_code_ad".$number;
		$haa_country_hide_a = "haa_country_hide".$number;
		$haa_category_hide_a="haa_category_hide".$number;
		$haa_location_page_a="haa_location_page".$number;
		$haa_post_hide_a = "haa_post_hide".$number;
		
		$haa_country_hide = $_POST['haa_country_hide'];
		update_option($haa_country_hide_a, $haa_country_hide);
			
		$haa_code_ad = $_POST['haa_code_ad']; 
		update_option($haa_code_ad_a, $haa_code_ad);
		
		
		$haa_category_hide = $_POST['haa_category_hide']; 
		update_option($haa_category_hide_a, $haa_category_hide);
		
		$haa_location_page = $_POST['haa_location_page']; 
		update_option($haa_location_page_a, $haa_location_page);
		
		$haa_post_hide = $_POST['haa_post_hide']; 
		update_option($haa_post_hide_a, $haa_post_hide);
		
		
		echo '<div class="updated" id="haa-updated"><p>settings updated.</p></div>';
		
		if (get_option($haa_country_hide_a)){
		$sql = "DELETE FROM ".HAA_IP_TABLE." WHERE number='".$number."' ";
		$wpdb->query($sql);
		
		$sql ="INSERT INTO ".HAA_IP_TABLE." (begin_ip, end_ip, country, number) SELECT begin_ip, end_ip, country,".$number." FROM ".HAA_IP_TEMP." WHERE  ".HAA_IP_TEMP.".country IN ('".implode("','",get_option($haa_country_hide_a))."') ";
		$wpdb->query($sql);
		}
if (!get_option($haa_country_hide_a)){
		$sql = "DELETE FROM ".HAA_IP_TABLE." WHERE number='".$number."' ";
		$wpdb->query($sql);


}		


	}
	
	$error_csv="<div class='error' style='padding:6px;'>Please do import csv file to the database (click 'Import CSV',). It may take some time</div>
	<script type='text/javascript'>
		var $ = jQuery.noConflict();
		jQuery(document).ready( function($){
			$('#hide-full').find('input, textarea, button, select').attr('disabled','disabled');
			$('#hide-full').find('input, textarea, button, select, .ms-container').fadeTo('slow',.2);
			$('#hide-full').find('.ms-container').css({});
		});
	</script>
	
	";
	
	$tmp_table = $wpdb->get_var( "SHOW TABLES LIKE '".HAA_IP_TEMP."' ;" );
	if (empty($tmp_table)){ echo $error_csv; 
	}else{
		$ip_count = $wpdb->get_var( "SELECT COUNT(*) FROM ".HAA_IP_TEMP );
		if ($ip_count<70000){ echo $error_csv; }
	}
	
	echo "<a href='".$_SERVER['PHP_SELF']."?page=".$_GET['page']."&amp;action=csv' id='add-new-csv'>".__('Import CSV','as')."</a>";
	$haa_country_hide_a="haa_country_hide".$number;
	$haa_country_hide = get_option($haa_country_hide_a);
	if (empty($haa_country_hide)){$haa_country_hide=Array();}
	
			$haa_location_page_array = array('none'=>'none','left_float'=>'left_float','right_float'=>'right_float','before_content'=>'before_content','after_content'=>'after_content');
			$haa_location_page_a = "haa_location_page".$number;
			$haa_location_page  = get_option($haa_location_page_a);
			$haa_post_hide = "haa_post_hide".$number;
	
	?>
	
	<div id="hide-full">
	<form method="post">
	<input type="hidden" name = "ssubmit" value="<?php echo $number; ?>">
	<fieldset class="options">
		<select multiple="multiple" id="country-select" class="ms-container" name="haa_country_hide[]">
		<?php
			$query = "SELECT * FROM ".HAA_COUNTRY_TABLE." ORDER BY name ASC";
			$data =  $wpdb->get_results($query, ARRAY_A);
			foreach ($data as $key=>$l){
					echo "<option value='".$data[$key]['code']."'";
					if(in_array($data[$key]['code'], $haa_country_hide)) {echo " selected ";}else{echo "";}
					echo ">".$data[$key]['name']."</option>";
		}

		$haa_code_ad= "haa_code_ad".$number;
		
			?>
		</select>
		<p>Put Your Google Adsense Code or Any HTML Code Here: </p>
		<textarea name="haa_code_ad" rows="15" cols="100"><?php echo get_option($haa_code_ad); ?></textarea>	



		<p>Posts <input type="checkbox" name="haa_post_hide" value="Y" <?php if (get_option($haa_post_hide)=='Y'){echo "checked";} ?>> 
		Display in : 
		<select name="haa_location_page" style="width:160px">
		<?
					foreach ($haa_location_page_array as $key=>$l){
					echo "<option value='".$haa_location_page_array[$key]."'";
					if( $haa_location_page_array[$l] == $haa_location_page){echo " selected ";}else{echo "";}
					echo ">".$haa_location_page_array[$l]."</option>";
		}
		?>
		</select> 
		</p>
<?php   
	$args = array(
			'type'                     => 'post',
			'child_of'                 => 0,
			'parent'                   => '',
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'exclude'                  => '',
			'include'                  => '',
			'number'                   => '2',
			'taxonomy'                 => 'category',
			'pad_counts'               => false 
		); 
	$example_cat="";
	$categories = get_categories($args);
	foreach($categories as $category) { 
		$example_cat.= $category->slug. ", ";
	}
	$example_cat .="...";
?>
		<p>Do not display ads to this category :  <input type="text" name="haa_category_hide" value="<?php echo get_option('haa_category_hide'.$number); ?>" size="30" maxlength="200"/> (e.g : <?php echo $example_cat; ?>)	</p>
		<div style="clear:both"><br /></div>



		
		
		
		
		<div style="clear:both"><br /></div>
		<input type="submit" value="SAVE" />
	</fieldset>
	</form>
	</div>
	

<?php
}

function haa_ip_csv_import(){
	global $wpdb;
	$csv_file = plugins_url()."/hide-adsense-ads/GeoIPCountryCSV/GeoIPCountryWhois.csv";

		$sql = "DROP TABLE ".HAA_IP_TEMP;
		$wpdb->query($sql);
		
		$sql = "CREATE TABLE ".HAA_IP_TEMP." (col1 TINYINT(1),col2 TINYINT(1),begin_ip int(4) unsigned,end_ip int(4) unsigned,country varchar(2))";
		$wpdb->query($sql);
	
	
//---- ANOTHER METHOD ---------------------------------------------------------------	
	$line=0;$data_p="";
	if (($handle = fopen($csv_file, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 150, ",")) !== FALSE) {
			$line++; //100
			$data_p .= "(".$data[2].",".$data[3].",'".$data[4]."'),";
			if($line>=10000){
				$sql = "INSERT INTO ".HAA_IP_TEMP." (begin_ip,end_ip,country) VALUES ".substr($data_p, 0, strlen($data_p)-1).";";
				$wpdb->query($sql);	
				$line=0;$data_p="";
			}
		}
	}

	$sql = "INSERT INTO ".HAA_IP_TEMP." (begin_ip,end_ip,country) VALUES ".substr($data_p, 0, strlen($data_p)-1).";";
	$wpdb->query($sql);	
//---- ANOTHER METHOD ---------------------------------------------------------------	

	
 // $sql = 'LOAD DATA LOCAL INFILE "'.$csv_file.'" REPLACE INTO TABLE '.HAA_IP_TEMP.' FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY """" '; 
 //	$wpdb->query($sql);



		$sql = "ALTER TABLE ".HAA_IP_TEMP." DROP col1, DROP col2";
		$wpdb->query($sql);
		
		if (get_option('haa_country_hide')){
		$sql = "TRUNCATE TABLE ".HAA_IP_TABLE;
		$wpdb->query($sql);
		$sql ="INSERT INTO ".HAA_IP_TABLE." (begin_ip, end_ip, country) SELECT begin_ip, end_ip, country FROM ".HAA_IP_TEMP." WHERE  ".HAA_IP_TEMP.".country IN ('".implode("','",get_option('haa_country_hide'))."') ";
		$wpdb->query($sql);
		}

}


add_shortcode('hide-adsense-block', 'wp_content_adsense_hide');

function  wp_content_adsense_hide($atts){
    global $wpdb;
	if (!isset($atts['number']) && empty($atts['number'])){ $number = 1; }else{$number =  $atts['number'];}
	$haa_code_ad_a= "haa_code_ad".$number;	
	//----------- HIDE IP	 ---------------------------------------------------
	$ip = $_SERVER["REMOTE_ADDR"]; 
	$ip_count = $wpdb->get_var( "SELECT COUNT(*) FROM ".HAA_IP_TABLE." WHERE number='".$number."' AND begin_ip <= INET_ATON('".$ip."') AND end_ip >= INET_ATON('".$ip."')" );
	if ($ip_count==0){return  get_option($haa_code_ad_a);}			
}




add_filter('the_content', 'wp_content_adsense_hide_post');

function  wp_content_adsense_hide_post($content=''){
    global $wpdb;

	
//----------- HIDE (ONLY SINGLE POST)	 ---------------------------------------------------
	if(!is_single()){ return $content; }

	
for ($number=1;$number<=3;$number++){
if (get_option('haa_post_hide'.$number)=='Y'){	
	
	
//----------- HIDE CATEGORY	 ---------------------------------------------------
	$category_hide = trim(strtolower(get_option('haa_category_hide'.$number)));
	$category_hide_array= array();
	if (!empty($category_hide)){
		$category_hide_array = explode(",", strtolower($category_hide));
	}
	foreach((get_the_category()) as $post_category) {
		if (in_array($post_category->slug,$category_hide_array)){
	       return $content;
		}
	}
//----------- HIDE IP	 ---------------------------------------------------
	$ip = $_SERVER["REMOTE_ADDR"]; //$ip = "178.165.20.65";
	$ip_count = $wpdb->get_var( "SELECT COUNT(*) FROM ".HAA_IP_TABLE." WHERE number='".$number."' AND begin_ip <= INET_ATON('".$ip."') AND end_ip >= INET_ATON('".$ip."')" );
	if ($ip_count>0){ return $content; }

//----------- SHOW	 ---------------------------------------------------		
	$location = get_option('haa_location_page'.$number);
	$code = get_option('haa_code_ad'.$number);

	switch ($location) {
		case 'left_float':
			return "<div style='float:left;padding:8px 8px 8px 0px;'>" . $code . "</div>" . $content;
			break;
		case 'right_float':
			return "<div style='float:right;padding:8px 0px 8px 8px;'>" . $code . "</div>" . $content;
			break;
		case 'before_content':
			return "<div>" . $code . "</div>" . $content;		
			break;
		case 'after_content':
			return $content . "<div>" . $code . "</div>";		
			break;
		default:
			return $content;
			break;
	}
	}
}
}

?>