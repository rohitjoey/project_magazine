<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';

	$schema = new Schema();

	$table=array(
			'users'=>"
						CREATE TABLE IF NOT EXISTS users
						(
							id int not NULL AUTO_INCREMENT PRIMARY KEY,
							username varchar(50) UNIQUE KEY,
							email varchar(50),
							password varchar(200),
							session_token text,
							activation_token text,
							password_reset_token text,
							role enum('Admin','Staff') DEFAULT 'Staff',
							status enum('Active','Passive') DEFAULT 'Passive',
							added_by int,
							created_date datetime DEFAULT current_timestamp,
							updated_date datetime ON UPDATE current_timestamp
						)",
			
			'superuser'=>"
							INSERT INTO users SET 
								username='Admin',
								email='admin@this.com',
								password='".sha1('Adminadmin@this.com')."',
								role='Admin',
								status='Active'
						",
			'categories'=>"
						CREATE TABLE IF NOT EXISTS categories
						(
							id int not NULL AUTO_INCREMENT PRIMARY KEY,
							categoryname varchar(50),
							description text,
							status enum('Active','Passive') DEFAULT 'Passive',
							added_by int,
							created_date datetime DEFAULT current_timestamp,
							updated_date datetime ON UPDATE current_timestamp
						)",
		);


	foreach ($table as $key => $sql) {
		try{
			$success=$schema->create($sql);
			if($success){
				echo "<br>Query ".$key." executed succesfully<br>";
			}
			else{
				echo "<br>Problem while executing<br>".$key;
			}
		}catch(PDOException $e){
				error_log(Date('M D Y h:i:s a').':(QUERY_RUN_ERROR)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
		}
	}

?>