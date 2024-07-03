<?php

namespace model\Interface;

interface InterfaceSlugManager extends InterfaceManager
{
    public function getBySlug(string $slug);
}
