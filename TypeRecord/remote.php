<?php
	################################################################
	// Before using "Control-Guest" should you configure 
	// the connection data from the database .
	################################################################
	$hostremote = $this->host; //Insert your domain	
	$userremote = $this->user_host; //Insert your user
	$passremote = $this->user_pass; //Insert your pass_user
	$dbremote 	 = $this->database; //Insert your name database
	################################################################
	
	$connect = mysqli_connect($this->host, $this->user_host, $this->user_pass, $this->database);
	 if (mysqli_connect_errno())
    {
    echo "Error al conectar con servidor MySQL: " . mysqli_connect_error();
    }
	

	mysqli_set_charset($connect,'utf8');

	if ($file==null) {
				
		if(isset($this->timezone)&&!empty($this->timezone)) {
			date_default_timezone_set($this->timezone);
		}else{
			date_default_timezone_set('Europe/Madrid');
		}
				
		$file = date('m-y');
		$name ="log.".$file."";
	}

	//MYSQL
	$sql = "CREATE TABLE IF NOT EXISTS `".$name."` (
		`LogId` int(11) NOT NULL AUTO_INCREMENT,
  		`LogDate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  		`LogHour` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  		`LogBrowser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  		`LogOS` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  		`LogCity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  		`LogIp` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  		`LogCCountry` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  		`LogCContinet` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  		`LogAlt` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  		`LogLong` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  		`LogAsn` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  		`LogTimeZone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  		`LogState` int(11) NOT NULL,
  		PRIMARY KEY (LogId)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
	

	$info = mysqli_query($connect,$sql);

	
	if ($info==true) {
		
		$info = "<script>console.log('Insertando datos: '".$name."'.')</script>";

		$insert = "INSERT INTO `".$name."`";
		$insert.= "(`LogDate`, `LogHour`, `LogBrowser`,";
		$insert.= " `LogOS`, `LogCity`, `LogIp`, `LogCCountry`, ";
		$insert.= "`LogCContinet`, `LogAlt`, `LogLong`, `LogAsn`,";
		$insert.= "`LogTimeZone`, `LogState`)"; 
		$insert.= " VALUES ";
		$insert.= "('".$this->date."','".$this->hour."','".$this->browser()."',";
		$insert.= "	'".$this->system()."','".$this->city."','".$this->ip."','".$this->country_code."',";
		$insert.= "	'".$this->continent_code."','".$this->latitude."','".$this->longitude."','".$this->asn."',";
		$insert.= "	'".$this->timezone."',2)";

		mysqli_query($connect,$insert);

	}else{

		$info = "<script>console.log('La tabla: '".$name."', no fue creada.')</script>";
	}

	

?>