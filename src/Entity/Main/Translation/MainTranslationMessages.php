<?php

namespace App\Entity\Main\Translation;

use App\Entity\Main\Filter\Translation\MainFilterTranslationCategories;
use App\Entity\Main\Translation\Filtrate\MainTranslationFiltrateMessages;
use App\Repository\Main\Translation\MainTranslationMessagesRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use JetBrains\PhpStorm\Pure;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MainTranslationMessagesRepository::class)]
#[ORM\Table(name: 'main_translation_messages')]
#[UniqueEntity(fields: 'translationKey', message:"unique-translation-key")]
#[HasLifecycleCallbacks()]

class MainTranslationMessages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = false;

    #[ORM\Column(name: 'translation_key', type: 'string', length: 145, unique: true)]
    //#[Assert\NotBlank(message: "alert-blank-translation-key")]
    private ?string $translationKey = null;

    #[ORM\Column(name: 'translation_value', type: 'string', length: 45, nullable: true)]
    private ?string $translationValue = null;

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

    #[ORM\OneToMany(mappedBy: 'mainTranslationMessages', targetEntity: MainTranslationFiltrateMessages::class, cascade:['persist', 'remove'] )]
    private Collection $filterTranslation;

    #[ORM\ManyToOne]
    #[Assert\NotBlank(message: "alert-blank-translation-category")]
    private ?MainFilterTranslationCategories $mainFilterTranslationCategories = null;

    #[Pure]
    public function __construct()
    {
        $this->filterTranslation = new ArrayCollection();
    }

    public function __toString()
    {
        if (is_null($this->translationKey)) {
            return 'null';
        }

        return $this->translationKey;
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
    public function getTranslationKey(): ?string
    {
        return $this->translationKey;
    }

    /**
     * @param string|null $translationKey
     */
    public function setTranslationKey(?string $translationKey): void
    {
        $this->translationKey = $translationKey;
    }

    /**
     * @return string|null
     */
    public function getTranslationValue(): ?string
    {
        return $this->translationValue;
    }

    /**
     * @param string|null $translationValue
     */
    public function setTranslationValue(?string $translationValue): void
    {
        $this->translationValue = $translationValue;
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
     * @return Collection<int, MainTranslationFiltrateMessages>
     */
    public function getFilterTranslation(): Collection
    {
        return $this->filterTranslation;
    }

    /**
     * @param MainTranslationFiltrateMessages $filterTranslation
     * @return MainTranslationMessages
     */
    public function addFilterTranslation(MainTranslationFiltrateMessages $filterTranslation): self
    {
        if (!$this->filterTranslation->contains($filterTranslation)) {
            $this->filterTranslation->add($filterTranslation);
            $filterTranslation->setMainTranslationMessages($this);
        }

        return $this;
    }

    /**
     * @param MainTranslationFiltrateMessages $filterTranslation
     * @return MainTranslationMessages
     */
    public function removeFilterTranslation(MainTranslationFiltrateMessages $filterTranslation): self
    {
        if ($this->filterTranslation->removeElement($filterTranslation)) {
            // set the owning side to null (unless already changed)
            if ($filterTranslation->getMainTranslationMessages() === $this) {
                $filterTranslation->setMainTranslationMessages(null);
            }
        }

        return $this;
    }

    /**
     * @return MainFilterTranslationCategories|null
     */
    public function getMainFilterTranslationCategories(): ?MainFilterTranslationCategories
    {
        return $this->mainFilterTranslationCategories;
    }

    /**
     * @param MainFilterTranslationCategories|null $mainFilterTranslationCategories
     * @return MainTranslationMessages
     */
    public function setMainFilterTranslationCategories(?MainFilterTranslationCategories $mainFilterTranslationCategories): self
    {
        $this->mainFilterTranslationCategories = $mainFilterTranslationCategories;

        return $this;
    }

}
