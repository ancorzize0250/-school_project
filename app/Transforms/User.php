<?php

namespace App\Transforms;

use DateTime;


use App\Transforms\Commons\Active;
use Soft\Starter\Supports\Selectable;
use Soft\Starter\Transforms\Transform;
use Soft\Starter\Transforms\Saveable;
use Soft\Starter\Transforms\Select;
use Illuminate\Support\Facades\Hash;
class User extends Transform implements Saveable, Selectable
{
    use Active;
  
    /**
     * @var string
     */
    private string $user;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var DateTime
     */
    private DateTime $email_verified_at;

    /**
     * @var string
     */
    private string $password;

    /**
     * @var bool
     */
    private bool $active;

    public function __construct()
    {
        $this->id = null;
        $this->active = true;
    }

    /**
     * @return  string
     */ 
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param  string  $user
     * @return  void
     */ 
    public function setUser(string $user):void
    {
        $this->user = $user;
    }

    /**
     * @return  string
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param  string  $email
     * @return  void
     */ 
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return  DateTime
     */ 
    public function getEmail_verified_at():DateTime
    {
        return $this->email_verified_at;
    }

    /**
     * @param  DateTime  $email_verified_at
     * @return  void
     */ 
    public function setEmail_verified_at(DateTime $email_verified_at):void
    {
        $this->email_verified_at = $email_verified_at;
    }

    /**
     * @return  string
     */ 
    public function getPassword():string
    {
        return $this->password;
    }

    /**
     * @param  string  $password
     * @return  void
     */ 
    public function setPassword(string $password):void
    {
        $this->password = $password;
    }

    /**
     * @return array<string,mixed>
     */
    public function toUpdate(): array
    {
        return [
            'user' => $this->getUser(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'active' => $this->isActive()
        ];
    } 

    /**
     * @return array<string,mixed>
     */
    public function toCreate(): array
    {
        return [
            'user' => $this->getUser(),
            'email' => $this->getEmail(),
            'password' => Hash::make($this->getPassword()),
            'active' => $this->isActive(),
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'user' => $this->getUser(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'active' => $this->isActive(),
        ];
    }

    /**
     * @return Select
     */
    public function toSelect(): Select
    {
        $select = new Select();
        $select->setLabel($this->getUser());
        $select->setValue($this->getId());
        return $select;
    }

    /**
     * @param array<string,mixed> $request
     * @return self
     */
    public static function from(array $request): self
    {
        $self = new self();
        $self->setId(null);
        $self->setUser($request['user']);
        $self->setEmail($request['email']);
        $self->setPassword($request['password']);
        $self->setActive($request['active']);
        return $self;
    }
}