<?php

namespace App\Core\Response;

interface ResponseInterface
{
    /**
     * Render template
     */
    public function render(): void;

    /**
     * Render blocks of template
     * @param string $templateName
     */
    public function renderTemplate(string $templateName): void;
}
