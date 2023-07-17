<?php 
require "/signup.classes.php";

class SignupContr extends Signup {
    private $uname; // Private 
    private $pwd;
    private $pwdRepeat;

    public function __construct($uname, $pwd, $pwdRepeat) {
        $this->uname = $uname;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        return;
    }

    private function containsEmpty():bool {
        $has_empty=False;
        if (empty($this->uname) || empty($this->pwd || empty($this->pwdRepeat))){$has_empty=True;};
        return $has_empty;
    }
    
    private function invalidUname():bool {
        $invalid=False;
        if (!preg_match("/^[a-zA-Z0-9]*$/",$this->uname)){
            $invalid=True;
        }
        return $invalid;
    }

    private function pwdMatch():bool {
        $matches=False;
        if ($this->pwd==$this->pwdRepeat) {$matches=True;};
        return $matches;
    }
    
    private function usernameTaken():bool {
        $taken=False;
        if ($this->checkUser($this->uname)==True) {$taken=True;};
        return $taken;
    }

}