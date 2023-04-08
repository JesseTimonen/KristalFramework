<?php namespace Backend\Core\Helper\Actions;
defined("ACCESS") or exit("Access Denied");


class CreatorTool
{
    public function __construct()
    {
        // This action can only be performed during development mode
        if (MAINTENANCE_MODE !== true)
        {
            createError("This action can only be performed while development mode is active!", true);
        }
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
        if (file_exists("app/Backend/Core/Helper/templates/entity"))
        {
            if ($request["entity-type"] == "entity")
            {
                $template = file_get_contents("app/Backend/Core/Helper/templates/entity");
            }
            else
            {
                $template = file_get_contents("app/Backend/Core/Helper/templates/entity_interface");
            }
        }

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
        if (!file_exists("app/Backend/Entities/" . $name . ".php"))
        {
            try
            {
                file_put_contents("app/Backend/Entities/" . $name . ".php", $template);
                createNotification("Entity $name has been created successfully!", true);
            }
            catch (Exception $e)
            {
                createError("Failed to create entity!", true);
            }
        }
        else
        {
            createError("Failed to create entity since entity $name already exists!", true);
        }
    }


    public function createController($name)
    {
        // Make sure name doesn't have special characters
        $name = getPureName(ucfirst(filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS)));

        // Get template
        if (file_exists("app/Backend/Core/Helper/templates/controller"))
        {
            $template = file_get_contents("app/Backend/Core/Helper/templates/controller");
        }

        // Insert variables to template
        $template = str_replace("{{ name }}", $name, $template);

        // Write controller
        if (!file_exists("app/Backend/Controllers/" . $name . ".php"))
        {
            try
            {
                file_put_contents("app/Backend/Controllers/" . $name . ".php", $template);
                createNotification("Controller $name has been created successfully!", true);
            }
            catch (Exception $e)
            {
                createError("Failed to create controller!", true);
            }
        }
        else
        {
            createError("Failed to create controller since controller $name already exists!", true);
        }
    }
}