<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Model;

interface ThemeInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void;

    /**
     * @return array|ThemeAuthor[]
     */
    public function getAuthors(): array;

    /**
     * @param ThemeAuthor $author
     */
    public function addAuthor(ThemeAuthor $author): void;

    /**
     * @param ThemeAuthor $author
     */
    public function removeAuthor(ThemeAuthor $author): void;

    /**
     * @return array|ThemeInterface[]
     */
    public function getParents(): array;

    /**
     * @param ThemeInterface $theme
     */
    public function addParent(ThemeInterface $theme): void;

    /**
     * @param ThemeInterface $theme
     */
    public function removeParent(ThemeInterface $theme): void;

    /**
     * @return array|ThemeScreenshot[]
     */
    public function getScreenshots(): array;

    /**
     * @param ThemeScreenshot $screenshot
     */
    public function addScreenshot(ThemeScreenshot $screenshot): void;

    /**
     * @param ThemeScreenshot $screenshot
     */
    public function removeScreenshot(ThemeScreenshot $screenshot): void;
}
