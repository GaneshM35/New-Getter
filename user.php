<?php
	class User{
		protected $pdo;

		function __construct($dbh){
			$this->pdo = $dbh;
		}

		public function checkInput($var){
			$var = htmlspecialchars($var);
			$var = trim($var);
			$var = stripcslashes($var);
			return $var;
		}

		public function login($email, $password){
			$smt = $this->pdo->prepare("SELECT `user_id` FROM `users` WHERE `email` = :email AND `password` = :password");
			$smt->bindParam(':email', $email, PDO::PARAM_STR);
			$smt->bindParam(':password', md5($password), PDO::PARAM_STR);
			$smt->execute();

			$user = $smt->fetch(PDO::FETCH_OBJ);
			$count = $smt->rowCount();

			if($count > 0){
				$_SESSION['user_id'] = $user->user_id;
				header('Location: home.php');
			}else{
				return false;
			}

		}

		public function userData($user_id){
			$smt = $this->pdo->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
			$smt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$smt->execute();
			return $smt->fetch(PDO::FETCH_OBJ);
		}

		public function logout(){
			$_SESSION = array();
			session_destroy();
			header('Location: index.php');
		}

		public function checkEmail($email){
			$smt = $this->pdo->prepare("SELECT `email` FROM `users` WHERE `email` = :email");
			$smt->bindParam(":email", $email, PDO::PARAM_STR);
			$smt->execute();
			
			$count = $smt->rowCount();
			if($count > 0){
				return true;
			}else{
				return false;
			}
		}

		public function register($email,$screenName,$password){
			$smt = $this->pdo->prepare("INSERT INTO `users` (`email`,`password`,`screenName`,`profileImage`,`profileCover`) VALUES (:email, :password, :screenName, 'images/defaultProfileImage.png', 'images/defaultProfileCover.png') ");
			$smt->bindParam(":email", $email, PDO::PARAM_STR);
			$smt->bindParam(":password", md5($password), PDO::PARAM_STR);
			$smt->bindParam(":screenName",$screenName, PDO::PARAM_STR);
			$smt->execute();

			$user_id = $this->pdo->lastInsertID();
			$_SESSION['user_id'] = $user_id;
		}

		public function create($table, $fields = array()){
			$columns = implode(',', array_keys($fields));
			$values = ':'.implode(', :',array_keys($fields));
			$sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
			var_dump($sql);

			if($smt = $this->pdo->prepare($sql)){
				foreach ($fields as $key => $data) {
					# code...
					$smt->bindValue(':'.$key, $data);
				}
				$smt->execute();
				return $this->pdo->lastInsertID();
			}

		}

	}
?>