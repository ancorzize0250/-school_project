<?php

namespace App\Transforms;


use App\Transforms\Commons\Active;
use Soft\Starter\Supports\Selectable;
use Soft\Starter\Transforms\Transform;
use Soft\Starter\Transforms\Saveable;
use Soft\Starter\Transforms\Select;

class Person extends Transform implements Saveable, Selectable
{
    use Active;

    /**
     * @var string
     */
    private string $identification;

    /**
     * @var string
     */
    private string $names;

    /**
     * @var string
     */
    private string $surnames;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var integer
     */
    private string $phone;

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
     * @return array<string,mixed>
     */
    public function toUpdate(): array
    {
        return [
            'identification' => $this->getIdentification(),
            'names' => $this->getNames(),
            'surnames' => $this->getSurnames(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'active' => $this->isActive(),
        ];
    } 

    /**
     * @return array<string,mixed>
     */
    public function toCreate(): array
    {
        return [
            'identification' => $this->getIdentification(),
            'names' => $this->getNames(),
            'surnames' => $this->getSurnames(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
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
            'identification' => $this->getIdentification(),
            'names' => $this->getNames(),
            'surnames' => $this->getSurnames(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'active' => $this->isActive(),
        ];
    }

    /**
     * @return Select
     */
    public function toSelect(): Select
    {
        $select = new Select();
        $select->setLabel($this->getIdentification());
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
        $self->setIdentification($request['identification']);
        $self->setNames($request['names']);
        $self->setSurnames($request['surnames']);
        $self->setEmail($request['email']);
        $self->setPhone($request['phone']);
        $self->setActive($request['active']);
        return $self;
    }

    /**
     * Get the value of identification
     *
     * @return  string
     */ 
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * Set the value of identification
     *
     * @param  string  $identification
     *
     * @return  self
     */ 
    public function setIdentification(string $identification)
    {
        $this->identification = $identification;

        return $this;
    }

    /**
     * Get the value of names
     *
     * @return  string
     */ 
    public function getNames()
    {
        return $this->names;
    }

    /**
     * Set the value of names
     *
     * @param  string  $names
     *
     * @return  self
     */ 
    public function setNames(string $names)
    {
        $this->names = $names;

        return $this;
    }

    /**
     * Get the value of surnames
     *
     * @return  string
     */ 
    public function getSurnames()
    {
        return $this->surnames;
    }

    /**
     * Set the value of surnames
     *
     * @param  string  $surnames
     *
     * @return  self
     */ 
    public function setSurnames(string $surnames)
    {
        $this->surnames = $surnames;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     *
     * @return  integer
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @param  integer  $phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of active
     *
     * @return  bool
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @param  bool  $active
     *
     * @return  self
     */ 
    public function setActive(bool $active)
    {
        $this->active = $active;

        return $this;
    }
}