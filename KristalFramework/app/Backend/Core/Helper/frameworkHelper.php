<!-- Include css and js files -->
<link rel = "stylesheet" type = "text/css" href = "<?= getURL("app/Backend/Core/Helper/frameworkHelper.css"); ?>">
<script src = "<?= getURL("app/Backend/Core/Helper/frameworkHelper.js"); ?>"></script>


<!-- framework mini helper icon -->
<div id = "framework-mini-helper">
    <img src = "app/Backend/Core/Helper/icon.png" alt = "" width = "45px" height = "45px" />
    <p id = "framework-mini-helper-title">Framework<br>helper</p>
</div>


<!-- Navigation bar -->
<nav class = "navbar navbar-expand-lg fixed-bottom navbar-dark" id = "framework-helper">

    <!-- Title -->
    <a class = "navbar-brand" id = "helper-title">Kristal<br>Framework</a>


    <!-- Helper links -->
    <li class = "list-group-item framework-helper-list-group-item" id = "link-documentation">Documentation</li>
    <li class = "list-group-item framework-helper-list-group-item" id = "link-training">Training</li>
    <li class = "list-group-item framework-helper-list-group-item" id = "link-actions">Actions</li>
    <li class = "list-group-item framework-helper-list-group-item" id = "link-creator">Creator Tools</li>
    <li class = "list-group-item framework-helper-list-group-item" id = "link-media-library" data-bs-toggle = "modal" data-bs-target = "#media-library-modal">Media Library</li>
    <li class = "list-group-item framework-helper-list-group-item" id = "link-version">Version</li>


    <!-- Media library modal -->
    <div class = "modal fade" id = "media-library-modal" data-backdrop = "static" data-keyboard = "false">
        <div class = "modal-dialog modal-lg">
            <div class = "modal-content">

                <!-- Modal Header -->
                <div class = "modal-header">
                    <h2 class = "modal-title">Media Library</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal body -->
                <div class = "modal-body">
                    <div class = "form-group">

                        <div class="form-outline">
                            <h3 class = "modal-title">Search</h3>
                            <input type="search" id="media-library-search" class="form-control" />
                            <br><br>
                        </div>

                        <?php
                        foreach (glob("app/public/images/*") as $i)
                        {
                            if (is_dir($i))
                            {
                                echo "<h3 class = 'media-library-title'>Folder: $i</h3>";
                                foreach (glob("$i/*") as $j)
                                {
                                    if (is_dir($j))
                                    {
                                        echo "<h3 class = 'media-library-title'>Folder: $j</h3>";
                                        foreach (glob("$j/*") as $k)
                                        {
                                            if (!is_dir($k))
                                            {
                                                echo "<img src = '" . thumbnail($k) . "' alt = '$k' class = 'media-library-image' width = '25%' height = '190px'>";
                                            }
                                        }
                                    }
                                    else
                                    {
                                        echo "<img src = '" . thumbnail($j) . "' alt = '$j' class = 'media-library-image' width = '25%' height = '190px'>";
                                    }
                                }
                            }
                        }

                        echo "<h3 class = 'media-library-title'>Folder: app/public/images/</h3>";
                        foreach (glob("app/public/images/*") as $i)
                        {
                            if (!is_dir($i))
                            {
                                echo "<img src = '" . thumbnail($i) . "' alt = '$i' class = 'media-library-image' width = '25%' height = '190px'>";
                            }
                        }
                        ?>

                    </div>
                </div>

                <!-- Modal footer -->
                <div class = "modal-footer">
                    <button type = "button" class = "btn btn-secondary" data-bs-dismiss = "modal">Exit</button>
                </div>

            </div>
        </div>
    </div>
    

    <!-- version navigation -->
    <ul class = "navbar-nav" id = "navigation-version" style = "display: none;">
        <li class = "nav-item nav-link active" id = "framework-version-message" style = "max-width: 1000px;"></li>
    </ul>


    <!-- Training navigation -->
        <ul class = "navbar-nav" id = "navigation-training" style = "display: none;">
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/configuration" target = "_blank">Configuration</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/routes" target = "_blank">Routes</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/pages" target = "_blank">Pages</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/forms" target = "_blank">Forms</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/controllers" target = "_blank">Controllers</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/sessions" target = "_blank">Sessions</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/database" target = "_blank">Database</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/entities" target = "_blank">Entities</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/translations" target = "_blank">Translations</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/mailer" target = "_blank">Mailer</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/cache" target = "_blank">Cache</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/javascript" target = "_blank">JavaScript</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/training/latest/scss" target = "_blank">SCSS</a></li>
    </ul>


    <!-- Documentations navigation -->
    <ul class = "navbar-nav" id = "navigation-documentation" style = "display: none;">
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/configuration" target = "_blank">Configuration</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/routes" target = "_blank">Routes</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/pages" target = "_blank">Pages</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/forms" target = "_blank">Forms</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/controllers" target = "_blank">Controllers</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/sessions" target = "_blank">Sessions</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/database" target = "_blank">Database</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/entities" target = "_blank">Entities</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/translations" target = "_blank">Translations</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/mailer" target = "_blank">Mailer</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/cache" target = "_blank">Cache</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/javascript" target = "_blank">JavaScript</a></li>
        <li class = "nav-item"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/documentation/latest/scss" target = "_blank">SCSS</a></li>
    </ul>


    <!-- Actions navigation -->
    <ul class = "navbar-nav" id = "navigation-actions" style = "display: none;">
        <li class = "list-group-item framework-helper-list-group-item" id = "action-database-backup-link">Database Backup</li>
        <li class = "list-group-item framework-helper-list-group-item" id = "action-import-database-link">Import Database</li>
        <li class = "list-group-item framework-helper-list-group-item" id = "action-clear-database-link">Clear Database</li>
    </ul>


    <!-- Creator tools navigation -->
    <ul class = "navbar-nav" id = "navigation-creator" style = "display: none;">
        <li class = "list-group-item framework-helper-list-group-item" id = "action-create-entity-link" data-bs-toggle = "modal" data-bs-target = "#create-entity-modal">Create Entity</li>
        <li class = "list-group-item framework-helper-list-group-item" id = "action-create-controller-link" data-bs-toggle = "modal" data-bs-target = "#create-controller-modal">Create Controller</li>
    </ul>


    <!-- Create entity modal -->
    <div class = "modal fade" id = "create-entity-modal" data-backdrop = "static" data-keyboard = "false">
        <div class = "modal-dialog modal-lg">
            <div class = "modal-content">

                <!-- Modal Header -->
                <div class = "modal-header">
                    <h2 class = "modal-title">Create Entity</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action = "" method = "post" role = "form" class = "framework-form" id = "create-entity-form">
                    <?php csrf("create_entity"); request("create_entity"); ?>
                    <input type = "hidden" name = "authentication" value = "<?= password_hash(SESSION_NAME . getCSRF("create_entity") . $_SESSION["IP_address"], PASSWORD_DEFAULT); ?>">

                    <!-- Modal body -->
                    <div class = "modal-body">

                        <div class = "form-group">
                            <label for = "entity-name">Entity Name</label>
                            <input type = "text" class = "form-control" id = "entity-name" name = "entity-name" required>
                        </div>

                        <div class = "form-group">
                            <label for = "entity-type">Entity Type</label>
                            <select class = "form-control" id = "entity-type" name = "entity-type">
                                <option value = "entity">Database Entity</option>
                                <option value = "interface">Database Interface</option>
                            </select>
                        </div>

                        <div class = "form-group">
                            <label for = "table-name">Table Name</label>
                            <input type = "text" class = "form-control" id = "table-name" name = "table-name" required>
                        </div>

                        <label>Primary Key</label>
                        <table class = "table">
                            <thead>
                                <tr>
                                    <th scope = "col">Name</th>
                                    <th scope = "col" style = "min-width: 150px;">Type</th>
                                    <th scope = "col">Length</th>
                                    <th scope = "col">Default</th>
                                    <th style = "text-align: center;" scope = "col">Not Null</th>
                                    <th style = "text-align: center;" scope = "col">Auto Increment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type = "text" class = "form-control field-name" id = "field-name-0" name = "field-name-0" required></td>
                                    <td><select class = "form-control field-type" id = "field-type-0" name = "field-type-0" required>
                                        <optgroup label = "Common">
                                            <option>INT</option>
                                            <option>VARCHAR</option>
                                            <option passLength = "true">TIMESTAMP</option>
                                        </optgroup>

                                        <optgroup label = "Numeric">
                                            <option>TINYINT</option>
                                            <option>SMALLINT</option>
                                            <option>MEDIUMINT</option>
                                            <option>INT</option>
                                            <option>BIGINT</option>

                                            <option>DECIMAL</option>
                                            <option>FLOAT</option>
                                            <option>DOUBLE</option>
                                        </optgroup>

                                        <optgroup label = "Text">
                                            <option>CHAR</option>
                                            <option>VARCHAR</option>

                                            <option>TINYTEXT</option>
                                            <option>MEDIUMTEXT</option>
                                            <option>TEXT</option>
                                            <option>LONGTEXT</option>
                                        </optgroup>

                                        <optgroup label = "Boolean">
                                            <option>BOOLEAN</option>
                                        </optgroup>

                                        <optgroup label = "Date">
                                            <option passLength = "true">DATE</option>
                                            <option passLength = "true">DATETIME</option>
                                            <option passLength = "true">TIMESTAMP</option>
                                            <option passLength = "true">TIME</option>
                                            <option passLength = "true">YEAR</option>
                                        </optgroup>
                                    </select></td>
                                    <td><input type = "number" class = "form-control" id = "type-length-0" name = "type-length-0" style = "max-width: 100px;" required></td>
                                    <td><input type = "text" class = "form-control" id = "default-0" name = "default-0"><p style = "font-size: 10px; color: gray;">Quotation marks needed for static values!</p></td>
                                    <td style = "text-align: center;"><input type = "checkbox" class = "form-check-input" id = "not-null-0" name = "not-null-0"></td>
                                    <td style = "text-align: center;"><input type = "checkbox" class = "form-check-input" id = "auto-increment-0" name = "auto-increment-0"></td>
                                </tr>
                            </tbody>
                        </table>

                        <label>Additional Fields</label>
                        <table class = "table">
                            <thead>
                                <tr>
                                    <th scope = "col">Name</th>
                                    <th scope = "col" style = "min-width: 150px;">Type</th>
                                    <th scope = "col">Length</th>
                                    <th scope = "col">Default</th>
                                    <th style = "text-align: center;" scope = "col">Not Null</th>
                                    <th style = "text-align: center;" scope = "col">Auto Increment</th>
                                    <th style = "text-align: center;" scope = "col">Unique</th>
                                </tr>
                            </thead>
                            <?php for ($i = 1; $i < 20; $i++): ?>
                                <tbody>
                                    <tr>
                                        <td><input type = "text" class = "form-control field-name" id = "field-name-<?= $i ?>" name = "field-name-<?= $i ?>"></td>
                                        <td><select class = "form-control field-type" id = "field-type-<?= $i ?>" name = "field-type-<?= $i ?>">
                                            <optgroup label = "Common">
                                                <option>INT</option>
                                                <option>VARCHAR</option>
                                                <option passLength = "true">TIMESTAMP</option>
                                            </optgroup>

                                            <optgroup label = "Numeric">
                                                <option>TINYINT</option>
                                                <option>SMALLINT</option>
                                                <option>MEDIUMINT</option>
                                                <option>INT</option>
                                                <option>BIGINT</option>

                                                <option>DECIMAL</option>
                                                <option>FLOAT</option>
                                                <option>DOUBLE</option>
                                            </optgroup>

                                            <optgroup label = "Text">
                                                <option>CHAR</option>
                                                <option>VARCHAR</option>

                                                <option>TINYTEXT</option>
                                                <option>MEDIUMTEXT</option>
                                                <option>TEXT</option>
                                                <option>LONGTEXT</option>
                                            </optgroup>

                                            <optgroup label = "Boolean">
                                                <option>BOOLEAN</option>
                                            </optgroup>

                                            <optgroup label = "Date">
                                                <option passLength = "true">DATE</option>
                                                <option passLength = "true">DATETIME</option>
                                                <option passLength = "true">TIMESTAMP</option>
                                                <option passLength = "true">TIME</option>
                                                <option passLength = "true">YEAR</option>
                                            </optgroup>
                                        </select></td>
                                        <td><input type = "number" class = "form-control" id = "type-length-<?= $i ?>" name = "type-length-<?= $i ?>" style = "max-width: 100px;"></td>
                                        <td><input type = "text" class = "form-control" id = "default-<?= $i ?>" name = "default-<?= $i ?>"></td>
                                        <td style = "text-align: center;"><input type = "checkbox" class = "form-check-input" id = "not-null-<?= $i ?>" name = "not-null-<?= $i ?>"></td>
                                        <td style = "text-align: center;"><input type = "checkbox" class = "form-check-input" id = "auto-increment-<?= $i ?>" name = "auto-increment-<?= $i ?>"></td>
                                        <td style = "text-align: center;"><input type = "checkbox" class = "form-check-input" id = "unique-<?= $i ?>" name = "unique-<?= $i ?>"></td>
                                    </tr>
                                </tbody>
                            <?php endfor; ?>
                        </table>
                    </div>

                    <!-- Modal footer -->
                    <div class = "modal-footer">
                        <button type = "submit" id = "create-entity-submit" class = "btn btn-primary">Create</button>
                        <button type = "button" class = "btn btn-secondary" data-bs-dismiss = "modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Create controller modal -->
    <div class = "modal fade" id = "create-controller-modal" data-backdrop = "static" data-keyboard = "false">
        <div class = "modal-dialog modal-lg">
            <div class = "modal-content">

                <!-- Modal Header -->
                <div class = "modal-header">
                    <h2 class = "modal-title">Create Controller</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action = "" method = "post" role = "form" class = "framework-form" id = "create-controller-form">
                    <?php csrf("create_controller"); request("create_controller"); ?>
                    <input type = "hidden" name = "authentication" value = "<?= password_hash(SESSION_NAME . getCSRF("create_controller") . $_SESSION["IP_address"], PASSWORD_DEFAULT); ?>">

                    <!-- Modal body -->
                    <div class = "modal-body">
                        <div class = "form-group">
                            <input type = "text" class = "form-control" id = "controller-name" name = "controller-name" placeholder = "Controller Name" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class = "modal-footer">
                        <button type = "submit" class = "btn btn-primary" id = "create-controller-submit">Create</button>
                        <button type = "button" class = "btn btn-secondary" data-bs-dismiss = "modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Database backup forms -->
    <ul class = "navbar-nav" id = "actions-database-backup" style = "display: none;">
        <?php $databases = unserialize(DATABASES); ?>
        <?php foreach($databases as $name => $info): ?>
            <li class = "nav-item"><a class = "nav-link database-backup-action-link" database = "<?= $name ?>"><?= $name ?> database</a></li>
        <?php endforeach; ?>
        <li class = "nav-item"><a class = "nav-link cancel-database-backup-action">Cancel</a></li>
        <form action = "" method = "post" id = "form-database-backup" class = "framework-form" role = "form"><?php csrf("database_backup"); request("database_backup"); ?><input type = "hidden" name = "authentication" value = "<?= password_hash(SESSION_NAME . getCSRF("database_backup") . $_SESSION["IP_address"], PASSWORD_DEFAULT); ?>"><input type = "hidden" name = "database" value = ""></form>
    </ul>


    <!-- Import database form -->
    <ul class = "navbar-nav" id = "actions-import-database" style = "display: none;">
        <li class = "nav-item"><a class = "nav-link import-database-action-link">None Selected</a></li>
        <li class = "nav-item"><a class = "nav-link cancel-import-database-action">Cancel</a></li>
        <form action = "" method = "post" id = "helper-import-database-form" class = "framework-form" enctype = "multipart/form-data">
            <?php csrf("import_database"); request("import_database"); ?>
            <input type = "hidden" name = "authentication" value = "<?= password_hash(SESSION_NAME . getCSRF("import_database") . $_SESSION["IP_address"], PASSWORD_DEFAULT); ?>">
            <input type = "file" name = "database-import" id = "helper-choose-database-import" onchange = "updateDatabaseImportFile();" accept = ".sql" style = "display: none;">
        </form>
    </ul>


    <!-- Clear database forms -->
    <ul class = "navbar-nav" id = "actions-clear-database" style = "display: none;">
        <?php $databases = unserialize(DATABASES); ?>
        <?php foreach($databases as $name => $info): ?>
            <li class = "nav-item"><a class = "nav-link clear-database-action-link" value = "<?= $name ?>">Delete <?= $name ?></a></li>
        <?php endforeach; ?>
        <li class = "nav-item"><a class = "nav-link clear-database-action-link" value = "cancel">Cancel</a></li>
        <form action = "" method = "post" id = "form-clear-database" class = "framework-form" role = "form"><?php csrf("clear_database"); request("clear_database"); ?><input type = "hidden" name = "authentication" value = "<?= password_hash(SESSION_NAME . getCSRF("clear_database") . $_SESSION["IP_address"], PASSWORD_DEFAULT); ?>"><input type = "hidden" name = "database" value = ""></form>
    </ul>


    <!-- Right side links -->
    <ul class = "navbar-nav ml-auto nav-flex-icons">
        <li class = "nav-item" id = "framework-helper-feedback"><a class = "nav-link" href = "https://jessetimonen.fi/kristal/feedback" target = "_blank">Feedback</a></li>
        <li class = "nav-item" id = "close-framework-helper">x</li>
    </ul>
</nav>