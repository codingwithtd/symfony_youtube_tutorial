<?php

namespace App\Entity\Main\User;

use App\Entity\Main\Filter\User\MainFilterUserModule;
use App\Entity\Main\Filter\User\MainFilterUserRole;
use App\Repository\Main\User\MainUserRoleRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MainUserRoleRepository::class)]
#[ORM\Table(name: 'main_user_role')]

class MainUserRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private mixed $roleImplementDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private mixed $roleReviewDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private mixed $roleExpiryDate;

    #[ORM\Column(type: 'string', length: 100,nullable: true)]
    private ?string $roleDescription;

    #[ORM\Column(type: 'boolean')]
    private bool $isApproved = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $approvedAt;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    private ?string $approvedBy = 'Unknown';

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $createdAt;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    private ?string $createdBy = 'Unknown';

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $updatedAt;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    private ?string $updatedBy = 'Unknown';

    #[ORM\ManyToOne(inversedBy: 'mainUserRoles')]
    private ?MainUserAccount $mainUserAccount = null;

    #[ORM\ManyToOne]
    private ?MainFilterUserRole $mainFilterUserRole = null;

    #[ORM\ManyToOne]
    private ?MainFilterUserModule $mainFilterUserModule = null;

    public function __toString()
    {
        if (is_null($this->mainUserAccount)) {
            return 'null';
        }

        return $this->mainUserAccount;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getRoleImplementDate(): mixed
    {
        return $this->roleImplementDate;
    }

    /**
     * @param mixed $roleImplementDate
     */
    public function setRoleImplementDate(mixed $roleImplementDate): void
    {
        $this->roleImplementDate = $roleImplementDate;
    }

    /**
     * @return mixed
     */
    public function getRoleReviewDate(): mixed
    {
        return $this->roleReviewDate;
    }

    /**
     * @param mixed $roleReviewDate
     */
    public function setRoleReviewDate(mixed $roleReviewDate): void
    {
        $this->roleReviewDate = $roleReviewDate;
    }

    /**
     * @return mixed
     */
    public function getRoleExpiryDate(): mixed
    {
        return $this->roleExpiryDate;
    }

    /**
     * @param mixed $roleExpiryDate
     */
    public function setRoleExpiryDate(mixed $roleExpiryDate): void
    {
        $this->roleExpiryDate = $roleExpiryDate;
    }

    /**
     * @return string|null
     */
    public function getRoleDescription(): ?string
    {
        return $this->roleDescription;
    }

    /**
     * @param string|null $roleDescription
     */
    public function setRoleDescription(?string $roleDescription): void
    {
        $this->roleDescription = $roleDescription;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->isApproved;
    }

    /**
     * @param bool $isApproved
     */
    public function setIsApproved(bool $isApproved): void
    {
        $this->isApproved = $isApproved;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getApprovedAt(): ?DateTimeInterface
    {
        return $this->approvedAt;
    }

    /**
     * @param DateTimeInterface|null $approvedAt
     */
    public function setApprovedAt(?DateTimeInterface $approvedAt): void
    {
        $this->approvedAt = $approvedAt;
    }

    /**
     * @return string|null
     */
    public function getApprovedBy(): ?string
    {
        return $this->approvedBy;
    }

    /**
     * @param string|null $approvedBy
     */
    public function setApprovedBy(?string $approvedBy): void
    {
        $this->approvedBy = $approvedBy;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface|null $createdAt
     */
    public function setCreatedAt(?DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string|null $createdBy
     */
    public function setCreatedBy(?string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @param string|null $updatedBy
     */
    public function setUpdatedBy(?string $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    #[PrePersist]
    public function onPrePersist(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * @return MainUserAccount|null
     */
    public function getMainUserAccount(): ?MainUserAccount
    {
        return $this->mainUserAccount;
    }

    /**
     * @param MainUserAccount|null $mainUserAccount
     */
    public function setMainUserAccount(?MainUserAccount $mainUserAccount): void
    {
        $this->mainUserAccount = $mainUserAccount;
    }

    /**
     * @return MainFilterUserRole|null
     */
    public function getMainFilterUserRole(): ?MainFilterUserRole
    {
        return $this->mainFilterUserRole;
    }

    /**
     * @param MainFilterUserRole|null $mainFilterUserRole
     * @return MainUserRole
     */
    public function setMainFilterUserRole(?MainFilterUserRole $mainFilterUserRole): self
    {
        $this->mainFilterUserRole = $mainFilterUserRole;

        return $this;
    }

    /**
     * @return MainFilterUserModule|null
     */
    public function getMainFilterUserModule(): ?MainFilterUserModule
    {
        return $this->mainFilterUserModule;
    }

    /**
     * @param MainFilterUserModule|null $mainFilterUserModule
     * @return MainUserRole
     */
    public function setMainFilterUserModule(?MainFilterUserModule $mainFilterUserModule): self
    {
        $this->mainFilterUserModule = $mainFilterUserModule;

        return $this;
    }
}
