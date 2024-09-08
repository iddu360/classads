<?php
class AD
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
  

    public function post_ad($category_id, $description,$register_date,$expire_date)
    {
       try
       {
           $member_id = $_SESSION['member_id'];
           $register_date = date('Y-m-d',strtotime($register_date));
           $expire_date = date('Y-m-d',strtotime($expire_date));
           $stmt = $this->db->prepare("INSERT INTO ad_details(category_id, description, register_date,expire_date, member_id) 
              VALUES(:category_id, :description, :register_date, :expire_date, :member_id )");
              
           $stmt->bindparam(":description", $description);
           $stmt->bindparam(":register_date", $register_date);
           $stmt->bindparam(":expire_date", $expire_date);
           $stmt->bindparam(":member_id", $member_id);
           $stmt->bindparam(":category_id", $category_id);
                       
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

    public function post_image($ad_id, $image)
    {
      try
       {
           $stmt = $this->db->prepare("INSERT INTO ad_image(ad_id, image) 
              VALUES(:ad_id, :image)");
              
           $stmt->bindparam(":ad_id", $ad_id);
           $stmt->bindparam(":image", $image);
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }   
    }

    public function ad_payment($ad_id, $amount)
    {
        try {
          $ad_type = 'Paid';
          $stmt = $this->db->prepare("UPDATE ad_details SET amount =:amount + amount, ad_type=:ad_type WHERE id =:ad_id ");
          $stmt->bindparam(":ad_id", $ad_id);
          $stmt->bindparam(":amount", $amount);
          $stmt->bindparam(":ad_type", $ad_type);
          $stmt->execute(); 
          return $stmt; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        } 
    }

    public function post_article($ad_id,$name,$price,$quantity)
    {
       try
       {
           $stmt = $this->db->prepare("INSERT INTO ad_article(ad_id, name, price,quantity) 
              VALUES(:ad_id, :name, :price, :quantity)");
              
           $stmt->bindparam(":ad_id", $ad_id);
           $stmt->bindparam(":name", $name);
           $stmt->bindparam(":price", $price);
           $stmt->bindparam(":quantity", $quantity);
                       
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

  public function get_all_ads()
  {
      $stmt = $this->db->prepare(" SELECT d.*, c.category_name, m.name, m.email FROM ad_details d, ad_category c, ad_members m WHERE c.id = d.category_id and m.id = d.member_id ORDER BY d.register_date ");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function find_ad($type)
  {
      $stmt = $this->db->prepare(" SELECT d.*, c.category_name, m.name, m.email FROM ad_details d, ad_category c, ad_members m WHERE c.id = d.category_id and m.id = d.member_id and d.ad_type='$type' and d.ad_status = 'Enable' ORDER BY d.register_date ");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function find_ad_by_category($category_id, $type)
  {
      $stmt = $this->db->prepare(" SELECT d.*, c.category_name, m.name, m.email FROM ad_details d, ad_category c, ad_members m WHERE c.id = d.category_id and m.id = d.member_id and d.ad_type='$type' and d.ad_status = 'Enable' and c.id='$category_id' ORDER BY d.register_date ");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function search_ad_by_category($category_id, $type, $description)
  {
      $stmt = $this->db->prepare(" SELECT d.*, c.category_name, m.name, m.email FROM ad_details d, ad_category c, ad_members m WHERE c.id = d.category_id and m.id = d.member_id and d.ad_type='$type' and d.ad_status = 'Enable' and c.id='$category_id' and d.description like '%$description%' ORDER BY d.register_date ");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function find_ad_by_id($id)
  
  {
      $stmt = $this->db->prepare(" SELECT d.*, c.category_name, m.name, m.email FROM ad_details d, ad_category c, ad_members m WHERE c.id = d.category_id and m.id = d.member_id and d.id='$id' ");
      $stmt->bindparam(":id", $id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function find_ad_image($ad_id)
  {
      $stmt = $this->db->prepare(" SELECT * FROM ad_image WHERE ad_id =:ad_id ");
      $stmt->bindparam(":ad_id", $ad_id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function find_all_ad_images($ad_id)
  {
      $stmt = $this->db->prepare(" SELECT * FROM ad_image WHERE ad_id =:ad_id ");
      $stmt->bindparam(":ad_id", $ad_id);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
 
  public function delete_ad($id)
  {
       try
       {
          $stmt = $this->db->prepare("DELETE FROM ad_details   WHERE id = :id ");
          $stmt->bindparam(":id", $id);
          $stmt->execute(); 
   
          return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

    public function update_ad($id, $category_id, $description,$register_date, $expire_date, $ad_status)
    {
       try
       {
          $stmt = $this->db->prepare("UPDATE ad_details SET category_id = :category_id, description=:description, register_date=:register_date, expire_date=:expire_date, ad_status =:ad_status  WHERE id = :id ");
          $stmt->bindparam(":category_id", $category_id);
          $stmt->bindparam(":description", $description);
          $stmt->bindparam(":register_date", $register_date);
          $stmt->bindparam(":expire_date", $expire_date);
          $stmt->bindparam(":ad_status", $ad_status);
          $stmt->bindparam(":id", $id);
          $stmt->execute(); 
   
          return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    
}
?>
 
