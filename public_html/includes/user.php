<?php

/**
 * User Class
 */
class User
{
	private $conn;
	
	function __construct()
	{
		include("../database/db.php");
		$db=new Database();
		$this->conn=$db->connect();
	}

	private function checkUser($email)
	{
		$pre_stmt=$this->conn->prepare("SELECT id FROM user WHERE email= ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->conn->error);
		$result=$pre_stmt->get_result();
		if ($result->num_rows>0) {
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function createUserAccount($username,$email,$password,$usertype)
	{
		//to save our application from external sql attack we use prepared statement
		if ($this->checkUser($email)) {
			return "Email_Already_Exist";
		}
		else
		{
			date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d H:i:s");
			$notes="";
			$hash_pass=password_hash($password, PASSWORD_BCRYPT,["cost"=>8]);
			$pre_stmt=$this->conn->prepare("INSERT INTO `user`(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES (?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("sssssss",$username,$email,$hash_pass,$usertype,$date,$date,$notes);
			$result=$pre_stmt->execute() or die($this->conn->error);
			if ($result) {
				return "Done";
			}
			else
			{
				return "Some_Error";
			}
		}
		
	}

	public function userLogin($email,$password)
	{
		if($this->checkUser($email))
		{
			date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d h:i:s");
			$pre_stmt=$this->conn->prepare("SELECT id,username,password,last_login,usertype FROM user WHERE email=?");
			$pre_stmt->bind_param("s",$email);
			$pre_stmt->execute() or die($this->conn->error);
			$result=$pre_stmt->get_result();
			if($result->num_rows==1)
			{
				$row=$result->fetch_assoc();
				if(password_verify($password,$row["password"]))
				{
					$_SESSION['userid']=$row["id"];
					$_SESSION['username']=$row["username"];
					$_SESSION['usertype']=$row["usertype"];
					$_SESSION['last_login']=$row["last_login"];
					$pre_stmt=$this->conn->prepare("UPDATE user SET last_login = ? WHERE email= ?");
					$pre_stmt->bind_param("ss",$date,$email);
					$result=$pre_stmt->execute() or die($this->conn->error);
					if ($result) {
						return 1;
					}
				}
				else
				{
					return "Password Doesn't match";
				}
			}
			else
			{
				return "Please Register";
			}
		}
		else
			{
				return "Please Register";
			}
	}
}

// $user = new User();
// echo $user->userLogin("ganapati@gmail.com","123456");
// echo $user->createUserAccount("Vedant599","vedantmehta.tech@gmail.com","Vedant2001@99","Admin");
// echo $_SESSION['username'];
?>