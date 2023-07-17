<?php 
require "/signup.classes.php";

class SignupContr {
    private $uname; // Private 
    private $pwd;
    private $pwdRepeat;

    public function __construct($uname, $pwd, $pwdRepeat) {
        $this->uname = $uname;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        return;
    }

    private function signupUser() {
        echo "In Signup user";
        if ($this->containsEmpty()) {
            echo "Contains Empty";
            //header ("location: ../index.php?error=inputContainsEmpty");
            //exit();
        }
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
    
}