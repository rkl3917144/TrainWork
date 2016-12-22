<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/13/0013
 * Time: 21:40.
 */

//封装一个mysqli类
class mysqliClass
{
    //连接数据库的函数
    //构造方法
    private $dbHostname;        	//连接地址
	private $dbUsername;        	//连接用户
	private $dbPassword;        	//连接密码
	private $dbPort;        		//连接端口
	private $dbDef;       			//连接数据库
	private $dbCharacter;			//设置默认字符集
    public $mysqli;

	//构造方法
    public function __construct($config = array())
    {
        $this->dbHostname = $config['host'];
		$this->dbUsername = $config['user'];
		$this->dbPassword = $config['pass'];
		$this->dbPort = $config['port'] ? $config['port'] : '3306';
		$this->dbDef = $config['defDb'] ? $config['defDb'] : 'test';
		$this->dbCharacter = $config['charset'] ? $config['charset'] : 'utf8';
		$this->mysqli=$this->connect();		//连接数据库

		$this->setchar();		//设置字符集
		$this->setDb();			//设置使用的数据库

		return $this->mysqli;
    }

	//连接数据库
	private function connect(){
		$this->mysqli = mysqli_connect("$this->dbHostname:$this->dbPort",$this->dbUsername,$this->dbPassword);
		if(!$this->mysqli){
			echo "数据库连接失败<br>";
			echo "错误编码".mysqli_errno($this->mysqli)."<br>";
			echo "错误信息".mysqli_error($this->mysqli)."<br>";
			exit;
		}else{
			var_dump($this->mysqli);
		}
		return $this->mysqli;

	}

	//设置字符集
	private function setchar(){
		mysqli_query($this->mysqli,"set names $this->dbCharacter");
	}

	//选择数据库
	private function setDb(){
		mysqli_query($this->mysqli,"use $this->dbDef");
	}

	//执行sql语句
	public function query($sql){
		$result = mysqli_query($this->mysqli,$sql);
				//通过 mysqli_query()  成功执行SELECT, SHOW, DESCRIBE或 EXPLAIN查询会返回一个mysqli_result 对象，其他查询则返回 TRUE 。 
		if(!$result){
			echo "sql语句执行失败<br>";
			echo "错误编码是".mysqli_errno($this->mysqli)."<br>";
			echo "错误信息是".mysqli_error($this->mysqli)."<br>";
		}
		return $result;
	}

	//获取当前字符集
	public function getCharActer(){
		return mysqli_character_set_name($this->mysqli);
	}

	//insert插入语句
	public function insert($table,$array='*'){
		//数组的形式为('字段名1'=>'值1','字段名2'=>'值2')
		
		if(is_array($array)){
			$keys=implode(',',array_keys($array));				//将数组所有键转化为对应的字符串
		}
		
		$values="'".join("','", array_values($array))."'";		//将数组所有的值转化为字符串
		$sql="insert {$table}({$keys}) VALUES ({$values})";
		
		$res = $this->query($sql);

		if($res){
			return mysqli_insert_id();
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
			return mysqli_affected_rows();
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
			return mysqli_affected_rows();
		}else {
			return false;
		}
	}
	
	
	//关闭数据库
	public function close(){
		mysqli_close($this->mysqli);
	}
}
