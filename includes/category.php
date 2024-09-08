<?php
class CATEGORY
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
  

    public function add_cateogry($category_name)
    {
       try
       {
          $stmt = $this->db->prepare("INSERT INTO ad_category(category_name) VALUES(:category_name )");
          $stmt->bindparam(":category_name", $category_name);
          $stmt->execute(); 
   
          return $stmt; 
       }
       catch(PDOException $e)
       {
          echo $e->getMessage();
       }    
    }

    public function update_category($id,$category_name)
    {
       try
       {
          $stmt = $this->db->prepare("UPDATE ad_category SET category_name = :category_name  WHERE id = :id ");
          $stmt->bindparam(":category_name", $category_name);
          $stmt->bindparam(":id", $id);
          $stmt->execute(); 
   
          return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

    public function delete_category($id)
    {
       try
       {
          $stmt = $this->db->prepare("DELETE FROM ad_category   WHERE id = :id ");
          $stmt->bindparam(":id", $id);
          $stmt->execute(); 
   
          return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

    public function get_all_categories()
    {
      $stmt = $this->db->prepare("SELECT * FROM ad_category ");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     
}
?>
 
