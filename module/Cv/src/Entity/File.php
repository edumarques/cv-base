<?php

declare(strict_types=1);

namespace Cv\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="file")
 */
class File
{
    public const ID          = 'id';
    public const NAME        = 'name';
    public const TYPE        = 'type';
    public const PATH        = 'path';
    public const ERROR       = 'error';
    public const SIZE        = 'size';
    public const UPLOADED_AT = 'uploadedAt';

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
     * @ORM\Column(name="type",type="string", nullable=false)
     */
    protected ?string $type;

    /**
     * @ORM\Column(name="path",type="string", nullable=false)
     */
    protected ?string $path;

    /**
     * @ORM\Column(name="error",type="integer", nullable=false)
     */
    protected ?int $error;

    /**
     * @ORM\Column(name="size",type="integer", nullable=false)
     */
    protected ?int $size;

    /**
     * @ORM\Column(name="uploaded_at",type="datetime", nullable=false)
     */
    protected ?\DateTime $uploadedAt;


    public function exchangeArray(array $data): self
    {
        $this->id         = $data[self::ID] ?? null;
        $this->name       = $data[self::NAME] ?? null;
        $this->type       = $data[self::TYPE] ?? null;
        $this->path       = $data[self::PATH] ?? null;
        $this->error      = $data[self::ERROR] ?? null;
        $this->size       = $data[self::SIZE] ?? null;
        $this->uploadedAt = $data[self::UPLOADED_AT] ?? null;

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
     * @return File
     */
    public function setName(string $name): File
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string $type
     *
     * @return File
     */
    public function setType(string $type): File
    {
        $this->type = $type;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string $path
     *
     * @return File
     */
    public function setPath(string $path): File
    {
        $this->path = $path;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return int|null
     */
    public function getError(): ?int
    {
        return $this->error;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param int $error
     *
     * @return File
     */
    public function setError(int $error): File
    {
        $this->error = $error;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param int $size
     *
     * @return File
     */
    public function setSize(int $size): File
    {
        $this->size = $size;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return \DateTime|null
     */
    public function getUploadedAt(): ?\DateTime
    {
        return $this->uploadedAt;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param \DateTime $uploadedAt
     *
     * @return File
     */
    public function setUploadedAt(\DateTime $uploadedAt): File
    {
        $this->uploadedAt = $uploadedAt;

        return $this;
    }
}
