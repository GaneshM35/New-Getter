<?php
	if(isset($_POST['signup'])){
		$screenName = $_POST['screenName'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		if(empty($screenName) or empty($password) or empty($email)){
			$error = 'All fields are required';
		}else{
			$email = $getFromUser->checkInput($email);
			$screenName = $getFromUser->checkInput($screenName);
			$password = $getFromUser->checkInput($password);

			if(!filter_var($email)){
				$error = 'Invalid email format';
			}else if (strlen($screenName) > 20) {
				# code...
				$error = 'Name must be between 6 - 20 characters';
			}else if(strlen($password) < 5){
				$error = 'Password is too Short';
			}else{
				if($getFromUser->checkEmail($email) === true){
					$error = 'Email is already in use';
				}else{
					$getFromUser->create('users', array('email'=> $email,'screenName' => $screenName,'password' => $password, 'profileImage' => 'images/defaultprofileImage.png', 'profileCover' => 'images/defaultCoverImage.png'));
					header('Location: signup.php?step=1');
				}
			}
		}
	}
?>

<form method="post">
<div class="signup-div"> 
	<h3>Sign up </h3>
	<ul>
		<li>
		    <input type="text" name="screenName" placeholder="Full Name"/>
		</li>
		<li>
		    <input type="email" name="email" placeholder="Email"/>
		</li>
		<li>
			<input type="password" name="password" placeholder="Password"/>
		</li>
		<li>
			<input type="submit" name="signup" Value="Signup for Twitter">
		</li>
	
		<?php 
			if(isset($error)){
				echo '<li class="error-li">
		  				<div class="span-fp-error">'.$error.'</div>
		 			</li>' ;
			}
		?>
	</ul>
</div>
</form>