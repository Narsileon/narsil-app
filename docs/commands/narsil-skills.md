# Narsil Skills

Check and fix Narsil App PHP files from the `narsil-app` DDEV container.

## Check

Check PHP files with the Narsil Skills check pipeline:

```sh
ddev exec -d /var/www/html vendor/narsil/skills/scripts/php/check /var/www/html
```

## Fix

Apply the Narsil Skills fix pipeline and format PHP files:

```sh
ddev exec -d /var/www/html vendor/narsil/skills/scripts/php/fix /var/www/html
```
