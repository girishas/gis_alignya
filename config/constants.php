<?php
return array( 
	//"SITE_URL" 					=> "http://192.168.43.194/gis_alignya/",
	"SITE_URL" 					=> "http://172.20.10.12/gis_alignya/",
	"SITE_TITLE" 				=> "Alignya",
	"SITE_EMAIL" 				=> "support@alignya.com",
	'SITE_MODE'					=> "local", //change "local" to "live" on server
	"USER_ROLES" 				=> array(1=>'Admin', 2=>'Users'),
	"ROLE_URLS" 				=> array(1=>'admins', 2=>'users'),
	"PAGINATION" 				=> 10,
	"PAGINATION_COMMENTS" 		=> 3,
	"PAGINATION_FOLLOWERS" 		=> 9,
	"FRONT_PAGINATION" 			=> 10,
	"PAGINATION_NOTIFICATION"   => 20,
	"PAGINATION_GROUPS"   		=> 20,
	"YES_NO" 					=> array(1=>'Yes', 0=>'No'),
	"GENDER" 					=> array(1=>'Male',  2=>'Female'),
	"STATUS" 					=> array(1=>'Active', 0=>'Inactive',2=>'Blocked'),
	"MASTER_STATUS" 			=> array(1=>'Active', 0=>'Inactive'),
	"USER_THUMB_WIDTH"			=> 60,
	"USER_MEDIUM_WIDTH"			=> 124,
	"TAX_PER"					=> 0,
	'ADMIN_SITE_PRFIX'			=> "13061603",
	'EMBED_DOMAIN'				=> "streamer.studio",
	"COPYRIGHT_MESSAGE" 		=> "2020 Alignya - All rights reserved.",
	"GROUPPRIVACY" 				=> array(1=>'Public',  2=>'Private', '3' => 'On Invitation'),
	"LEVELS" 					=> array(1=>'Level 1', 2=>'Level 2', 3=>'Level 3'),
	"SiteValue" 				=> array('paypal_mode'=>'sandbox', 'paypal_api_username'=>'gaurav2212016-facilitator_api1.outlook.com','paypal_api_password'=>'FWLUFB9PHDMB8FEK','paypal_api_signature'=>'ABhCI5kfIeM7nPsgeZJqsnMV8P31A4uQZkk.5ga1YIzaRNeUXsTUjdYJ'),
	"Quarter" => array(0=>'FULL',1=>'Q1',2=>'Q2',3=>'Q3',4=>'Q4',5=>'H1',6=>'H2'),
	"PAGE_PRODUCT_ID" 			=> "prod_DeLuHBDVQAx40r",
	"PLAN_PERIOD" => array(1=>'Monthly',2=>'Yearly'),
	"COMPANY_FISCAL_MONTH" => array(1=>"January",2=>"February",3=>"March",4=>"April",5=>"May",6=>"June",7=>"July",8=>"Auguest",9=>"September",10=>"October",11=>"November",12=>"December"),
	"USER_TYPES" => array(2=>"Company Owner", 3=>"Hod",4=>"Team Lead",5=>"Member"),
	"SCORECARD_STATUS" => array(1=>"Active",0=>"Inactive"),
	"FREQUENCY" => array('1'=>'Daily',2=>'Weekly',3=>'Monthly'),
	"MEASURE_TYPE" => array("binary"=>"Binary","value"=>"Value","currency"=>"Currency","percentage"=>"Percentage","revenue"=>"Revenue"),
	"GOAL_VISIBILITY" => array("public"=>"Public","private"=>"Private","restricted"=>"Restricted"),
	"CONFIDANCE_LEVEL" => array("At Risk"=>"At Risk","No Issues"=>"No Issues","Ahead of Plan"=>"Ahead of Plan"),
	"TRIAL_DAYS" => 30,
	"DEFAULT_CYCLES" => array(12=>'Time Period of 1 Year',36=>'Time Period of 3 Year',60=>'Time Period of 5 Year'),
	"DATE_FORMAT" => "F m Y",
	"STRIPE_PK" => "pk_test_XBiHnVt8ZN2PFMvDa0wG6sUP",
);