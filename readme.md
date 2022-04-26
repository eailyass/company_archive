# Mini-app archive entreprise:
Cette application vise à simuler un système d'archivage d'entreprises avec leurs adresses.

## Setup:

* Pour lancer le projet: ``` docker-compose up -d ```
* Lors de la première execution lancer:
    * 1-  ``` docker-compose exec php bash```
    * 2- ``` php bin/console fixtures:load```
    * 3- ``` npm install ```
    * 4- ``` docker-compose run node npm run build ```

## Démarche:

- Utilisation de l'event subscriber doctrine sur les evenements postUpdate et postPersist pour detecter toute création/modification d'une entreprise/adresse.
- Enregistrement d'un snapshot json de l'entreprise lors de la modification dans une table spécifique avec horodatage.
- retrait de la version qui correspond à la date spécifiée par l'utilisateur sinon, la date la plus proche avant la date spécifiée.