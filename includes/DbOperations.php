<?php
class DbOperations
{
    private $con;

    // Construct For Create Connect To DataBase
    function __construct()
    {
        require 'DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
        
    }

    // Check Log In Function
    public function tkhbes(int $id)
    {
        $stamt = $this->con->prepare("SELECT * FROM user_account WHERE Account_id = ?");
        $stamt->execute(array($id));
        return $stamt->rowCount() > 0 ? $stamt->fetch() : false;
    }

    // Check Log In Function
    public function log_in(string $account, string $pass)
    {
        $stamt = $this->con->prepare("SELECT * FROM user_account WHERE password = ? AND (username = ? OR email = ?)");
        $stamt->execute(array( $pass, $account, $account));
        return $stamt->rowCount() > 0 ? $stamt->fetch() : false;
    }

    // Forget Password Function To Check Email Exsit
    public function forget_Pass(string $email)
    {
        $stamt = $this->con->prepare("SELECT * FROM user_account WHERE email = ?");
        $stamt->execute(array($email));
        return $stamt->rowCount();
    }

    // Change Forget Password Function 
    public function Change_Pass(string $email, string $pass)
    {
        $stamt = $this->con->prepare("UPDATE user_account SET password = ? WHERE email = ?");
        $stamt->execute(array($pass, $email));
    }

    // Check User Exist Function 
    public function checkuserexist(string $email)
    {
        $stamts = $this->con->prepare("SELECT * FROM user_account WHERE email = '" . $email . "'");
        $stamts->execute();
        return $stamts->rowCount() == 0 ? "true" : $stamts->fetch();
    }

    // Sign Up Function 
    public function sign_up(string $fname, string $lname, string $email, string $pass, string $code)
    {
        $bool = $this->checkuserexist($email);
        if ($bool == "true") {
            $fullname = $fname . ' ' . $lname;
            $stamt = $this->con->prepare("INSERT INTO user_account(fullname, email, password, check_code, code_date) VALUES(:zfull, :zemail, :zpass, :zcode, now())");
            $stamt->execute(array('zfull' => $fullname,'zemail' => $email,'zpass' => $pass, 'zcode' => $code));
            return "true";
        }
        else
            return $bool;

    }

    // Send Mail Function
    public function send_email(string $email, string $message)
    {
        $headers = array
                (
                    'From' => 'aqar.sy.info@gmail.com',
                    'Reply-To' => 'aqar.sy.info@gmail.com',
                    'X-Mailer' => 'PHP/' . phpversion()
                );
            mail($email, 'passcode', $message, $headers);
    }

    // Diplay All Home Function 
    public function all_home()
    {
        $stamt = $this->con->prepare("SELECT * FROM real_estate , user_account WHERE Property_type = 'شقة' AND user_account.Account_id = real_estate.Account_id ORDER BY Re_id DESC");
        $stamt->execute();
        return ($stamt->rowCount() > 0 ? $stamt->fetchAll() : false);
    }

    // Diplay All Special Function 
    public function all_special()
    {
        $stamt = $this->con->prepare("SELECT * FROM real_estate , user_account WHERE special_or_normal = 'مميز' AND user_account.Account_id = real_estate.Account_id ORDER BY Re_id DESC");
        $stamt->execute();
        return ($stamt->rowCount() > 0 ? $stamt->fetchAll() : false);
    }

    // Diplay All Shop Function 
    public function all_shop()
    {
        $stamt = $this->con->prepare("SELECT * FROM real_estate , user_account WHERE Property_type = 'محل' AND user_account.Account_id = real_estate.Account_id ORDER BY Re_id DESC");
        $stamt->execute();
        return ($stamt->rowCount() > 0 ? $stamt->fetchAll() : false);
    }

    // Diplay All Building Function 
    public function all_building()
    {
        $stamt = $this->con->prepare("SELECT * FROM real_estate , user_account WHERE Property_type = 'بناء' AND user_account.Account_id = real_estate.Account_id ORDER BY Re_id DESC");
        $stamt->execute();
        return ($stamt->rowCount() > 0 ? $stamt->fetchAll() : false);
    }

    // Diplay All Villa Or Farm Function 
    public function all_villaorfarm()
    {
        $stamt = $this->con->prepare("SELECT * FROM real_estate , user_account WHERE Property_type = 'فيلا/مزرعة' AND user_account.Account_id = real_estate.Account_id ORDER BY Re_id DESC");
        $stamt->execute();
        return ($stamt->rowCount() > 0 ? $stamt->fetchAll() : false);
    }

     // Diplay Details Of Post Function 
    public function details_post(int $re_id, String $p)
    {
        switch ($p) {
            case 'شقة':
                $Property_type = "apartments" ;
                break;
            case 'محل':
                $Property_type = "shops" ;
                break;
            case 'بناء':
                $Property_type = "building" ;
                break;
            default:
                $Property_type = "villa_or_farm" ;
                break;
        }
         $stamt = $this->con->prepare("SELECT * FROM real_estate, user_account,". $Property_type . " WHERE apartments.id = real_estate.id AND user_account.Account_id = real_estate.Account_id AND real_estate.Re_id = ?");
        $stamt->execute(array($re_id));
        return $stamt->fetch();
    }

    // Check Email Validation Function
    public function email_validation(string $email)
    {
        $stamt = $this->con->prepare("SELECT * FROM user_account WHERE email = '" . $email . "'");
        $stamt->execute();
        return ($stamt->rowCount() > 0 ? true : false);
    }

    // Check User Name Validation Function
    public function username_validation(string $username)
    {
        $stamt = $this->con->prepare("SELECT * FROM user_account WHERE username = '" . $username . "'");
        $stamt->execute();
        return ($stamt->rowCount() > 0 ? true : false);
    }

    // Check My Favorite Function 
    public function my_favorite(int $id)
    {
        $stamt = $this->con->prepare("SELECT Re_id FROM my_favorite WHERE Account_id = " . $id);
        $stamt->execute();
        return ($stamt->rowCount() > 0 ? $stamt->fetchAll() : false);
    }

    // Check Favorite Status Function 
    public function check_favorite_status(int $id, int $myfavoritestatus, int $Re_id)
    {
        if ($myfavoritestatus == 1) {
            $stamt = $this->con->prepare("DELETE FROM my_favorite WHERE Account_id = ? AND Re_id = ?");
            $stamt->execute(array($id, $Re_id));
            return true;
        }
        else if ($myfavoritestatus == 0){
            $stamt = $this->con->prepare("INSERT INTO my_favorite(Account_id, Re_id) VALUES(:zid, :zRe_id)");
            $stamt->execute(array(
                "zid" => $id,
                "zRe_id" => $Re_id
            ));
            return false;
        }
    }

    // Update My Account Function 
    public function update_my_account(string $fullname, string $pass, string $phone, int $id)
    {
        $stamt = $this->con->prepare("UPDATE user_account SET fullname = ?, Password = ?, phone = ? WHERE Account_id = ?");
        $stamt->execute(array($fullname, $pass, $phone, $id));
        return true;
    }

    // Change Profile Image Function 
    public function change_profile_image(string $image, int $id, string $tmp_image)
    {
        $stamt = $this->con->prepare("SELECT pro_image FROM user_account WHERE Account_id = " . $id);
        $stamt->execute();
        $pro_image = $stamt->fetch();
        if (!empty($pro_image['pro_image'])) {
            $path = explode("http://192.168.137.1/PHP", $pro_image['pro_image']);
            unlink(".." . $path[1]);
        }
        try 
        {
            // $image_name = iconv('utf-8', 'windows-1256', $image);
            $image_path = "http://192.168.137.1/PHP/images/" . $id . "/" . $image;
            if (move_uploaded_file($tmp_image, "../images/" . $id . "/" . $image)) {
                $stamt = $this->con->prepare("UPDATE user_account SET pro_image = ? WHERE Account_id = ?");
                $stamt->execute(array($image_path, $id));
                return $image_path;
            }else {
                return "false";
            }
        } 
        catch (\Throwable $th) {
            return false;
        }
    }

    // Verify Code Function 
    public function verify_code(string $verify_code, int $id, string $date)
    {
        $stamt = $this->con->prepare("SELECT * FROM user_account WHERE Account_id = ? AND check_code = ? AND code_date = ?");
        $stamt->execute(array($id, $verify_code, $date));
        return ($stamt->rowCount() > 0 ? true : false);
    }

    // Create User Name Function 
    public function create_username(string $username, int $id)
    {
        $stamt = $this->con->prepare("UPDATE user_account SET username = ? WHERE Account_id = ?");
        $stamt->execute(array($username, $id));
        return true;
    }

    // Update Check Code And Code Date Function 
    public function update_check_code_and_date(string $code, string $email)
    {
        $stamt = $this->con->prepare("UPDATE user_account SET check_code = ?, code_date = now() WHERE email = ?");
        $stamt->execute(array($code, $email));
        return true;
    }
}