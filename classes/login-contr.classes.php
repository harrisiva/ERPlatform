<?php 
require "../classes/login.classes.php";

class LoginContr extends Login {
    private $uname;
    private $pwd;

    public function __construct($uname, $pwd) {
        $this->uname = $uname;
        $this->pwd = $pwd;
        return;
    }

    public function loginUser() {
        if ($this->containsEmpty()) {
            header ("location: ../index.php?error=inputContainsEmpty");
            exit();
        }

        //$this->getUser($this->uname, $this->pwd);
        return;
    }

    private function containsEmpty():bool {
        $has_empty=False;
        if (empty($this->uname) || empty($this->pwd)) {$has_empty=True;};
        return $has_empty;
    }
    
}

?>