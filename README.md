# PDFS Dormitory service (backend)

## Start with [DDEV](https://ddev.readthedocs.io/en/latest/users/install/ddev-installation/)

1. Install the DDEV
2. Execute the commands bellow:
- `ddev start`
- `ddev composer install`
- `ddev artisan key:generate`
3. Import the database dump or generate test data:
- `ddev import-db --file 'pathToTheDBdump'`
- `ddev artisan db:seed`



