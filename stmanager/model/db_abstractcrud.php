<?php
if(!class_exists("db_abstractcrud")) {
class db_abstractcrud
{	
	//class variable that represents the database connection.
	var $conn;
	//user-defined constructor
	function db_abstractcrud()
	{
		//pre: parameters must be correct in order to connect to database.
		//post: connects to database.
		include "../../settings/settings.php";
        $db_name = $cfg_database;
		$this->conn = mysqli_connect($cfg_server, $cfg_username, $cfg_password,$db_name) or die("Could not connect : " . mysqli_error());
		$this->conn->set_charset('utf8');
	}
	
    public function getcon(){
        return $this->conn;
    }

	public function run($query){
		$result = mysqli_query($this->conn,$query);

		$data = array();
		if($result){
			while ($row = $result->fetch_array()) {
				$data[]= $row;
			}
		}
		return $data;
	}

	public function process($query){
		$this->conn->query($query);
	}

	function getAllElementsWhere($tablename,$field='*',$orderby='_id',$where='')
	{
		//pre: $tablename,$field,$orderby must be valid
		/*post: returns all elements in an array of specified table
		and sets first position to an empty string.  This function will be used for filling
		select fields, which requires the first position for the selected value
		*/
		if ($where!='')
			$where_clause = "WHERE $where";
		
		$result = mysqli_query("SELECT $field FROM $tablename $where_clause ORDER BY $orderby",$this->conn);
		$numRows = mysqli_num_rows($result);
		$data = array();

		for($k=0; $k< $numRows; $k++)
		{
			$data[$k]= mysqli_fetch_array($result);
		}

		return $data;
	}
	
	function getAllElement($tablename,$field='*',$orderby='_id',$where='')
	{
 
		//pre: $tablename,$field,$orderby must be valid
		/*post: returns all elements in an array of specified table
		and sets first position to an empty string.  This function will be used for filling
		select fields, which requires the first position for the selected value
		*/
		$where_clause='';
		if ($where!='')
			$where_clause = "WHERE $where";
		$data = array();

		if($result = $this->conn->query("SELECT $field FROM $tablename $where_clause ORDER BY $orderby")) {
			while ($row = $result->fetch_array()) {
				$data[] = $row;
			}
		}
		return $data;
	}
    function getAllElementJoin($tablename,$field='*',$orderby='_id')
    {
        //pre: $tablename,$field,$orderby must be valid
        /*post: returns all elements in an array of specified table
        and sets first position to an empty string.  This function will be used for filling
        select fields, which requires the first position for the selected value
        */
       
        //echo "SELECT $field FROM $tablename $where_clause ORDER BY $orderby";
        //echo $where_clause;
        $result = mysqli_query("SELECT $field FROM $tablename ORDER BY $orderby",$this->conn);
        //echo 'a';
        $numRows = mysqli_num_rows($result);
        $data = array();
        //echo $numRows;
        for($k=0; $k< $numRows; $k++)
        {
            $data[$k]= mysqli_fetch_array($result);  
        }
        
        return $data;
    }
    
	function getAllElementrc($tablename,$field='*',$orderby='_id',$where='')
	{
		//pre: $tablename,$field,$orderby must be valid
		/*post: returns all elements in an array of specified table
		and sets first position to an empty string.  This function will be used for filling
		select fields, which requires the first position for the selected value
		*/
		$where_clause='';
		if ($where!='')
			$where_clause = "WHERE $where";
		//echo "SELECT $field FROM $tablename $where_clause ORDER BY $orderby";
		//echo $where_clause;
		$result = mysqli_query("SELECT $field FROM $tablename $where_clause ORDER BY $orderby desc",$this->conn);
		//echo 'a';
		$numRows = mysqli_num_rows($result);
		$data = array();
		//echo $numRows;
		for($k=0; $k< $numRows; $k++)
		{
			$data[$k]= mysqli_fetch_array($result);	
		}
		
		return $data;
	}
    function getAllElementrt($tablename,$field='*',$orderby='_id',$where='')
    {
        //pre: $tablename,$field,$orderby must be valid
        /*post: returns all elements in an array of specified table
        and sets first position to an empty string.  This function will be used for filling
        select fields, which requires the first position for the selected value
        */
        if ($where!='')
            $where_clause = "WHERE $where";
        
        //echo $where_clause;
        $result = mysqli_query("SELECT $field FROM $tablename $where_clause ORDER BY $orderby desc",$this->conn);
        //echo 'a';
        $numRows = mysqli_num_rows($result);
        $data = array();
        //echo $numRows;
        for($k=0; $k< $numRows; $k++)
        {
            $data[$k]= mysqli_fetch_array($result);    
        }
        
        return $data;
    }
	function getAllElementOrder($tablename,$field='*',$orderby='_id',$where='')
	{
		//pre: $tablename,$field,$orderby must be valid
		/*post: returns all elements in an array of specified table
		and sets first position to an empty string.  This function will be used for filling
		select fields, which requires the first position for the selected value
		*/
		$where_clause = "";
        if ($where!='')
			$where_clause = "WHERE $where";
		
		//echo $where_clause;
		$result = mysqli_query("SELECT $field FROM $tablename $where_clause ORDER BY $orderby DESC",$this->conn);
		//echo 'a';
		$numRows = mysqli_num_rows($result);
		$data = array();
		//echo $numRows;
		for($k=0; $k< $numRows; $k++)
		{
			$data[$k]= mysqli_fetch_array($result);	
		}
		
		return $data;
	}
	function getAllElements($tablename,$field='*',$orderby='_id',$wherefield='',$wherevalue='')
	{
		//pre: $tablename,$field,$orderby must be valid
		/*post: returns all elements in an array of specified table
		and sets first position to an empty string.  This function will be used for filling
		select fields, which requires the first position for the selected value
		*/
		$where_clause = "";
		if ($wherefield!='')
			$where_clause = "WHERE $wherefield='$wherevalue'";
		$result = mysqli_query("SELECT $field FROM $tablename $where_clause ORDER BY $orderby",$this->conn);
		$numRows = mysqli_num_rows($result);
		$data = array();
		
		for($k=0; $k< $numRows; $k++)
		{
			$data[$k]= mysqli_fetch_array($result);	
		}
		
		return $data;
	}
	
	function getAllElementsWhereByLimit($tablename,$field='*',$orderby='_id',$wherefield='',$wherevalue='',$limitstart='0',$limitcount='10')
	{
		//pre: $tablename,$field,$orderby must be valid
		/*post: returns all elements in an array of specified table
		and sets first position to an empty string.  This function will be used for filling
		select fields, which requires the first position for the selected value
		*/
		if ($wherefield!='')
			$where_clause = "WHERE $wherefield='$wherevalue'";

		$result = mysqli_query("SELECT $field FROM $tablename $where_clause ORDER BY $orderby DESC LIMIT $limitstart,$limitcount",$this->conn);
		$numRows = mysqli_num_rows($result);
		$data = array();
		
		for($k=0; $k< $numRows; $k++)
		{
			$data[$k]= mysqli_fetch_array($result);	
		}
		
		return $data;
	}
	
	function getAllElementsByLimit($tablename,$field='*',$orderby='_id',$limitstart='0',$limitcount='10')
	{
		//pre: $tablename,$field,$orderby must be valid
		/*post: returns all elements in an array of specified table
		and sets first position to an empty string.  This function will be used for filling
		select fields, which requires the first position for the selected value
		*/
		

		$result = mysqli_query("SELECT $field FROM $tablename ORDER BY $orderby DESC LIMIT $limitstart,$limitcount",$this->conn);
		$numRows = mysqli_num_rows($result);
		$data = array();
		
		for($k=0; $k< $numRows; $k++)
		{
			$data[$k]= mysqli_fetch_array($result);	
		}
		
		return $data;
	}

	function idToFields($tablename,$id,$orderby='_id')
	{
		//pre: $tablename,$field,$orderby must be valid
		/*post: returns all elements in an array of specified table
		and sets first position to an empty string.  This function will be used for filling
		select fields, which requires the first position for the selected value
		*/
		$result = $this->conn->query("SELECT * FROM $tablename WHERE _id=\"$id\" ORDER BY $orderby");
		$row = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result)>0) return $row;
		else return false;
	}
	
	function idToField($tablename,$field,$id)
	{
		//pre: $tablename, field, and id all must be valid
		//post: returns a specified field based on the ID from a specified table.
		
		$result = $this->conn->query("SELECT $field FROM $tablename WHERE _id=\"$id\"");
		$row = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result)>0) return $row[$field];
		else return -1;
	}
	
	function fieldToid($tablename,$field,$value,$col='_id')
	{	//$query="SELECT $col FROM $tablename WHERE $field=\"$value\"";echo $query;
		//pre: $tablename, field, and value all must be valid
		//post: returns a specified id based on the field from a specified table.
		 $result = mysqli_query("SELECT $col FROM $tablename WHERE $field=\"$value\"",$this->conn);//echo count($result);
		
		$row=mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result)>0) return $row[$col];
		else return -1;

	}
	
	function fieldsToid($tablename,$field_names,$field_data)
	{
		//pre: $tablename, field, and value all must be valid
		//post: returns a specified id based on the field from a specified table.

		$query = "SELECT * FROM $tablename WHERE $field_names[0]=\"$field_data[0]\"";
			
		for($k=1;$k< count($field_names);$k++)
		{
			$query.=' and '."$field_names[$k]=\"$field_data[$k]\"";
		
		}
		$result = mysqli_query($query,$this->conn);
		$row=mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result)>0) return $row['_id'];
		else return -1;
	}
	function isValidData($data_to_check)
	{
		//checks data for errors
	
		for($k=0;$k<count($data_to_check);$k++)
		{
			if(!strpos($data_to_check[$k],'\"') && !strpos($data_to_check[$k],'<"') && !strpos($data_to_check[$k],'>"')  )
			{
				return true;
			}
		}
		
		return false;
	
	}

	function insert($field_names, $field_data, $tablename)
	{
		//pre: $field_names and $field_data are pararell arrays and $tablename is a string.
		//post: creates a query then executes it.

		if(!($this->isValidData($field_data)))
		{
			echo "{$this->lang->invalidCharactor}";
			exit();
		}
		
		$query = "INSERT INTO $tablename ($field_names[0]";
			
		for($k=1;$k< count($field_names);$k++)
		{
			$query.=', '."$field_names[$k]";
		
		}
		
		$query.=") VALUES (\"$field_data[0]\"";
		
		for($k=1;$k< count($field_data);$k++)
		{
			$query.=', '."\"$field_data[$k]\"";
		
		}
			$query.=')';

		$this->conn->query($query);

		return mysqli_insert_id($this->conn);
	}

	function update($field_names,$field_data,$tablename,$id)
	{
		//pre: $field_names and $field_data are pararell arrays and tablename and id are strings.
		//post: creates a query then executes it limites based on id.
		//echo $id;
		if($id=='')
		{
			echo "corret input";
			exit();
		}
		if(!($this->isValidData($field_data)))
		{
			echo "corret input";
			exit();
		}
			$query="UPDATE $tablename SET $field_names[0]=\"$field_data[0]\"";
			
		for($k=1;$k< count($field_names);$k++)
		{
			$query.=', '."$field_names[$k]=\"$field_data[$k]\"";
		}
		$query.=" WHERE _id=\"$id\"";
		$this->conn->query($query);


	}	
	function updateWhere($field_names,$field_data,$tablename,$where)
	{
        $where_clause='';
		if ($where!='')
			$where_clause = "WHERE $where";
		//pre: $field_names and $field_data are pararell arrays and tablename and id are strings.
		//post: creates a query then executes it limites based on id.
		//echo $id;
	
		if(!($this->isValidData($field_data)))
		{
			echo "corret input";
			exit();
		}
			$query="UPDATE $tablename SET $field_names[0]=\"$field_data[0]\" ";

		for($k=1;$k< count($field_names);$k++)
		{
			$query.=', '."$field_names[$k]=\"$field_data[$k]\"";

		}
		$query.= " $where_clause";
		$this->conn->query($query);
	}
	function deleteRow($tablename,$id)
	{
		$query="DELETE FROM $tablename WHERE _id=\"$id\"";
		$this->conn->query($query);
	}
    function deletewhere($tablename,$where)
	{
        $where_clause = "WHERE $where";
		$query="DELETE FROM $tablename WHERE $where"; 
		$this->conn->query($query);
	}
	
	
	
	function getNumRows($table)
	{
		//gets the number of rows in a table
		
		$query="SELECT _id FROM $table";
		//echo $query;
		$result=mysqli_query($query,$this->conn);
		
		return mysqli_num_rows($result);
	
	}
	function getAllElementsByKey($tablename,$field='*',$orderby='_id',$wherefield='',$keyvalue='')
	{
		//pre: $tablename,$field,$orderby must be valid
		/*post: returns all elements in an array of specified table
		and sets first position to an empty string.  This function will be used for filling
		select fields, which requires the first position for the selected value
		*/
		if ($wherefield!='')
			$where_clause = "WHERE $wherefield='$keyvalue'";
		

		$result = mysqli_query("SELECT $field FROM $tablename $where_clause ORDER BY $orderby",$this->conn);
		$numRows = mysqli_num_rows($result);
		
		$data = array();
		
		for($k=0; $k< $numRows; $k++)
		{
			$data[$k]= mysqli_fetch_array($result);	
		}
		
		return $data;

	}
	function closeDBlink()
	{
		mysqli_close($this->conn);
	}
	
}
}
?>