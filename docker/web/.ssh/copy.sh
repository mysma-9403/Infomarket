#!/bin/bash
cd "${0%/*}" || exit
cp ~/.ssh/id_rsa id_rsa
cp ~/.ssh/id_rsa.pub id_rsa.pub
cp ~/.ssh/known_hosts known_hosts
