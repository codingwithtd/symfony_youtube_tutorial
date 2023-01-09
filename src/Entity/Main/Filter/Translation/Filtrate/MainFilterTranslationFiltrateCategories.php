<?php

namespace App\Entity\Main\Filter\Translation\Filtrate;

use App\Entity\Main\Filter\Translation\MainFilterTranslationCategories;
use App\Repository\Main\Filter\Translation\Filtrate\MainFilterTranslationFiltrateCategoriesRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MainFilterTranslationFiltrateCategoriesRepository::class)]
#[ORM\Table(name: 'main_filter_translation_filtrate_categories')]
#[HasLifecycleCallbacks()]

class MainFilterTranslationFiltrateCategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = false;

    #[ORM\Column(name: 'translation_locale', type: 'string', length: 5)]
    #[Assert\NotBlank(message: "alert-blank-translation-locale")]
    private ?string $translationLocale = 'en_za';

    #[ORM\Column(name: 'translation_description', type: 'string', length: 100)]
    #[Assert\NotBlank(message: "alert-blank-translation-description")]
    private ?string $translationDescription = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $createdAt;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    private ?string $createdBy = 'Unknown';

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $updatedAt;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    private ?string $updatedBy  = 'Unknown';

    #[ORM\ManyToOne(cascade:['persist'], inversedBy: 'filterTranslation')]
    private ?MainFilterTranslationCategories $mainFilterTranslationCategories = null;

    public function __toString()
    {
        if (is_null($this->translationDescription)) {
            return 'null';
        }

        return $this->translationDescription;
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
    public function getTranslationLocale(): ?string
    {
        return $this->translationLocale;
    }

    /**
     * @param string|null $translationLocale
     */
    public function setTranslationLocale(?string $translationLocale): void
    {
        $this->translationLocale = $translationLocale;
    }

    /**
     * @return string|null
     */
    public function getTranslationDescription(): ?string
    {
        return $this->translationDescription;
    }

    /**
     * @param string|null $translationDescription
     */
    public function setTranslationDescription(?string $translationDescription): void
    {
        $this->translationDescription = $translationDescription;
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
     * @return MainFilterTranslationCategories|null
     */
    public function getMainFilterTranslationCategories(): ?MainFilterTranslationCategories
    {
        return $this->mainFilterTranslationCategories;
    }

    /**
     * @param MainFilterTranslationCategories|null $mainFilterTranslationCategories
     * @return MainFilterTranslationFiltrateCategories
     */
    public function setMainFilterTranslationCategories(?MainFilterTranslationCategories $mainFilterTranslationCategories): self
    {
        $this->mainFilterTranslationCategories = $mainFilterTranslationCategories;

        return $this;
    }
}
