<?php 
// Including signup.classes.php here breaks the program, not sure why

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

    function signupUser() {
        $handler = new Signup();
        if ($this->containsEmpty()) {
            header ("location: ../index.php?error=inputContainsEmpty");
            exit();
        }
        if ($this->invalidUname()) {
            header ("location: ../index.php?error=invalidUsername");
            exit();
        }
        if (!$this->pwdMatch()) {
            header ("location: ../index.php?error=pwdNotMatch");
            exit();
        }
        if ($handler->checkExists($this->uname)){
            header ("location: ../index.php?error=usernameTaken");
            exit();
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

?>