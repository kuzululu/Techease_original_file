<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

class DatabaseConnection{

private $server;
private $user; 
private $pass; 
private $dbName;
private $conn;

public function __construct($server, $user, $pass, $dbName){

$this->server = $server;
$this->user = $user; 
$this->pass = $pass; 
$this->dbName = $dbName;
}

public function connectDb(){
	$this->conn = new mysqli($this->server, $this->user, $this->pass, $this->dbName);

if ($this->conn->connect_error) {
die("Connection failed: " . $this->conn->connect_error);
}
return $this->conn;
}

public function closeConnection(){
if ($this->conn) {
$this->conn->close();
 }
}

}

class UserRegistration{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function register($lname, $fname, $username, $password, $account_type){
		$lname	= $this->conn->escape_string(trim($_POST["lname"]));
		$fname	= $this->conn->escape_string(trim($_POST["fname"]));
		$username	= $this->conn->escape_string(trim($_POST["username"]));
		$password	= $this->conn->escape_string(trim($_POST["password"]));
		$account_type	= $this->conn->escape_string(trim($_POST["account_type"]));


		$hash = password_hash($password, PASSWORD_BCRYPT);
		$sql = "INSERT INTO tbl_users(last_name, first_name, username, password, account_type) VALUES(?,?,?,?,?)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sssss", $lname, $fname, $username, $hash, $account_type);
		$stmt->execute();
		$stmt->close();
		return "Successfull User Registration!!";

	}
}

class UserLogin{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function login($conn, $postusername, $postpassword){
		$userLog = $this->conn->escape_string(trim($postusername));
		$userPass = $this->conn->escape_string(trim($postpassword));

		$sql = "SELECT * FROM tbl_users WHERE username = '$userLog'";
		$get_user = $this->conn->query($sql);
		$total_user = $get_user->num_rows;

		if ($total_user > 0) {
			while ($row = $get_user->fetch_assoc()) {
				$user_id = $row["user_id"];
				$db_lname = $row["last_name"];
				$db_fname = $row["first_name"];
				$db_user = $row["username"];
				$db_pass = $row["password"];
				$db_account_type = $row["account_type"];

				if (password_verify($userPass, $db_pass) && strcmp($userLog, $db_user) == 0) {
					$_SESSION["user_id"] = $user_id;
					$_SESSION["last_name"] = $db_lname;
				 $_SESSION["first_name"] = $db_fname;
			  $_SESSION["username"] = $db_user;
				 $_SESSION["password"] = $db_pass;
				 $_SESSION["account_type"] = $db_account_type;

				 if ($db_account_type == "admin") {
				 	header("location: admin");
				 }else{
				 	header("location: user");	
				 }

				}else{
					return "Wrong Password or kindly Considerate  the sensitive case of the username!";
				}

			}
		}else{
			return "No Username!!";
		}
	}

}


class DepartmentCategory{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function getDepartment(){
		$departments = [];

		$sql = "SELECT * FROM tbl_department ORDER BY department ASC" ;
		$get = $this->conn->query($sql);

		while ($row = $get->fetch_assoc()) {
			$departments[] = $row["department"];
		}

		return $departments;
	}

}

class AddRequest{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function addRequest($add_req_name, $add_department, $add_prod_model, $add_date_time, $add_prob_desc, $add_tech, $add_status){
		$add_req_name = $this->conn->escape_string(trim($_POST["add_req_name"]));
		$add_department = $this->conn->escape_string(trim($_POST["add_department"])); 
		$add_prod_model = $this->conn->escape_string(trim($_POST["add_prod_model"])); 
		$add_date_time = $this->conn->escape_string(trim($_POST["add_date_time"])); 
		$add_prob_desc = $this->conn->escape_string(trim($_POST["add_prob_desc"])); 
		$add_tech = $this->conn->escape_string(trim($_POST["add_tech"]));
		$add_status = $this->conn->escape_string(trim($_POST["add_status"]));

		$sql = "INSERT INTO tbl_logs(requestor_name, department, product_model, date_time, problem_desc, technician, status) VALUES(?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sssssss", $add_req_name, $add_department, $add_prod_model, $add_date_time, $add_prob_desc, $add_tech, $add_status);
		$stmt->execute();
		$stmt->close();
		return "Your Request has been Successfully Submitted!!";
	}
}


// user page
class DepartmentManager{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function getDepartment(){
		$sql = "SELECT * FROM tbl_department ORDER BY department ASC";
		$records = $this->conn->query($sql);
		return $records;
	}

}

class AddDepartModal{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function add_department($add_dept){
		$add_dept = $this->conn->escape_string(trim($_POST["add_dept"]));

		$sql = "INSERT INTO tbl_department(department) VALUES(?)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("s", $add_dept);
		$stmt->execute();
		$stmt->close();

		return "Successfully Department Add!!";
	}

}

class DataDeptFetcher{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function fetchData($id){
		$sql = "SELECT * FROM tbl_department WHERE dept_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$stmt->close();
		return $row;
	}
}

class UpdateModalDept{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function update($id, $department){
		$sql = "UPDATE tbl_department SET department=?  WHERE dept_id=?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("si", $department, $id);
		$stmt->execute();
		$stmt->close();
		return "Successfully Update the Department!!";
	}

}

class DeleteModalDept{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function delete($id){

		$sql = "DELETE FROM tbl_department WHERE dept_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$result = $stmt->execute();

		return "Department is not now on the Records!!";
	}
}


// department filter ajax side
class FilterDept{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($department){

		$sql = "SELECT * FROM tbl_department WHERE department LIKE '%$department%'";
		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="

			<table class='table table-hover'>
					<thead>
						<tr class='text-center'>
							<th>No.</th>
							<th>Department</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
		";

		if ($total > 0) {
			$ctr = 1;
			while ($row = $get->fetch_assoc()) {
				
				$data .="

		<tr class='text-center'>
		<td>".$ctr."</td>
		<td>".$row['department']."</td>
		<td>
			<a id='".$row['dept_id']."' href='#' type='button' class='btn btn-outline-primary btn-sm edit-deptdata' data-bs-toggle='modal' data-bs-target='#modalUpdateDept'>Update</a> <a id='".$row['dept_id']."' href='#' type='button' class='btn btn-outline-danger btn-sm del-deptdata' data-bs-toggle='modal' data-bs-target='#modalDelDept'>Delete</a>
		</td>
	</tr>

				";

				$ctr++;
			}
			$data .= "</tbody>";
		}else{
			$data .="
<tbody>
 <tr>
   <td colspan='3' class='text-center fw-bolder'><h4 class='text-danger fw-bolder'>No Record</h4></td>
 </tr>
</tbody>
";
		}

$data .="</table>";
echo $data;

	}
}

if (isset($_POST["filterDepartment"])) {
	$filter = $_POST["filterDepartment"];
	include("../inc/config.php");

	$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
	$conn = $dbConn->connectDb();

	$filterdept = new FilterDept($conn);
	$filterdept->filter($filter);

	$dbConn->closeConnection();
}

// 


// pending page 
class PendingRecordsManager{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function records(){

		$sql = "SELECT * FROM tbl_logs WHERE technician = '0'";
		$get = $this->conn->query($sql);
		return $get;
	}

}


class FilterPendingLogs{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($name){
	 $sql = "SELECT * FROM tbl_logs WHERE (department LIKE '%$name%' AND technician='0') || (requestor_name LIKE '%$name%' AND technician ='0')";
		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="

			<table class='table table-hover'>
					<thead>
						<tr class='text-center'>
							<th>No.</th>
							<th>Requestor Name</th>
							<th>Department</th>
							<th>Product / Model</th>
							<th>Date / Time Request</th>
							<th>Problem Description</th>
							<th>Status</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
		";

		if ($total > 0) {
			$ctr = 1;
			while ($row = $get->fetch_assoc()) {
				$origdateTime = $row["date_time"];
			$dateTime = new DateTime($origdateTime);
			$formatdate = $dateTime->format("M d, Y : h:i:A");

			$data .="

			<tr class='text-center'>
			<td>".$ctr."</td>
			<td>".$row['requestor_name']."</td>
			<td>".$row['department']."</td>
			<td>".$row['product_model']."</td>
			<td>".$formatdate."</td>
			<td>".$row['problem_desc']."</td>
			<td>".$row['status']."</td>
			<td>
				<a href='#' id='".$row['log_id']."' class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modalLogsPending'>Update</a>
			</td>
		</tr>

			";

			$ctr++;
			}
			$data .="</table>";
		}else{
			$data .="
			<tbody>
 <tr>
   <td colspan='8' class='text-center fw-bolder'><h4 class='text-danger fw-bolder'>No Record</h4></td>
 </tr>
</tbody>
			";
		}
		$data .="</table>";
		echo $data;
	}
}


if (isset($_POST["filterLogsPending"])) {
	$filter = $_POST["filterLogsPending"];
	include("../inc/config.php");

	$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
	$conn = $dbConn->connectDb();

	$filterdept = new FilterPendingLogs($conn);
	$filterdept->filter($filter);

	$dbConn->closeConnection();
}

class DataLogFetcher{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function fetchData($id){
		$sql = "SELECT * FROM tbl_logs WHERE log_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$stmt->close();
		return $row;
	}
}

class UpdatePendLogWithFileUpload{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function uploadFileUpdate($file){
		// file upload logic here
		$originalName = $file["name"];
		$extension = pathinfo($originalName, PATHINFO_EXTENSION);
		$newFileName = uniqid() . "_" . $originalName;
		$destination = "../uploads/" . $newFileName;

		while (file_exists($destination)) {
			$newFileName = uniqid() . "_" . $originalName;
			$destination = "../uploads/" . $newFileName;
		}

		move_uploaded_file($file["tmp_name"], $destination);

		return $newFileName; //return the generated file name
	}

	public function updatewithFile($id, $tech, $stats, $date_finish, $newFileName){

		$sql = "UPDATE tbl_logs SET technician=?, status=?, date_finish=?, image=? WHERE log_id=?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("ssssi", $tech, $stats, $date_finish, $newFileName, $id);
		$stmt->execute();
		$stmt->close();

		return "Successfully Update the Request with Upload Image";

	}

}
//

// request records
class LogsRecordsManager{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function records(){

		$sql = "SELECT * FROM tbl_logs WHERE technician = '".$_SESSION["first_name"] . " " . $_SESSION["last_name"] ."'";
		$get = $this->conn->query($sql);
		return $get;
	}

}

class FilterRecordsLogs{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($name){
	 $sql = "SELECT * FROM tbl_logs WHERE (department LIKE '%$name%' AND technician='". $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ."') || (requestor_name LIKE '%$name%' AND technician ='". $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ."')";
		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="

			<table class='table table-hover'>
					<thead>
						<tr class='text-center'>
							<th>No.</th>
							<th>Requestor Name</th>
							<th>Department</th>
							<th>Product / Model</th>
							<th>Date / Time Request</th>
							<th>Problem Description</th>
							<th>Status</th>
							<th>Date Finished</th>
							<th>Technician</th>
							<th>Image</th>
						</tr>
					</thead>
					<tbody>
		";

		if ($total > 0) {
			$ctr = 1;
			while ($row = $get->fetch_assoc()) {
			$origdateTime = $row["date_time"];
			$dateTime = new DateTime($origdateTime);
			$formatdate = $dateTime->format("M d, Y : h:i:A");

			$origDate = $row["date_finish"];
			$dateTimeFin = new DateTime($origDate);
			$formatDateFin = $dateTimeFin->format("M d, Y");

			$data .="

			<tr class='text-center align-middle'>
		<td>".$ctr."</td>
			<td>".$row["requestor_name"]."</td>
			<td>".$row["department"]."</td>
			<td>".$row["product_model"]."</td>
			<td>".$formatdate."</td>
			<td>".$row["problem_desc"]."</td>
			<td>".$row["status"]."</td>
			<td>".$formatDateFin."</td>
			<td>".$row["technician"]."</td>
			<td>
				<img class='img-fluid w-75' src='../uploads/".$row['image']."'>
			</td>
		</tr>
			";

			$ctr++;
			}
			$data .="</table>";
		}else{
			$data .="
			<tbody>
 <tr>
   <td colspan='10' class='text-center fw-bolder'><h4 class='text-danger fw-bolder'>No Record</h4></td>
 </tr>
</tbody>
			";
		}
		$data .="</table>";
		echo $data;
	}
}


if (isset($_POST["filterRecords"])) {
	$filter = $_POST["filterRecords"];
	include("../inc/config.php");

	$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
	$conn = $dbConn->connectDb();

	$filterdept = new FilterRecordsLogs($conn);
	$filterdept->filter($filter);

	$dbConn->closeConnection();
}

 // 
?>