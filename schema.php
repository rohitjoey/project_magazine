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
							status enum('Active','Passive') DEFAULT 'Active',
							added_by int,
							created_date datetime DEFAULT current_timestamp,
							updated_date datetime ON UPDATE current_timestamp
						)",
			'blog-post'=>"
						CREATE TABLE IF NOT EXISTS blogpost
						(
							id int not NULL AUTO_INCREMENT PRIMARY KEY,
							title varchar(200),
							content text,
							featured enum('Featured','Not featured') DEFAULT 'Not featured',
							categoryid int,
							views int,
							image varchar(50),

							status enum('Active','Passive') DEFAULT 'Passive',
							added_by int,
							created_date datetime DEFAULT current_timestamp,
							updated_date datetime ON UPDATE current_timestamp
						)",
			'ads'=>"
						CREATE TABLE IF NOT EXISTS ads
						(
							id int not NULL AUTO_INCREMENT PRIMARY KEY,
							URL text,
							adType enum('widead','simplead') DEFAULT 'simplead',
							image varchar(50),
							added_by int,
							status enum('Active','Passive') DEFAULT 'Active',
							created_date datetime DEFAULT current_timestamp,
							updated_date datetime ON UPDATE current_timestamp
							
						)",
			'Share' => "
			CREATE TABLE IF NOT EXISTS share
				(
					id int not null AUTO_INCREMENT PRIMARY KEY,
					icon_name varchar(30),
					url varchar(50),
					class varchar(30),
					status enum('Active','Passive') default 'Active',
					added_by int,
					created_date datetime default current_timestamp,
					updated_date datetime on update current_timestamp
				)
		",
			'comment' => "
			CREATE TABLE IF NOT EXISTS comments
				(
					id int not null AUTO_INCREMENT PRIMARY KEY,
					name varchar(30),
					email varchar(50),
					website varchar(30),
					message text,	
					commentType enum('comment','reply') default 'comment',
					commentId int,
					blogId int,
					commentStatus enum('accept','waiting','reject') DEFAULT 'waiting',
					status enum('Active','Passive') default 'Active',
					added_by int,
					created_date datetime default current_timestamp,
					updated_date datetime on update current_timestamp
				)
		",
			'archive' => "
			CREATE TABLE IF NOT EXISTS archives
				(
					id int not null AUTO_INCREMENT PRIMARY KEY,
					date varchar(30),
					status enum('Active','Passive') default 'Active',
					added_by int,
					created_date datetime default current_timestamp,
					updated_date datetime on update current_timestamp
				)
		",
			'newsletter' => "
			CREATE TABLE IF NOT EXISTS newsletter
				(
					id int not null AUTO_INCREMENT PRIMARY KEY,
					email varchar(50),
					status enum('Active','Passive') default 'Active',
					created_date datetime default current_timestamp,
					updated_date datetime on update current_timestamp
				)
		",
			'contact' => "
				CREATE TABLE IF NOT EXISTS contactus
					(
						id int not null AUTO_INCREMENT PRIMARY KEY,
						email varchar(50),
						subject varchar(50),
						message text,
						status enum('Active','Passive') default 'Active',
						created_date datetime default current_timestamp,
						updated_date datetime on update current_timestamp
					)
			",
									
						

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