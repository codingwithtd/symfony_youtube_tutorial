<?php

namespace App\Entity\Main\User;

use App\Entity\Main\Filter\User\MainFilterUserHint;
use App\Repository\Main\User\MainUserSettingRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MainUserSettingRepository::class)]
#[ORM\Table(name: 'main_user_setting')]

class MainUserSetting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = false;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    #[Assert\NotBlank(message: "alert-blank-hint_answer")]
    private ?string $hintAnswer = null;

    #[ORM\Column(type: 'string', length: 45)]
    private ?string $ipAddress = '0.0.0.0';

    #[ORM\Column(type: 'string', length: 5)]
    private ?string $locale = 'en_za';

    #[ORM\Column(type: 'string', length: 5)]
    private ?string $country = 'ZAR';

    #[ORM\Column(type: 'string', length: 5)]
    private ?string $currency = 'ZAR';

    #[ORM\Column(type: 'string', length: 5)]
    private ?string $timeFormat = 'H:i';

    #[ORM\Column(type: 'string', length: 10)]
    private ?string $dateFormat = 'd M Y';

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

    #[ORM\OneToOne(mappedBy: 'userSetting', cascade: ['persist', 'remove'])]
    private ?MainUserAccount $mainUserAccount = null;

    #[ORM\ManyToOne]
    private ?MainFilterUserHint $mainFilterUserHint = null;

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
    public function getHintAnswer(): ?string
    {
        return $this->hintAnswer;
    }

    /**
     * @param string|null $hintAnswer
     */
    public function setHintAnswer(?string $hintAnswer): void
    {
        $this->hintAnswer = $hintAnswer;
    }

    /**
     * @return string|null
     */
    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    /**
     * @param string|null $ipAddress
     */
    public function setIpAddress(?string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string|null $locale
     */
    public function setLocale(?string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     */
    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string|null
     */
    public function getTimeFormat(): ?string
    {
        return $this->timeFormat;
    }

    /**
     * @param string|null $timeFormat
     */
    public function setTimeFormat(?string $timeFormat): void
    {
        $this->timeFormat = $timeFormat;
    }

    /**
     * @return string|null
     */
    public function getDateFormat(): ?string
    {
        return $this->dateFormat;
    }

    /**
     * @param string|null $dateFormat
     */
    public function setDateFormat(?string $dateFormat): void
    {
        $this->dateFormat = $dateFormat;
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
     * @return MainUserSetting
     */
    public function setMainUserAccount(?MainUserAccount $mainUserAccount): self
    {
        // unset the owning side of the relation if necessary
        if ($mainUserAccount === null && $this->mainUserAccount !== null) {
            $this->mainUserAccount->setUserSetting(null);
        }

        // set the owning side of the relation if necessary
        if ($mainUserAccount !== null && $mainUserAccount->getUserSetting() !== $this) {
            $mainUserAccount->setUserSetting($this);
        }

        $this->mainUserAccount = $mainUserAccount;

        return $this;
    }

    /**
     * @return MainFilterUserHint|null
     */
    public function getMainFilterUserHint(): ?MainFilterUserHint
    {
        return $this->mainFilterUserHint;
    }

    /**
     * @param MainFilterUserHint|null $mainFilterUserHint
     * @return MainUserSetting
     */
    public function setMainFilterUserHint(?MainFilterUserHint $mainFilterUserHint): self
    {
        $this->mainFilterUserHint = $mainFilterUserHint;

        return $this;
    }
}
