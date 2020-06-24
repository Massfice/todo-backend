<?php

namespace App\Authentication;

class CurrentUser {
    private static $instance;
    private $data;
    private $auth;

    private function __construct(User $user) {
        $user_data = $user->getAuthIdentifier();

        if($user_data["auth"]) {
            $this->data = $user_data["data"];
            $this->auth = true;
        } else {
            $this->data = [];
            $this->auth = false;
        }
    }

    private function getData(string $key) {
        if(!$this->auth || !isset($this->data[$key])) {
            return null;
        } else {
            return $this->data[$key];
        }
    }

    public static function createInstance(User $user) {
        self::$instance = new self($user);
    }

    public static function getInstance() : self {
        return self::$instance;
    }

    public function isAuth() : bool {
        return $this->auth;
    }

    public function getName() : ?string {
        return $this->getData("name");
    }

    public function getSurname() : ?string {
        return $this->getData("surname");
    }

    public function getEmail() : ?string {
        return $this->getData("email");
    }

    public function getId() : ?string {
        return $this->getData("id");
    }
}