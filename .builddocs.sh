#!/bin/bash
set -o errexit -o nounset

echo "Preparing to build and deploy documentation"

if [[ -z ${GH_USER_NAME} || -z ${GH_USER_EMAIL} || -z ${GH_TOKEN} || -z ${GH_REF} ]]; then
    echo "Missing environment variables. Aborting"
    exit 1
fi;

SCRIPT_PATH="$(cd "$(dirname "$0")" && pwd -P)"

# Get curent commit revision
rev=$(git rev-parse --short HEAD)

# Initialize gh-pages checkout
mkdir -p doc/html
(
    cd doc/html
    git init
    git config user.name "${GH_USER_NAME}"
    git config user.email "${GH_USER_EMAIL}"
    git remote add upstream "https://${GH_TOKEN}@${GH_REF}"
    git fetch upstream
    git reset --hard upstream/gh-pages
)

# Build the documentation
${SCRIPT_PATH}/build.sh

# Commit and push the documentation to gh-pages
(
    cd doc/html
    touch .
    git add -A .
    git commit -m "Rebuild pages at ${rev}"
    git push -q upstream HEAD:gh-pages
)

echo "Completed deploying documentation"