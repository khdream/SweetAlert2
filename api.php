<?php
	//connection
	$conn = new mysqli('localhost', 'root', '', 'sweetalert2');
 
	$action = 'fetch';
 
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}
 
	if($action == 'fetch'){
		$output = '';
		$sql = "SELECT * FROM members";
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			$output .= "
				<tr>
					<td>".$row['id']."</td>
					<td>".$row['firstname']."</td>
					<td>".$row['lastname']."</td>
					<td>".$row['address']."</td>
					<td><button class='btn btn-sm btn-danger delete_product' data-id='".$row['id']."'>Delete</button></td>
				</tr>
			";
		}
 
		echo json_encode($output);
	}
 
	if($action == 'delete'){
		$id = $_POST['id'];
		$output = array();
		$sql = "DELETE FROM members WHERE id = '$id'";
		if($conn->query($sql)){
			$output['status'] = 'success';
			$output['message'] = 'Member deleted successfully';
		}
		else{
			$output['status'] = 'error';
			$output['message'] = 'Something went wrong in deleting the member';
		}
 
		echo json_encode($output);
 
	}
 