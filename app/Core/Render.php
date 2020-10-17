<?php

namespace App\Core;

/**
 * Class Render
 * @package App\Controllers
 */
class Render
{
    private $dir;
    private $title;
    private $description;
    private $keywords;

    public function getDir() { return $this->dir; }
    public function setDir(string $dir) { $this->dir = $dir; }
    public function getTitle() { return $this->title; }
    public function setTitle(string $title) { $this->title = $title; }
    public function getDescription() { return $this->description; }
    public function setDescription(string $description) { $this->description = $description; }
    public function getKeywords() { return $this->keywords; }
    public function setKeywords(string $keywords) { $this->keywords = $keywords; }

    /**
     * Method responsible for rendering layout
     *
     * @param array $data
     */
    public function renderLayout(array $data = []): void
    {
        extract($data);
        include_once(DIRREQ.'app/Views/Layout.php');
    }

    /**
     * Add specific head features
     *
     * @param array $data
     */
    public function addExtraHead(array$data = []): void
    {
        if (file_exists(DIRREQ."app/Views/{$this->getDir()}/head.php")) {
            extract($data);
            include(DIRREQ."app/Views/{$this->getDir()}/head.php");
        }
    }

    /**
     * @param array $data
     */
    public function addNavBtns(array $data = []): void
    {
        if (file_exists(DIRREQ."app/Views/{$this->getDir()}/btns.php")) {
            extract($data);
            include(DIRREQ."app/Views/{$this->getDir()}/btns.php");
        }
    }

    /**
     * Add specific header features
     *
     * @param array $data
     */
    public function addExtraHeader(array $data = []): void
    {
        if (file_exists(DIRREQ."app/Views/{$this->getDir()}/header.php")) {
            extract($data);
            include(DIRREQ."app/Views/{$this->getDir()}/header.php");
        }
    }

    /**
     * Add main content
     *
     * @param array $data
     */
    public function addMainContent(array $data = []): void
    {
        if (file_exists(DIRREQ."app/Views/{$this->getDir()}/main.php")) {
            extract($data);
            include(DIRREQ."app/Views/{$this->getDir()}/main.php");
        }
    }

    //

    /**
     * Add specific footer features
     *
     * @param array $data
     */
    public function addExtraFooter(array $data = []): void
    {
        if (file_exists(DIRREQ."app/Views/{$this->getDir()}/footer.php")) {
            extract($data);
            include(DIRREQ."app/Views/{$this->getDir()}/footer.php");
        }
    }
}