<?php
namespace App\Core\Settings;

use App\Core\Exception\CoreException;

class DefaultSettings extends BaseSettings
{
    private $settings = [];

    private $settingIniPath =__DIR__ . '/../../../App/Config/Ini/default.ini';

    /**
     * {@inheritdoc}
     */
    protected function load(): void
    {
        $this->settings = parse_ini_file($this->settingIniPath, true);

        if (!$this->settings) {
            $errorMessage = 'Settings does not contain valid INI settings';
            $this->throwException($errorMessage);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSetting(string $group, string $key): string
    {
        if (!isset($this->settings[$group][$key])) {
            $errorMessage = 'Settings int group' . $group . ' and key ' . $key . 'not found ';
            $this->throwException($errorMessage);
        }

        return (string) $this->settings[$group][$key];
    }

    /**
     * @param string $message
     * @throws CoreException
     */
    private function throwException(string $message)
    {
        throw new CoreException($message);
    }
}
