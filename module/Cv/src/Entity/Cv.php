<?php

declare(strict_types=1);

namespace Cv\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cv")
 */
class Cv
{
    public const ID         = 'id';
    public const NAME       = 'name';
    public const EMAIL      = 'email';
    public const TELEPHONE  = 'telephone';
    public const POSITION   = 'position';
    public const EDUCATION  = 'education';
    public const COMMENTS   = 'comments';
    public const FILE       = 'file';
    public const CREATED_AT = 'createdAt';
    public const IP_ADDRESS = 'ipAddress';

    public const EDUCATION_ELEMENTARY_SCHOOL = 'elementary';
    public const EDUCATION_MIDDLE_SCHOOL     = 'middle';
    public const EDUCATION_HIGH_SCHOOL       = 'high';
    public const EDUCATION_UNDERGRADUATE     = 'undergraduate';
    public const EDUCATION_GRADUATE          = 'graduate';
    public const EDUCATION_PHD               = 'phd';

    public const EDUCATION_TO_LABEL = [
        self::EDUCATION_ELEMENTARY_SCHOOL => 'Elementary school',
        self::EDUCATION_MIDDLE_SCHOOL     => 'Middle school',
        self::EDUCATION_HIGH_SCHOOL       => 'High school',
        self::EDUCATION_UNDERGRADUATE     => 'Undergraduate',
        self::EDUCATION_GRADUATE          => 'Graduate',
        self::EDUCATION_PHD               => 'PhD',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected ?int $id;

    /**
     * @ORM\Column(name="name",type="string", nullable=false)
     */
    protected ?string $name;

    /**
     * @ORM\Column(name="email",type="string", nullable=false)
     */
    protected ?string $email;

    /**
     * @ORM\Column(name="telephone",type="string", nullable=false)
     */
    protected ?string $telephone;

    /**
     * @ORM\Column(name="position",type="string", nullable=false)
     */
    protected ?string $position;

    /**
     * @ORM\Column(name="education",type="string", nullable=false)
     */
    protected ?string $education;

    /**
     * @ORM\Column(name="comments",type="text", nullable=true)
     */
    protected ?string $comments;

    /**
     * @ORM\OneToOne(targetEntity="\Cv\Entity\File", mappedBy="file", cascade={"persist"})
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     */
    protected ?File $file;

    /**
     * @ORM\Column(name="created_at",type="datetime", nullable=false)
     */
    protected ?\DateTime $createdAt;

    /**
     * @ORM\Column(name="ip_address",type="string", nullable=false)
     */
    protected ?string $ipAddress;


    public function exchangeArray(array $data): self
    {
        $this->id        = $data[self::ID] ?? null;
        $this->name      = $data[self::NAME] ?? null;
        $this->email     = $data[self::EMAIL] ?? null;
        $this->telephone = $data[self::TELEPHONE] ?? null;
        $this->position  = $data[self::POSITION] ?? null;
        $this->education = $data[self::EDUCATION] ?? null;
        $this->comments  = $data[self::COMMENTS] ?? null;
        $this->file      = $data[self::FILE] ?? null;
        $this->createdAt = $data[self::CREATED_AT] ?? null;
        $this->ipAddress = $data[self::IP_ADDRESS] ?? null;

        return $this;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string $telephone
     *
     * @return self
     */
    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string $position
     *
     * @return self
     */
    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getEducation(): ?string
    {
        return $this->education;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string $education
     *
     * @return self
     */
    public function setEducation(string $education): self
    {
        $this->education = $education;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getComments(): ?string
    {
        return $this->comments;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $comments
     *
     * @return self
     */
    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param File $file
     *
     * @return self
     */
    public function setFile(File $file): self
    {
        $this->file = $file;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $ipAddress
     *
     * @return self
     */
    public function setIpAddress(?string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }
}
