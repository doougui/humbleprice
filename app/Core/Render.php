<?php

namespace App\Core;

/**
 * Class Render
 * @package App\Controllers
 */
class Render
{
    private string $dir;
    private string $title;
    private string $description;
    private string $keywords;

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
        include_once(dirname(__DIR__)."/Views/Layout.php");
    }

    /**
     * Add specific head features
     *
     * @param array $data
     */
    public function addExtraHead(array$data = []): void
    {
        if (file_exists(dirname(__DIR__)."/Views/{$this->getDir()}/head.php")) {
            extract($data);
            include(dirname(__DIR__)."/Views/{$this->getDir()}/head.php");
        }
    }

    /**
     * @param array $data
     */
    public function addNavBtns(array $data = []): void
    {
        if (file_exists(dirname(__DIR__)."/Views/{$this->getDir()}/btns.php")) {
            extract($data);
            include(dirname(__DIR__)."/Views/{$this->getDir()}/btns.php");
        }
    }

    /**
     * Add specific header features
     *
     * @param array $data
     */
    public function addExtraHeader(array $data = []): void
    {
        if (file_exists(dirname(__DIR__)."/Views/{$this->getDir()}/header.php")) {
            extract($data);
            include(dirname(__DIR__)."/Views/{$this->getDir()}/header.php");
        }
    }

    /**
     * Add main content
     *
     * @param array $data
     */
    public function addMainContent(array $data = []): void
    {
        if (file_exists(dirname(__DIR__)."/Views/{$this->getDir()}/main.php")) {
            extract($data);
            include(dirname(__DIR__)."/Views/{$this->getDir()}/main.php");
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
        if (file_exists(dirname(__DIR__)."/Views/{$this->getDir()}/footer.php")) {
            extract($data);
            include(dirname(__DIR__)."/Views/{$this->getDir()}/footer.php");
        }
    }
}