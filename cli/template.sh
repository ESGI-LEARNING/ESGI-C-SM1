#!/bin/bash
source cli/function.sh
source cli/modules/models.sh

#Template for controller
templateController() {
  local controllerNane=$1

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

  echo "<?php

namespace App\Models;

use App\core\DB\DB;

class $modelName extends DB
{
   private ?int \$id = null;

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
templateRepository()
{
  local modelName=$1
  checkIfFolderExists "src/Repository"

  echo "<?php

  namespace App\Repository;

  class $modelName
  {

  }" > "src/Repository/$modelName.php"
}

# Template for repositories
templateForm()
{
  local formType=$1
  checkIfFolderExists "src/Form"

  echo "<?php

  namespace App\Form;

  class $formType
  {
      public function getConfig(): array
      {
          return [];
      }

  }" > "src/Form/$formType.php"

  message "Form" $formType
}
