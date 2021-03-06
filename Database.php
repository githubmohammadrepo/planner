<?php

class Databasep
{
    private $database_name = 'planner';
    private $database_username = 'root';
    private $database_password = '';
    private $isConnect = false;
    private $pdo_conn = null;
    public function __construct()
    {
        try {
            $this->pdo_conn = new PDO(
                    "mysql:host=localhost;dbname=$this->database_name",
                    $this->database_username,
                    $this->database_password
                );
                // Enabled throwing errors - you can remove this after debugging
                $this->pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            // Echo the error we got - you should only output errors when debugging
            $this->isConnect = true;
            echo '<hr>';
                echo 'error connection';
            echo '</hr>';
            // echo $e->GetMessage();
        }
    }

    public function Read($down, $up)
    {
        if(!$this->isConnect){
            try {

                // Prepare the statement
                
                $stmt =  $this->pdo_conn->prepare("SELECT * FROM `tasks` WHERE `created` > '$down' And `created` < '$up'");
                
    
                // You can also use bindparams, I like to use execute and pass and array so it is shorter
                $stmt->execute(array());
                if ($stmt->RowCount() == 0) {
                    // Do stuff when no results are found (without an error)
                    echo 'something';
                } else {
                    $Results = $stmt->FetchAll(PDO::FETCH_ASSOC);
                    foreach ($Results as $key => $value) {
                        $id= $value['title_id'];
                        array_splice($value,1,1,$this->FindTitleById($id));
                        $Results[$key] = $value;
                    }
                   return (($Results));
                }
            
    
                // Catch any exceptions and put the error into $e
            } catch (Exception $e) {
                // Echo the error we got - you should only output errors when debugging
                echo $e->GetMessage();
                echo '<hr>';
                    echo 'error Reading';
                echo '</hr>';
            }
        }
    }

    public function FindTitleById($id){
            if(!$this->isConnect){
                try {
    
                    // Prepare the statement
                    $stmt =  $this->pdo_conn->prepare("Select title From titles WHERE ID=$id    ");
        
                    // You can also use bindparams, I like to use execute and pass and array so it is shorter
                    $stmt->execute(array());
                    if ($stmt->RowCount() == 0) {
                        // Do stuff when no results are found (without an error)
                        echo 'something';
                    } else {
                        $Results = $stmt->FetchAll(PDO::FETCH_ASSOC);
                        
                       return (($Results[0]));
                    }
                
        
                    // Catch any exceptions and put the error into $e
                } catch (Exception $e) {
                    // Echo the error we got - you should only output errors when debugging
                    // echo $e->GetMessage();
                    echo '<hr>';
                        echo 'error Reading';
                    echo '</hr>';
                }
        }
    }
    public function Update()
    {
    }

    public function Insert($values)
    {   
        $sql = "INSERT INTO tasks ( title_id,read_time ) VALUES (:title_id, :read_time)";
        $pdo_statement = $this->pdo_conn->prepare($sql);
        print_r($pdo_statement);
        $result = $pdo_statement->execute(
            array(
                ':title_id' => htmlspecialchars(trim($values['title_id'])),
                ':read_time' => htmlspecialchars(trim($values['read_time'])),
            )
        );
        // $result = $pdo_statement->execute(array(':read_time' => htmlspecialchars(trim($_POST['read_time'])), ':description' => $_POST['description'], ':post_at' => $_POST['post_at']));
        if (!empty($result)) {
            // header('location:index.php');
            echo 'inserted';
        }else{
            echo 'not inserted';
        }
    }

    public function Delete()
    {
    }

    public function ReadOriginal()
    {
        if(!$this->isConnect){
            try {

                // Prepare the statement
                $stmt =  $this->pdo_conn->prepare("SELECT * FROM `tasks` WHERE 1 ORDER BY created;");
    
                // You can also use bindparams, I like to use execute and pass and array so it is shorter
                $stmt->execute(array());
                if ($stmt->RowCount() == 0) {
                    // Do stuff when no results are found (without an error)
                    echo 'something';
                } else {
                    $Results = $stmt->FetchAll(PDO::FETCH_ASSOC);
                    foreach ($Results as $key => $value) {
                        $id= $value['title_id'];
                        array_splice($value,1,1,$this->FindTitleById($id));
                        $Results[$key] = $value;
                    }
                   return (($Results));
                }
            
    
                // Catch any exceptions and put the error into $e
            } catch (Exception $e) {
                // Echo the error we got - you should only output errors when debugging
                // echo $e->GetMessage();
                echo '<hr>';
                    echo 'error Reading';
                echo '</hr>';
            }
        }
    }
    

    public function __destruct()
    {
        //unset all properties
        unset($this->pdo_conn);
        unset($this->database_name);
        unset($this->database_username);
        unset($this->database_password);
    }

    public  function first(){
        if(!$this->isConnect){
            try {

                // Prepare the statement
                $stmt =  $this->pdo_conn->prepare("SELECT `created` FROM `tasks` WHERE 1 ORDER BY created ASC LIMIT 1
                ");
    
                // You can also use bindparams, I like to use execute and pass and array so it is shorter
                $stmt->execute(array());
                if ($stmt->RowCount() == 0) {
                    // Do stuff when no results are found (without an error)
                    echo 'something';
                } else {
                    $Results = $stmt->FetchAll(PDO::FETCH_ASSOC);
                   
                   return (($Results[0]['created']));
                }
            
    
                // Catch any exceptions and put the error into $e
            } catch (Exception $e) {
                // Echo the error we got - you should only output errors when debugging
                // echo $e->GetMessage();
                echo '<hr>';
                    echo 'error Reading';
                echo '</hr>';
            }
        }
    }

    public function last(){
        if(!$this->isConnect){
            try {

                // Prepare the statement
                $stmt =  $this->pdo_conn->prepare("SELECT `created` FROM `tasks` WHERE 1 ORDER BY created DESC LIMIT 1
                ");
    
                // You can also use bindparams, I like to use execute and pass and array so it is shorter
                $stmt->execute(array());
                if ($stmt->RowCount() == 0) {
                    // Do stuff when no results are found (without an error)
                    echo 'something';
                } else {
                    $Results = $stmt->FetchAll(PDO::FETCH_ASSOC);
                    
                   return (($Results[0]['created']));
                }
            
    
                // Catch any exceptions and put the error into $e
            } catch (Exception $e) {
                // Echo the error we got - you should only output errors when debugging
                // echo $e->GetMessage();
                echo '<hr>';
                    echo 'error Reading';
                echo '</hr>';
            }
        }
    }
}
