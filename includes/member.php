<?php
class MEMBER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    public function register($name,$address,$city,$state,$phone, $email, $password)
    {
       try
       {
           $password = md5($password);
   
           $stmt = $this->db->prepare("INSERT INTO ad_members(name,address,city, state, phone, email, password) 
              VALUES(:name, :address, :city, :state, :phone, :email, :password )");
              
           $stmt->bindparam(":name", $name);
           $stmt->bindparam(":address", $address);
           $stmt->bindparam(":city", $city);
           $stmt->bindparam(":state", $state);
           $stmt->bindparam(":phone", $phone);
           $stmt->bindparam(":email", $email);
           $stmt->bindparam(":password", $password);            
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function login($email,$password)
    {
       try
       {
          $password = md5($password);
          $stmt = $this->db->prepare("SELECT * FROM ad_members WHERE email=:email and password=:password and status=:status LIMIT 1");
          $stmt->execute(array(':email'=>$email, ':password'=>$password, ':status'=>'Active'));
          $row=$stmt->fetch(PDO::FETCH_ASSOC);

          if($stmt->rowCount() > 0)
          {
            $_SESSION['member_id'] = $row['id'];
            $_SESSION['type_of_user'] = $row['type_of_user'];
            return true;
            
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function get_all_members()
   {
      $type_of_user = 'member';
      $stmt = $this->db->prepare("SELECT * FROM ad_members WHERE  type_of_user=:type_of_user ");
      $stmt->execute(array(':type_of_user'=>$type_of_user));
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

  public function delete_member($id)
  {
    try
       {
        $stmt = $this->db->prepare("DELETE FROM ad_members WHERE id=:id ");
        $stmt->execute(array(':id'=>$id));
        return true;
      } catch(PDOException $e) {
           echo $e->getMessage();
       }
  }
//start from here
  public function update_member($name,$address,$city,$state,$phone,$status, $id)
  {
    try{
      $stmt = $this->db->prepare("UPDATE ad_members SET name=:name, address=:address, city=:city, state=:state, phone=:phone, status=:status WHERE id=:id ");
        $stmt->execute(array(':id'=>$id, ':name'=>$name, ':address'=>$address, ':city'=>$city, ':state'=>$state, ':phone'=>$phone, ':status'=>$status ));
        return true;

    } catch(PDOException $e)
       {
           echo $e->getMessage();
    }
  }

  public function is_loggedin()
  {
      if(!isset($_SESSION['member_id']))
      {
         return true;
      }
  }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>
 
