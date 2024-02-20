#!/bin/bash
source cli/function.sh
source cli/modules/models.sh

#Template for controller
templateController() {
  local controllerNane=$1
  checkIfFileExists "src/Controllers/$controllerNane.php" "$controllerNane"

  echo "<?php

namespace App\Controllers;

class $controllerNane
{
    //
}" > "src/Controllers/$controllerNane.php"

  #Message
  message "success" "Controller" "$controllerNane"
}

#Template for model
templateModel()
{
  local modelName=$1
  checkIfFolderExists "src/Models"
  checkIfFileExists "src/Models/$modelName.php" $modelName

  echo "<?php

namespace App\Models;

use Core\DB\Model;

class $modelName extends Model
{
   protected ?int \$id = null;

    public function getId(): ?int
    {
        return \$this->id;
    }

    public function setId(?int \$id): void
    {
        \$this->id = \$id;
    }

}" > "src/Models/$modelName.php"

  templateRepository $modelName"Repository"

  message "success" "Models" "$modelName"
}

# Template for repositories
templateForm()
{
  local formType=$1
  checkIfFolderExists "src/Form"
  checkIfFileExists "src/Form/$modelName.php" "$formType"

  echo "<?php

namespace App\Form;

use Core\Form\FormType;

class $formType extends FormType
{
    public function setConfig(): void
    {
        \$this->config = [];
    }

    public function rules(): array
    {
        return [
             //
        ];
    }

}" > "src/Form/$formType.php"

  message "Form" "success" $formType
}

# Migration
migration()
{
  local migrationName=$1
  checkIfFolderExists "database/migrations"
  checkIfFileExists "database/migrations/$(date +%Y%m%d%H%M%S)_$(to_snake_case $migrationName).php" "$migrationName"

  echo "<?php

use Core\DB\BaseMigration;

class $migrationName extends BaseMigration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up(): void
    {
        \$sql = \"\";

        \$this->execute(\$sql);
    }
}" > "src/Migrations/$(date +%Y%m%d%H%M%S)_$(to_snake_case $migrationName).php"

  message "success" "Migration" "$(to_snake_case $migrationName)"
}

# Mail
templateMail()
{
  local mailname=$1
  checkIfFolderExists "src/Mails"
  checkIfFileExists "src/Mails/$mailname.php" "$mailname"

  echo "<?php

namespace App\Mails;

use Core\Mailer\Mailer;

class $mailname
{
  //
}" > "src/Mails/$mailname.php"

message "success" "Mails" $mailname
}

# middleware
templateMiddleware()
{
  local middlewareName=$1
  checkIfFolderExists "src/Middlewares"
  checkIfFileExists "src/Middlewares/$middlewareName.php" "$middlewareName"

  echo "<?php

namespace App\Middlewares;

use Core\Middleware\BaseMiddleware;

class $middlewareName extends BaseMiddleware
{

  public function __invoke(): void
  {
    //
  }

}" > "src/Middlewares/$middlewareName.php"

message "success" "Middlewares" $middlewareName
}

