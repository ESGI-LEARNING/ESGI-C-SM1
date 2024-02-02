#!/bin/bash

message()
{
  local type=$1
  local classType=$2
  local class=$3

  content="Le $classType $class"

  if [ "$type" = "success" ]; then
    echo -e "\e[42m\n$(printf '%*s')\n  Success: $content créé avec succès.\n$(printf '%*s\n')\e[0m"
  elif [ "$type" = "error" ]; then
    echo -e "\e[41m\n$(printf '%*s')\n  Error: $content.\n$(printf '%*s\n')\e[0m"
  fi
}

checkIfFileExists()
{
  local path=$1
  local className=$2

  if [ -f "$path" ]; then
    message "error" "Fichier" "$className existe déjà"
    exit 1
  fi
}

checkIfFolderExists()
{
  local directory=$1

  if [ ! -d "$directory" ]; then
      mkdir -p "$directory"
    fi
}

to_snake_case() {
  echo "$1" | sed -r 's/([a-z])([A-Z])/\1_\L\2/g' | tr '[:upper:]' '[:lower:]'
}