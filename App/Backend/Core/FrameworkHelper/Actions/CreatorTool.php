<?php namespace Backend\Core\Helper\Actions;
defined("ACCESS") or exit("Access Denied");


class CreatorTool
{
    public function __construct()
    {
        // This action can only be performed during development mode
        if (MAINTENANCE_MODE !== true)
        {
            throw new \Exception("This action can only be performed while development mode is active!");
        }

        $this->checkFileIntegrity();
    }


    private function checkFileIntegrity()
    {
        $templates = [
            "entity",
            "entity_interface",
            "controller"
        ];
    
        foreach ($templates as $template)
        {
            $source = "App/Backend/Core/FrameworkHelper/Templates/" . $template;
            $destination = "App/Public/Cache/FrameworkHelperTemplates/" . $template;
    
            if (!file_exists($source))
            {
                if (!file_exists($destination))
                {
                    copy($source, $destination);
                }
            }
            else
            {
                throw new \Exception("Missing '{$template}' Template file at: /App/Backend/Core/FrameworkHelper/Templates/");
            }
        }
    }


    private function getTemplate($file_name)
    {
        $templatePath = "App/Backend/Core/FrameworkHelper/templates/";
        $cachePath = "App/Public/Cache/FrameworkHelperTemplates/";

        // Check do we have overwritten template in the cache
        if (file_exists($cachePath . $file_name))
        {
            return file_get_contents($cachePath . $file_name);
        }
        elseif (file_exists($templatePath . $file_name))
        {
            // Fallback to Framework template
            return file_get_contents($templatePath . $file_name);
        }

        throw new \Exception("Failed to create $file_name because template was not found at App/Backend/Core/FrameworkHelper/templates/$file_name");
    }


    public function createEntity($request)
    {
        // Variables
        $name = filter_var($request["entity-name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $table = filter_var($request["table-name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $primary_key = filter_var($request["field-name-0"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        for ($i = 0; $i < 20; $i++)
        {
            $length = ($request["type-length-$i"] !== "" ? "(" . filter_var($request["type-length-$i"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . ")" : "");
            $default = ($request["default-$i"] !== "" ? " DEFAULT " . filter_var($request["default-$i"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "");
            $default = str_replace('"', "'", $default);
            $not_null = (isset($request["not-null-$i"]) ? " NOT NULL" : "");
            $auto_increment = (isset($request["auto-increment-$i"]) ? " AUTO_INCREMENT" : "");
            $unique = (isset($request["unique-$i"]) ? " UNIQUE" : "");

            if ($request["field-name-$i"] !== "")
            {
                $fieldName = filter_var($request["field-name-$i"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $fieldType = filter_var($request["field-type-$i"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // "name" => "type(length) default 'example' not null unique",
                $fields[$i] = "\n\t\t\t" . '"' . $fieldName . '" => "' . $fieldType . $length . $default . $not_null . $auto_increment . $unique . '",';

                // Store field defaults
                $field_defaults[$i] = "public $" . $fieldName . ' = "' . str_replace('"', "'", $default) . '";' . "\n\t";

                // Create entity get/set functions
                $get_set[$i] = "\n\n\t// " . ucfirst($fieldName) . "\n\tfunction set" . ucfirst($fieldName) . "($" . $fieldName . ")\n\t{" . "\n\t\t" . '$this->' . $fieldName . ' = $' . $fieldName . ";\n\t}\n\tfunction get" . ucfirst($fieldName) . "()\n\t{\n\t\t" . 'return $this->' . $fieldName . ";\n\t}";
            }
        }

        // Make sure name doesn't have special characters
        $name = getPureName(ucfirst($name));

        // Get template
        $template = $this->getTemplate($request["entity-type"] == "entity" ? "entity" : "entity_interface");

        // Insert variables to template
        $template = str_replace("{{ name }}", $name, $template);
        $template = str_replace("{{ table }}", $table, $template);
        $template = str_replace("{{ primary_key }}", $primary_key, $template);

        for ($i = 0; $i < 20; $i++)
        {
            $template = str_replace("{{ field_$i }}", $fields[$i], $template);
            $template = str_replace("{{ field_defaults_$i }}", $field_defaults[$i], $template);
            $template = str_replace("{{ get_set_$i }}", $get_set[$i], $template);
        }

        // Write entity
        if (!file_exists("App/Backend/Entities/" . $name . ".php"))
        {
            try
            {
                file_put_contents("App/Backend/Entities/" . $name . ".php", $template);
                debug("Entity $name has been created successfully!");
            }
            catch (Exception $e)
            {
                throw new \Exception("Failed to create entity!");
            }
        }
        else
        {
            throw new \Exception("Failed to create entity since entity $name already exists!");
        }
    }




    public function createController($name)
    {
        // Make sure name doesn't have special characters
        $name = getPureName(ucfirst(filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS)));

        // Get template
        $template = $this->getTemplate("controller");

        // Insert variables to template
        $template = str_replace("{{ name }}", $name, $template);

        // Write controller
        if (!file_exists("App/Backend/Controllers/" . $name . ".php"))
        {
            try
            {
                file_put_contents("App/Backend/Controllers/" . $name . ".php", $template);
                debug("Controller $name has been created successfully!");
            }
            catch (Exception $e)
            {
                throw new \Exception("Failed to create controller!");
            }
        }
        else
        {
            throw new \Exception("Failed to create controller since controller $name already exists!");
        }
    }
}