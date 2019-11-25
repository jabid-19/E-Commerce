<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Format.php');
?>

<?php
class User
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function userInsert($data)
    {
        $userName = mysqli_real_escape_string($this->db->link, $data['userName']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);

        if (empty($userName)) {
            echo "<span class='error'>Please Entar Username !</span>";
        } else {
            $query = "INSERT INTO tbl_user(userName, city, zip, email, address, country, phone, password) VALUES('$userName','$city','$zip', '$email', '$address', '$country','$phone', '$password')";
            $userinsert = $this->db->insert($query);
            if ($userinsert) {
                $msg = "<span class = 'success'> User Inserted Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class = 'error'> User Not Inserted Successfully</span>";
                return $msg;
            }

            // $inserted_rows =$this->db->insert($query);
            // if ($inserted_rows) {
            //     echo "<span class='success'>Image Inserted Successfully.
            //      </span>";
            // } else {
            //     echo "<span class='error'>Image Not Inserted !</span>";
            // }
        }
    }

    public function userLogin($email, $password)
    {
        $email =  $this->fm->validation($email);
        $password =  $this->fm->validation($password);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);
        if (empty($email) || empty($password)) {
            $loginmsg = "User Name or Password Must Not be Empty ";
            return $loginmsg;
        } else {
            $query = "SELECT * FROM tbl_user WHERE email='$email' AND password='$password'";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set("userLogin", true);
                Session::set("id", $value['id']);
                Session::set("userName", $value['userName']);
                header("Location:index.php");
            } else {
                $loginmsg = "Not Match ";
                return $loginmsg;
            }
        }
    }
}
