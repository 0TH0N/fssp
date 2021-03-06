<?php

namespace Fssp\Subject;

use DateTime;

class Physical implements SubjectInterface
{
    const CODE = 'physical';
    const TYPE = 1;
    const ALL_REGIONS = -1;
    private $region;
    private $firstname;
    private $lastname;
    private $secondname;
    private $birthdate;

    /**
     * Physical constructor.
     * @param string $lastname
     * @param string $firstname
     * @param string $secondname
     * @param DateTime|null $birthdate
     * @param integer $region
     */
    public function __construct($lastname, $firstname, $secondname = '',
                                DateTime $birthdate = null, $region = self::ALL_REGIONS)
    {
        $this->region = $region ?: self::ALL_REGIONS;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->secondname = $secondname;
        if ($birthdate) {
            $this->birthdate = $birthdate;
        }
    }

    public function type(): int
    {
        return self::TYPE;
    }

    public function code(): string
    {
        return self::CODE;
    }

    public function isValid(): bool
    {
        $this->region = intval($this->region);
        $this->firstname = trim($this->firstname);
        $this->lastname = trim($this->lastname);
        $this->secondname = trim($this->secondname);
        return ($this->region && $this->firstname && $this->lastname);
    }

    public function params(): array
    {
        return [
            'region' => $this->region,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'secondname' => $this->secondname,
            'birthdate' => $this->birthdate ? $this->birthdate->format('d.m.Y') : '',
        ];
    }
}