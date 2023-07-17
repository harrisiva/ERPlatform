<?php 

class SignupContr {
    private $uid; // Private 
    private $pwd;
    private $pwdRepeat;

    public function __construct($uid, $pwd, $pwdRepeat) {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        return;
    }

    private function containsEmpty():bool {
        $has_empty=False;
        if (empty($this->uid) || empty($this->pwd || empty($this->pwdRepeat))){$has_empty=True;};
        return $has_empty;
    }
    private function invalidUid():bool {
        $invalid=False;
        if (!preg_match("/^[a-zA-Z0-9]*$/",$this->uid)){
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