<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/22/0022
 * Time: 16:54
 */

class mysqlClass{

	private $userName;			//连接用户名
	private $password;			//连接密码
	private $host;				//连接主机
	private $dbName;			//连接数据库
	private $charSet;			//字符集
	public 	$mysql;				//连接成功后的资源变量
	
	
	//构造方法
	public function __construct($host,$userName,$password,$dbName,$charSet='utf8')
	{
		$this->host=$host;
		$this->userName=$userName;
		$this->password=$password;
		$this->dbName=$dbName;

		//连接
		$this->mysql=mysql_connect($host,$userName,$password) or die ('数据库连接失败<br/>ERROR '.mysql_errno().':'.mysql_error());
		echo "连接成功";
		$this->setChar($charSet);		//设置字符集
		mysql_select_db($dbName);		//打开数据库
		
		return $this->mysql;
	}
	
	
	//设置字符集函数
	private function setChar($charSet){
		mysql_set_charset($charSet);
		$this->charSet=$charSet;
	}
	
	
	//执行语句
	public function query($sql){
		$result = mysql_query($this->mysql,$sql);
		//通过 mysqli_query()  成功执行SELECT, SHOW, DESCRIBE或 EXPLAIN查询会返回一个mysqli_result 对象，其他查询则返回 TRUE 。
		if(!$result){
			echo "sql语句执行失败<br>";
			echo "错误编码是".mysql_errno($this->mysql)."<br>";
			echo "错误信息是".mysql_error($this->mysql)."<br>";
		}
		return $result;
	}
	

	//insert插入语句
	public function insert($table,$array='*'){
		//数组的形式为('字段名1'=>'值1','字段名2'=>'值2')

		if(is_array($array)){
			$keys=implode(',',array_keys($array));				//将数组所有键转化为对应的字符串
		}

		$values="'".implode("','", array_values($array))."'";		//将数组所有的值转化为字符串
		$sql="insert {$table}({$keys}) VALUES ({$values})";

		$res = $this->query($sql);

		if($res){
			return mysql_insert_id();
		}else{
			return false;
		}
	}

	//删除语句
	public function delete($table,$where=null){

		$where=$where==null?'':' WHERE '.$where;
		$sql="DELETE FROM {$table}{$where}";

		$res=$this->query($sql);

		if ($res){
			return mysql_affected_rows();
		}else {
			return false;
		}
	}

	//查询语句
	public function select($table,$array='*',$where=null){

		if(is_array($array)){
			$keys=implode(',',array_keys($array));				//将数组所有键转化为对应的字符串
		}

		$where=$where==null?'':' WHERE '.$where;

		$sql = "SELECT $keys FORM $table {$where}";

		$this->query($sql);

	}


	//upsqte更新语句
	public function update($table,$array,$where=null){
		//数组的形式为('字段名1'=>'值1','字段名2'=>'值2')
		$sets = '';
		foreach ($array as $key=>$val){
			$sets=$key."='".$val."',";
		}
		$sets=rtrim($sets,','); //去掉SQL里的最后一个逗号
		$where=$where==null?'':' WHERE '.$where;

		$sql="UPDATE {$table} SET {$sets} {$where}";

		$res=$this->query($sql);

		if ($res){
			return mysql_affected_rows();
		}else {
			return false;
		}
	}

	//关闭数据库
	public function close(){
		mysql_close($this->mysql);
	}
}