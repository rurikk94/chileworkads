<?php
	$site_config["version"]="";
    $site_config['PDO']['server']="127.0.0.1";
    $site_config['PDO']['db']="chileworkads";
    $site_config['PDO']['user']="root";
    $site_config['PDO']['pass']="";
    $site_config['SITE']['base']=dirname(__FILE__).'/';
    $site_config['SITE']['URL']="http://".$_SERVER["HTTP_HOST"]."/";
    if($_SERVER["HTTP_HOST"]!="devchileworkads.ddns.net")
        $site_config['SITE']['URL']="http://".$_SERVER["HTTP_HOST"]."/chileworkads/";


    $email_config['host']="smtp.gmail.com";
    $email_config['port']="587";
    $email_config['username']="chileworkads@gmail.com";
    $email_config['password']="eUjcq8JaXTMZ5xUX";
    //$site_config['SITE']['URL']="http://chileworkads.ddns.net/chileworkads/";

/*
    $site_config['PDO']['server']="sql10.freemysqlhosting.net";
    $site_config['PDO']['db']="sql10348744";
    $site_config['PDO']['user']="sql10348744";
    $site_config['PDO']['pass']="vhRsymX4f5";
    $site_config['SITE']['base']=dirname(__FILE__).'/'; */
    //$site_config['SITE']['URL']="https://chileworkads.000webhostapp.com/";