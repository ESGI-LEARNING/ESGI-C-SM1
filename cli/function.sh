#!/bin/bash

message()
{
  local type=$1
  local classType=$2
  local class=$2

  content="Le $classType $class"

  if [ "$type" = "success" ]; then
    echo -e "\e[42m\n$(printf '%*s')\n  Success: $content créé avec succès.\n$(printf '%*s\n')\e[0m"
  elif [ "$type" = "error" ]; then
      echo -e "\e[41m\n$(printf '%*s')\n  Error: $content\n$(printf '%*s\n')\e[0m"
  fi
}

checkIfFolderExists()
{
  local directory=$1

  if [ ! -d "$directory" ]; then
      mkdir -p "$directory"
    fi
}