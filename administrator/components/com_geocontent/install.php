<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of GeoContent component
 */
class com_GeoContentInstallerScript
{
        /**
         * method to install the component
         *
         * @return void
         */
        function install($parent)
        {
            $manifest = $parent->get("manifest");
            $parent = $parent->getParent();
            $source = $parent->getPath("source");

            $installer = new JInstaller();

            // Install plugins
            foreach($manifest->plugins->plugin as $plugin) {
                $attributes = $plugin->attributes();
                $plg = $source . DS . $attributes['folder'].DS.$attributes['plugin'];
                $installer->install($plg);
            }

            // Install modules
            foreach($manifest->modules->module as $module) {
                $attributes = $module->attributes();
                $mod = $source . DS . $attributes['folder'].DS.$attributes['module'];
                $installer->install($mod);
            }

            $db = JFactory::getDbo();
            $tableExtensions = $db->nameQuote("#__extensions");
            $columnElement   = $db->nameQuote("element");
            $columnType      = $db->nameQuote("type");
            $columnEnabled   = $db->nameQuote("enabled");

            // Enable plugins
            $db->setQuery(
                "UPDATE
                    $tableExtensions
                SET
                    $columnEnabled=1
                WHERE
                    $columnElement='geocontent'
                AND
                    $columnType='plugin'"
            );

            $db->query();

        }

        /**
         * method to install the component
         *
         * @return void
         */
        function update($parent)
        {
            $manifest = $parent->get("manifest");
            $parent = $parent->getParent();
            $source = $parent->getPath("source");

            $installer = new JInstaller();

            // Install plugins
            foreach($manifest->plugins->plugin as $plugin) {
                $attributes = $plugin->attributes();
                $plg = $source . DS . $attributes['folder'].DS.$attributes['plugin'];
                $installer->install($plg);
            }

            // Install modules
            foreach($manifest->modules->module as $module) {
                $attributes = $module->attributes();
                $mod = $source . DS . $attributes['folder'].DS.$attributes['module'];
                $installer->install($mod);
            }

        }


}
