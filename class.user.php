<?php
class USER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    public function register($uname,$umail,$upass,$car_id)
    {
       try
       {
           $new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("INSERT INTO user(user_name,user_email,user_pass) 
                                                       VALUES(:uname, :umail, :upass)");
              
           $stmt->bindparam(":uname", $uname);
           $stmt->bindparam(":umail", $umail);
           $stmt->bindparam(":upass", $new_password);
           //$stmt->bindparam(":car_id", $car_id);
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    
    public function complete_user($title,$first_name,$last_name,$date_of_birth,$occupation,$phone_no,$address1,$address2,$address3,$county,$user_id)
    {
       try
       {   
           
           $stmt = $this->db->prepare("UPDATE `user` SET `title` = :title, `first_name` = :first_name, `last_name` = :last_name, `occupation` = :occupation, `DoB` = :date_of_birth, `phoneNo` = :phone_no, `address1` = :address1, `address2` = :address2, `address3` = :address3, `county` = :county WHERE `user`.`user_id` = :user_id;");
           
           $stmt->bindparam(":title", $title);
           $stmt->bindparam(":first_name", $first_name);
           $stmt->bindparam(":last_name", $last_name);
           $stmt->bindparam(":date_of_birth", $date_of_birth);
           $stmt->bindparam(":occupation", $occupation);
           $stmt->bindparam(":phone_no", $phone_no);
           $stmt->bindparam(":address1", $address1);
           $stmt->bindparam(":address2", $address2);
           $stmt->bindparam(":address3", $address3);
           $stmt->bindparam(":county", $county);
           $stmt->bindparam(":user_id", $user_id);
           
           
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    
    
    
 
    public function login($uname,$umail,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM user WHERE user_name=:uname OR user_email=:umail LIMIT 1");
          $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($upass, $userRow['user_pass']))
             {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
    
    
    public function user_car($id,$cid)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE `user` SET `car_id` = :car_id WHERE `user`.`user_id` = :id;");
           $stmt->bindparam(":car_id", $cid);
           $stmt->bindparam(":id", $id);
           $stmt->execute();            
           
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    
    
    
    
    
    
    
    
    public function register_car($make,$model,$reg, $engine, $color,$value)
    {
       try
       {
           
   
           $stmt = $this->db->prepare("INSERT INTO register_car(make,model,reg,engine,color,value) 
                                                       VALUES(:make, :model, :reg,:engine, :color, :value)");
              
           $stmt->bindparam(":make", $make);
           $stmt->bindparam(":model", $model);
           $stmt->bindparam(":reg", $reg);
           $stmt->bindparam(":engine", $engine);
           $stmt->bindparam(":color", $color);
           $stmt->bindparam(":value", $value);
           $stmt->execute();            
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    
    
    public function claim($ppsn,$licenceNo,$vin,$damage,$value,$location,$involve,$name,$name_on_payment)
    {
       try
       {
    
   
           $stmt = $this->db->prepare("INSERT INTO claim(ppsn,licenceNo,vin,damage,value,location,involve,name,name_on_payment) 
                                                       VALUES(:ppsn,:licenceNo,:vin,:damage,:value,:location,:involve,:name,:name_on_payment)");
              
           $stmt->bindparam(":ppsn", $ppsn);
           $stmt->bindparam(":licenceNo", $licenceNo);
            
           $stmt->bindparam(":vin", $vin);
           $stmt->bindparam(":damage", $damage);
           $stmt->bindparam(":value", $value);
           $stmt->bindparam(":location", $location);
           $stmt->bindparam(":involve", $involve);
           $stmt->bindparam(":name", $name);
           $stmt->bindparam(":name_on_payment", $name_on_payment);
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    public function user_claim($id,$licenceNo)
    {
       try
       {
           $stmt = $this->db->prepare("UPDATE `user` SET `payment_id` = :licenceNo WHERE `user`.`user_id` = :id;");
           $stmt->bindparam(":licenceNo", $licenceNo);
           $stmt->bindparam(":id", $id);
           $stmt->execute();            
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    
    
    
    
    
    public function clamp($noticeNo,$licenceNo,$value)
    {
       try
       {
    // needs to be sorted to check if amount is actually in their account.
   
           $stmt = $this->db->prepare("SELECT amount From user WHERE user_id = $user;");
              
           $stmt->bindparam(":ppsn", $ppsn);
           $stmt->bindparam(":licenceNo", $licenceNo);
            
           $stmt->bindparam(":vin", $vin);
           $stmt->bindparam(":damage", $damage);
           $stmt->bindparam(":value", $value);
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    
    
    
    
    
    public function delete_account($id) 
    { 
        $stmt = $this->db->prepare("DELETE FROM user WHERE user_id='$id'"); 
        $stmt->execute(); 
        return $stmt;
    } 
    
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
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