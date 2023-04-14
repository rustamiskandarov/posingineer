<?php

namespace App\entities;

class User
{
    private int $id;
    private string $username;
    private string $email;
    private int $rolesMask;
    private bool $status;
    private bool $verified;
    private bool $resettable;

    /**
     * @param string $username
     * @param string $email
     * @param int $rolesMask
     * @param bool $status
     * @param bool $verified
     * @param bool $resettable
     */
    public function __construct(int $id, string $username, string $email, int $rolesMask, bool $status, bool $verified, bool $resettable)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->rolesMask = $rolesMask;
        $this->status = $status;
        $this->verified = $verified;
        $this->resettable = $resettable;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getRolesMask(): int
    {
        return $this->rolesMask;
    }

    /**
     * @param int $rolesMask
     */
    public function setRolesMask(int $rolesMask): void
    {
        $this->rolesMask = $rolesMask;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->verified;
    }

    /**
     * @param bool $verified
     */
    public function setVerified(bool $verified): void
    {
        $this->verified = $verified;
    }

    /**
     * @return bool
     */
    public function isResettable(): bool
    {
        return $this->resettable;
    }

    /**
     * @param bool $resettable
     */
    public function setResettable(bool $resettable): void
    {
        $this->resettable = $resettable;
    }




}