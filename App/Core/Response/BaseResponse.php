<?php

namespace App\Core\Response;

class BaseResponse implements ResponseInterface
{
    /** @var string */
    private static $viewPath = __DIR__ . '/../../../Public/Templates/';

    /** @var array */
    private $data;

    /** @var string */
    private $templateName;

    private const BASE_TEMPLATE = 'base';

    public const NOT_FOUND_TEMPLATE = '404noFound';

    /**
     * @param string $templateName
     * @param array $data
     */
    public function __construct(
        string $templateName,
        array $data = []
    ) {
        $this->data = $data;

        $templateFilePath = $this->getTemplateFilePath($templateName);
        $this->templateName = is_file($templateFilePath) ?
            $templateName :
            self::NOT_FOUND_TEMPLATE;
    }

    /**
     * Render template
     */
    public function render(): void
    {
        $this->loadTemplate(self::BASE_TEMPLATE);
    }

    /**
     * @param string|null $blockName
     */
    public function renderTemplate(string $blockName = null): void
    {
        $templateName = $blockName ?: $this->templateName;
        $this->loadTemplate($templateName);
    }

    /**
     * @param string $templateName
     * @return string
     */
    private function getTemplateFilePath(string $templateName): string
    {
        $templateName = ucfirst(ucwords($templateName, '/'));
        return self::$viewPath . str_replace('\\', DIRECTORY_SEPARATOR, $templateName) . '.php';
    }

    /**
     * @param string $templateName
     */
    private function loadTemplate(string $templateName): void
    {
        $templateFile = $this->getTemplateFilePath($templateName);
        include_once($templateFile);
    }
}
