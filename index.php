<?php 


//DB Connection
 $conn = new mysqli('localhost', 'root', '') or die(mysqli_error());
 //Select DB From database
 $db = mysqli_select_db($conn, 'student_detail') or die("databse error");
 
 //Selecting database
if(mysqli_connect_errno($conn))	echo "Failed to connect MySQL: " .mysqli_connect_error();

	/* Student Registration */
	if($_POST['type']=="reg_sd")
	{
		if(isset($_POST['data'])&&count($_POST['data'])==4)
		{	
			try {
				if(filter_var((int)$_POST['data']['contact_no'], FILTER_VALIDATE_INT) === FALSE) {
				  throw new Exception("Please check contact no field");
				}
			  }
			  
			catch(Exception $e) {
			echo 'Message: ' .$e->getMessage(); exit;
			}
			$firstName=filter_var($_POST['data']['first_name'], FILTER_SANITIZE_STRING);
			$lastName=filter_var($_POST['data']['last_name'], FILTER_SANITIZE_STRING);
			$dob=$_POST['data']['dob'];
			$contactNo=$_POST['data']['contact_no'];
			
			$insertQry = "INSERT INTO student (first_name, last_name, dob, contact_no) VALUES('$firstName','$lastName', '$dob', '$contactNo')";
			
			$result = mysqli_query($conn, $insertQry);
			print_r($result);
		}
		else
			echo "ERROR";		
	}

	/* Course Registration */
	if($_POST['type']=="reg_cd")
	{
		if(isset($_POST['data'])&&count($_POST['data'])==3)
		{
			$courseName=filter_var($_POST['data']['course_name'], FILTER_SANITIZE_STRING);
			$courseDetails=filter_var($_POST['data']['course_details'], FILTER_SANITIZE_STRING);
			
			$insertQry = "INSERT INTO course (course_name, course_details) VALUES('$courseName','$courseDetails')";
			
			$result = mysqli_query($conn, $insertQry);
			print_r($result);
		}
		else
			echo "ERROR";			
	}

	/* View Student Details / View Course Details / Get View Report Data */
	if($_POST['type']=="view_sd" || $_POST['type']=="view_cd" || $_POST['type']=="get_sc_reg_data")
	{
		if($_POST['type']=="view_sd")
			$table="student";
		elseif($_POST['type']=="view_cd")
			$table="course";
		elseif($_POST['type']=="get_sc_reg_data")
			$table="student_course_reg";
		$start_index=$_POST['start_index'];
		$limit_index=$_POST['limit_index'];
		if($table=="student_course_reg")
			$getItemsQry = "SELECT * FROM `student_course_reg` as scr join student as s on s.id=scr.student_id join course as c on c.id=scr.course_id where s.id IS NOT NULL and c.id IS NOT NULL";
		else
			$getItemsQry = "SELECT * FROM `$table`";
				
		$resultQry = mysqli_query($conn, $getItemsQry);
		$totalItems=$resultQry->num_rows;
		
		if($table=="student_course_reg")
			$sql = "SELECT * FROM `student_course_reg` as scr join student as s on s.id=scr.student_id join course as c on c.id=scr.course_id where s.id IS NOT NULL and c.id IS NOT NULL LIMIT $limit_index OFFSET $start_index";
		else
	    	$sql = "SELECT * FROM `$table` LIMIT $limit_index OFFSET $start_index";
	    $result = mysqli_query($conn, $sql);
	    $finalArray=array();
	    if (isset($result->num_rows)&&$result->num_rows > 0)
	    {
	    	$data=array();
	    	while($row = $result->fetch_assoc()) {
				$push=TRUE;
				if($_POST['type']=="get_sc_reg_data")
				{
					$courseId=$row['course_id'];
					$studId=$row['student_id'];
					$sqlSc = "SELECT `course_name` FROM `course` where id='$courseId'";
					$resSc = mysqli_query($conn, $sqlSc);
					$courseName=$resSc->fetch_assoc();
					$sqlScs = "SELECT CONCAT(`first_name`,' ',`last_name`) as stud_name FROM `student` where id='$studId'";
					$resScs = mysqli_query($conn, $sqlScs);
					$studName=$resScs->fetch_assoc();	
					if(!empty($courseName['course_name'])&&!empty($studName['stud_name']))
					{
						$row['course_name']=$courseName['course_name'];
						$row['stud_name']=$studName['stud_name'];
					}
					else
						$push=FALSE;
				}
				if($push)
	            	array_push($data,$row);
	        }
	        $finalArray['table_data']=$data;
	        $finalArray['total_count']=$totalItems;
	        print_r(json_encode($finalArray));
	    }
	    else
	    {
	        $data='no_records';
	        print_r($data);
	    }
	}

	/* Edit Student Details */
	if($_POST['type']=="edit_sd")
	{
		if(isset($_POST['data'])&&count($_POST['data'])==6)
		{
			try {
				if(filter_var((int)$_POST['data']['id'], FILTER_VALIDATE_INT) === FALSE || filter_var((int)$_POST['data']['contact_no'], FILTER_VALIDATE_INT) === FALSE) {
				  throw new Exception("Please check the data and then try update");
				}
			  }
			  
			catch(Exception $e) {
			echo 'Message: ' .$e->getMessage(); exit;
			}
	
			$id=$_POST['data']['id'];
			$firstName=filter_var($_POST['data']['first_name'], FILTER_SANITIZE_STRING);
			$lastName=filter_var($_POST['data']['last_name'], FILTER_SANITIZE_STRING);
			$dob=$_POST['data']['dob'];
			$contactNo=$_POST['data']['contact_no'];
			
			$updateQry = "UPDATE student set first_name='$firstName', last_name='$lastName', dob='$dob', contact_no='$contactNo' where id='$id'";
			
			$result = mysqli_query($conn, $updateQry);
			print_r($result);

		}
		else
			echo "ERROR";
		
	}

	/* Edit Course Details */
	if($_POST['type']=="edit_cd")
	{
		if(isset($_POST['data'])&&count($_POST['data'])==4)
		{
			try {
				if(filter_var((int)$_POST['data']['id'], FILTER_VALIDATE_INT) === FALSE) {
				  throw new Exception("Please check the field and try to update.");
				}
			  }
			  
			catch(Exception $e) {
			echo 'Message: ' .$e->getMessage(); exit;
			}
	
			$id=$_POST['data']['id'];
			$courseName=filter_var($_POST['data']['course_name'], FILTER_SANITIZE_STRING);
			$courseDetail=filter_var($_POST['data']['course_details'], FILTER_SANITIZE_STRING);
			
			$updateQry = "UPDATE course set course_name='$courseName', course_details='$courseDetail' where id='$id'";
			
			$result = mysqli_query($conn, $updateQry);
			print_r($result);
		}
		else
			echo "ERROR";
		
	}

	/* Delte Student/Course Details */
	if($_POST['type']=="delete_sd" || $_POST['type']=="delete_cd")
	{
		$id=$_POST['data'];

		if($_POST['type']=="delete_sd")
			$table="student";
		else
			$table="course";
		$deleteQry = "DELETE from `$table` where id='$id'";
		
		$result = mysqli_query($conn, $deleteQry);
		print_r($result);
	}

	/* Get Student, Course Data */
	if($_POST['type']=="get_sc_data")
	{
		$finalArray['stud_data']=array();
		$finalArray['course_data']=array();
		$getStudItemsQry = "SELECT `id` as stud_id, CONCAT(`first_name`,' ',`last_name`) as stud_name FROM `student`";
		$resultStudQry = mysqli_query($conn, $getStudItemsQry);
		if($resultStudQry->num_rows>0)
		{
	    	while($row = $resultStudQry->fetch_assoc()) {
	             array_push($finalArray['stud_data'],$row);
	        }
		}
		$getCourseItemsQry = "SELECT `id` as course_id, course_name FROM `course`";
		$resultCourseQry = mysqli_query($conn, $getCourseItemsQry);
		if($resultCourseQry->num_rows>0)
		{
	    	while($row = $resultCourseQry->fetch_assoc()) {
	             array_push($finalArray['course_data'],$row);
	        }
		}
		print_r(json_encode($finalArray));exit;
	}

	/* Save Student Course Registration */
	if($_POST['type']=="save_sc_reg" && isset($_POST['data']))
	{
		$resultQry="";
		foreach($_POST['data'] as $val)
		{
			if(count($val)==2)
			{
				try {
					if(filter_var((int)$val['stud_id'], FILTER_VALIDATE_INT) === FALSE || filter_var((int)$val['course_id'], FILTER_VALIDATE_INT) === FALSE) {
					  throw new Exception("Please check the field and try to update.");
					}
				  }
				  
				catch(Exception $e) {
				echo 'Message: ' .$e->getMessage(); exit;
				}
	
				$studId=$val['stud_id'];
				$courseId=$val['course_id'];
				$insertQry = "INSERT INTO student_course_reg (student_id, course_id) VALUES('$studId','$courseId')";
				$resultQry = mysqli_query($conn, $insertQry);
			}
			else
				echo "ERROR";
			
		}
		
		print_r($resultQry);
	}

    $conn->close();
?> 