<?php

namespace Evk\BxMigrate\Migrate\Traits;

use Evk\BxMigrate\Migrate\Exception;
use CModule;

/**
 * Трэйт с функциями для установки/удаления модулей битрикса.
 */
trait Module
{
    /**
     * @param string $name
     *
     * @return array
     *
     * @throws \Evk\BxMigrate\Migrate\Exception
     */
    public function installModule($name)
    {
        $return = [];
        if (!($module = CModule::CreateModuleObject($name))) {
            throw new Exception("Module {$name} not found");
        } elseif ($module->IsInstalled()) {
            throw new Exception("Module {$name} already installed");
        } else {
            $module->DoInstall();
            $return[] = "Module {$name} installed";
        }

        return $return;
    }

    /**
     * @param string $name
     *
     * @return array
     *
     * @throws \Evk\BxMigrate\Migrate\Exception
     */
    public function uninstallModule($name)
    {
        $return = [];
        if (!($module = CModule::CreateModuleObject($name))) {
            throw new Exception("Module {$name} not found");
        } elseif (!$module->IsInstalled()) {
            throw new Exception("Module {$name} already uninstalled");
        } else {
            $module->DoUninstall();
            $return[] = "Module {$name} uninstalled";
        }

        return $return;
    }
}
