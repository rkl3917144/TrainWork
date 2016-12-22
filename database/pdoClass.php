<?php

class pdoClass
{
    private $pdo = null;
    public $statement = null;
    public $test = null;
    public $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ',
    );


    
    //构造方法
    public function __construct($host, $user = 'root', $pass = '', $dbname = '', $persistent = false, $charset = 'utf8')
    {
        $this->options[PDO::MYSQL_ATTR_INIT_COMMAND] .= $charset;
        if ($persistent) {
            $this->options[PDO::ATTR_PERSISTENT] = true;
        }
        $dsn = "mysql:host={$host};dbname={$dbname}";
        $this->pdo = new PDO($dsn, $user, $pass, $this->options);
    }


	
    //返回一个statement对象
    public function prepare($sql)
    {
        if ($sql == '') {
            return false;
        }
        $this->statement = $this->pdo->prepare($sql);

        return $this->statement;
    }



    //执行Sql语句，一般用于 增、删、更新或者设置
    public function exec($sql)
    {
        if ($sql == '') {
            return false;
        }

        return $this->pdo->exec($sql);
    }



    //执行有返回值的查询，返回PDOStatement  可以通过链式操作，可以通过这个类封装的操作获取数据
    public function query($sql)
    {
        if ($sql == '') {
            return false;
        }
        $this->statement = $this->pdo->query($sql);

        return $this->statement;
    }



    //开启事务
    public function beginTA()
    {
        return $this->pdo->beginTransaction();
    }
    
    //提交事务
    public function commit()
    {
        return $this->pdo->commit();
    }
    
    //事务回滚
    public function rollBack()
    {
        return $this->pdo->rollBack();
    }

    


    //**   PDOStatement 类操作封装    **//



    //让模版执行SQL语句，1、执行编译好的 2、在执行时编译
    public function execute($param)
    {
        if (is_array($param)) {
            try {
                return $this->statement->execute($param);
            } catch (Exception $e) {
                return $this->errorInfo();
            }
        } else {
            try {
                return $this->statement->execute();
            } catch (Exception $e) {
                return $this->errorInfo();
            }
        }
    }



    //PDO::FETCH_BOUND	如果设置了bindColumn，则使用该参数
    public function fetch($fetch_style = PDO::FETCH_ASSOC)
    {
        if (is_object($this->statement)) {
            return $this->statement->fetch($fetch_style);
        } else {
            return false;
        }
    }



    //给定要处理这个结果的类或函数
    public function fetchAll($fetch_style = PDO::FETCH_ASSOC, $handle = '')
    {
        if ($handle != '') {
            return $this->statement->fetchAll($fetch_style, $handle);
        } else {
            return $this->statement->fetchAll($fetch_style);
        }
    }



    //以对象形式返回 结果 跟fetch(PDO::FETCH_OBJ)一样
    public function fetchObject($class_name)
    {
        if ($class_name != '') {
            return $this->statement->fetchObject($class_name);
        } else {
            return $this->statement->fetchObject();
        }
    }

    

    //以引用的方式绑定变量到占位符(可以只执行一次prepare，执行多次bindParam达到重复使用的效果)
    public function bindParam($parameter, $variable, $data_type = PDO::PARAM_STR)
    {
        return $this->statement->bindParam($parameter, $variable, $data_type);
    }
    

    
    //关闭连接
    public function close()
    {
        return $this->statement->closeCursor();
    }
    
    public function closeCursor()
    {
        return $this->statement->closeCursor();
    }
    
    //返回错误信息也包括错误号
    private function errorInfo()
    {
        return $this->statement->errorInfo();
    }
    
    
    //返回错误号
    public function errorCode()
    {
        return $this->statement->errorCode();
    }
}
