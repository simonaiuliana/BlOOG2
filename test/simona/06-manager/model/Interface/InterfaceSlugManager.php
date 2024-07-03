<?php


namespace model\Manager;
use model\Interface\InterfaceManager;

interface InterfaceSlugManager extends InterfaceManager
{
    public function getBySlug(string $slug);
}