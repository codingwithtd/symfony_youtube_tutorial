<?php

namespace App\Entity\Main\User;

use App\Repository\Main\User\MainUserAccountRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use JetBrains\PhpStorm\Pure;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MainUserAccountRepository::class)]
#[ORM\Table(name: 'main_user_account')]
#[UniqueEntity(fields: 'accountID', message:"unique-account-id")]
#[UniqueEntity(fields: 'accountName', message:"unique-account-name")]
#[UniqueEntity(fields: 'emailAddress', message:"unique-email-address")]
#[UniqueEntity(fields: 'mobileNumber', message:"unique-mobile-number")]

class MainUserAccount implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = false;

    #[ORM\Column(type: 'string', length: 25, unique: true)]
    #[Assert\NotBlank(message: "alert-blank-account-id")]
    private ?string $accountID = null;

    #[ORM\Column(type: 'string', length: 25, unique: true)]
    #[Assert\NotBlank(message: "alert-blank-account-name")]
    private ?string $accountName = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isEmailAddress = false;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\NotBlank(message: "alert-blank-email-address")]
    private ?string $emailAddress = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isMobileNumber = false;

    #[ORM\Column(type: 'string', length: 15, unique: true)]
    #[Assert\NotBlank(message: "alert-blank-mobile-number")]
    private ?string $mobileNumber = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

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

    #[ORM\OneToMany(mappedBy: 'mainUserAccount', targetEntity: MainUserNotation::class, cascade: ['persist', 'remove'])]
    private Collection $userNotation;

    #[ORM\OneToOne(inversedBy: 'mainUserAccount', cascade: ['persist', 'remove'])]
    private ?MainUserAvatar $userAvatar = null;

    #[ORM\OneToOne(inversedBy: 'mainUserAccount', cascade: ['persist', 'remove'])]
    private ?MainUserProfile $userProfile = null;

    #[ORM\OneToOne(inversedBy: 'mainUserAccount', cascade: ['persist', 'remove'])]
    private ?MainUserSetting $userSetting = null;

    #[ORM\OneToMany(mappedBy: 'mainUserAccount', targetEntity: MainUserRole::class)]
    private Collection $mainUserRoles;

    #[Pure] public function __construct()
    {
        $this->userNotation = new ArrayCollection();
        $this->mainUserRoles = new ArrayCollection();
    }

    public function __toString()
    {
        if (is_null($this->accountName)) {
            return 'null';
        }

        return $this->accountName;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return string|null
     */
    public function getAccountID(): ?string
    {
        return $this->accountID;
    }

    /**
     * @param string|null $accountID
     */
    public function setAccountID(?string $accountID): void
    {
        $this->accountID = $accountID;
    }

    /**
     * @return string|null
     */
    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    /**
     * @param string|null $accountName
     */
    public function setAccountName(?string $accountName): void
    {
        $this->accountName = $accountName;
    }

    /**
     * @return bool
     */
    public function isEmailAddress(): bool
    {
        return $this->isEmailAddress;
    }

    /**
     * @param bool $isEmailAddress
     */
    public function setIsEmailAddress(bool $isEmailAddress): void
    {
        $this->isEmailAddress = $isEmailAddress;
    }

    /**
     * @return string|null
     */
    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     * @return MainUserAccount
     */
    public function setEmailAddress(string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMobileNumber(): bool
    {
        return $this->isMobileNumber;
    }

    /**
     * @param bool $isMobileNumber
     */
    public function setIsMobileNumber(bool $isMobileNumber): void
    {
        $this->isMobileNumber = $isMobileNumber;
    }

    /**
     * @return string|null
     */
    public function getMobileNumber(): ?string
    {
        return $this->mobileNumber;
    }

    /**
     * @param string|null $mobileNumber
     */
    public function setMobileNumber(?string $mobileNumber): void
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->accountName;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        //$roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = 'ROLE_GUEST_USER';

        $userRoles = $this->getMainUserRoles();

        foreach ($userRoles as $userRole){
            $roles[] = $userRole->getMainFilterUserRole()->getTranslationValue();
        }

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return MainUserAccount
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return MainUserAccount
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, MainUserNotation>
     */
    public function getUserNotation(): Collection
    {
        return $this->userNotation;
    }

    /**
     * @param MainUserNotation $userNotation
     * @return MainUserAccount
     */
    public function addUserNotation(MainUserNotation $userNotation): self
    {
        if (!$this->userNotation->contains($userNotation)) {
            $this->userNotation->add($userNotation);
            $userNotation->setMainUserAccount($this);
        }

        return $this;
    }

    /**
     * @param MainUserNotation $userNotation
     * @return MainUserAccount
     */
    public function removeUserNotation(MainUserNotation $userNotation): self
    {
        if ($this->userNotation->removeElement($userNotation)) {
            // set the owning side to null (unless already changed)
            if ($userNotation->getMainUserAccount() === $this) {
                $userNotation->setMainUserAccount(null);
            }
        }

        return $this;
    }

    public function getUserAvatar(): ?MainUserAvatar
    {
        return $this->userAvatar;
    }

    /**
     * @param MainUserAvatar|null $userAvatar
     * @return MainUserAccount
     */
    public function setUserAvatar(?MainUserAvatar $userAvatar): self
    {
        $this->userAvatar = $userAvatar;

        return $this;
    }

    /**
     * @return MainUserProfile|null
     */
    public function getUserProfile(): ?MainUserProfile
    {
        return $this->userProfile;
    }

    /**
     * @param MainUserProfile|null $userProfile
     * @return MainUserAccount
     */
    public function setUserProfile(?MainUserProfile $userProfile): self
    {
        $this->userProfile = $userProfile;

        return $this;
    }

    /**
     * @return MainUserSetting|null
     */
    public function getUserSetting(): ?MainUserSetting
    {
        return $this->userSetting;
    }

    /**
     * @param MainUserSetting|null $userSetting
     * @return MainUserAccount
     */
    public function setUserSetting(?MainUserSetting $userSetting): self
    {
        $this->userSetting = $userSetting;

        return $this;
    }

    /**
     * @return Collection<int, MainUserRole>
     */
    public function getMainUserRoles(): Collection
    {
        return $this->mainUserRoles;
    }

    /**
     * @param MainUserRole $mainUserRole
     * @return MainUserAccount
     */
    public function addMainUserRole(MainUserRole $mainUserRole): self
    {
        if (!$this->mainUserRoles->contains($mainUserRole)) {
            $this->mainUserRoles->add($mainUserRole);
            $mainUserRole->setMainUserRole($this);
        }

        return $this;
    }

    /**
     * @param MainUserRole $mainUserRole
     * @return MainUserAccount
     */
    public function removeMainUserRole(MainUserRole $mainUserRole): self
    {
        if ($this->mainUserRoles->removeElement($mainUserRole)) {
            // set the owning side to null (unless already changed)
            if ($mainUserRole->getMainUserRole() === $this) {
                $mainUserRole->setMainUserRole(null);
            }
        }

        return $this;
    }
}
