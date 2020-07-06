<?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=product", "root", "");
	}

	function fetch_all()
	{
		$query = "SELECT * FROM product_master ORDER BY product_id";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["option_number"]))
		{
			$form_data = array(
				':option_number'		=>	$_POST["option_number"],
				':option_type'		=>	$_POST["option_type"],
				':name'				=>  $_POST["option_name"],
				':price'				=>	$_POST["cost_price"],
				':hours'			=>	$_POST["hours"],
				':weight'			=>  $_POST["weight"],
				':content'			=>	$_POST["content"],
				':techtalk'			=>	$_POST["techtalk"]
			);
			$query = "
			INSERT INTO product_master 
			(option_no, option_type,name,cost_price,hours,weight,shopping_site,tech_talk) VALUES 
			(:option_number, :option_type,:name,:price,:hours,:weight,:content,:techtalk)
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM product_master WHERE product_id='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['option_no'] = $row['option_no'];
				$data['option_type'] = $row['option_type'];
				$data['name'] = $row['name'];
				$data['cost_price'] = $row['cost_price'];
				$data['hours'] = $row['hours'];
				$data['weight'] = $row['weight'];
				$data['shopping_site'] = $row['shopping_site'];
				$data['tech_talk'] = $row['tech_talk'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["option_number"]))
		{
			$form_data = array(
				':option_number'		=>	$_POST["option_number"],
				':option_type'		=>	$_POST["option_type"],
				':name'				=>  $_POST["option_name"],
				':price'				=>	$_POST["cost_price"],
				':hours'			=>	$_POST["hours"],
				':weight'			=>  $_POST["weight"],
				':content'			=>	$_POST["content"],
				':techtalk'			=>	$_POST["techtalk"],
				':id'				=> 	$_POST["id"]
			);
			$query = "
			UPDATE product_master 
			SET option_no = :option_number, option_type = :option_type ,name=:name,cost_price=:price,hours=:hours,weight=:weight,shopping_site=:content,tech_talk=:techtalk
			WHERE product_id = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM product_master WHERE product_id = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>