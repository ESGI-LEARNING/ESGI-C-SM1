#!/bin/bash

configurationModels() {
  local className=$1
  local nullable=false
  local type="string"

  while true; do
      read -p "Ajouter une propriété dans votre model : " property

      # Vérifier si la propriété est non vide
      if [ -n "$property" ]; then
          read -p "Quel est le type de la propriété $property : " type

          if [ -n "$type" ]; then
              read -p "Est-ce que la propriété $property est nullable ? (y/n) " answer

              if [ "$answer" = "y" ]; then
                  nullable=true
              else
                  nullable=false
              fi

              # Appeler votre fonction addProperty avec les paramètres corrects
              addProperty "$className" "$property" "$type" "$nullable"
          fi
      fi

      # Ajouter une condition pour sortir de la boucle
      read -p "Voulez-vous ajouter une autre propriété ? (y/n) " continueAdding

      if [ "$continueAdding" != "y" ]; then
          break
      fi
  done
}

# Create Getter ans Setter
addProperty() {
  local className=$1
  local property=$2
  local type=$3
  local nullable=$4

  # Lire le contenu actuel du fichier
  local fileContent=$(<"$className")

  # Ajouter la nouvelle propriété à la suite des autres propriétés
  fileContent+="private $type \$( [ \"$nullable\" == true ] && echo \"?$type \$$property = null\" || echo \"$type \$$property\" );

public function get$property(): \$( [ \"$nullable\" == true ] && echo \"?$type\" || echo \"$type\" )
{
    return \$this->$property;
}

public function set$property(\$( [ \"$nullable\" == true ] && echo \"?$type = null\" || echo \"$type\" ) \$$property): void
{
    \$this->$property = \$$property;
}"

  # Écrire le contenu mis à jour dans le fichier
  echo -e "$fileContent" > "$className"
}


