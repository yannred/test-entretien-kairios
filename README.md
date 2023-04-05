# Projet d'intégration Kairios

## Présentation
Vous trouverez dans ce dépôt le code source concernant une application Symfony et Vue qui viendra décrire une interface Web simpliste détaillant deux entités à savoir le `Dépot` et la `Reponse`.

## Installation
Le projet est configuré pour fonctionner sous un environnement Docker. Il suffit donc de lancer les commandes suivantes pour lancer les containers :
```bash
docker-compose up -d
```

Connectez vous ensuite au container de l'application et installer les `node_modules`. Une fois cette opération faite il vous reste plus qu'a compiler
le front de l'application (en mode dev ou prod selon vos besoins).

L'application sera donc accessible à l'adresse suivante : [http://localhost](http://localhost)

## Lancement des tests unitaires
Pour lancer les tests unitaires, il suffit de lancer la commande suivante :
```bash
docker-compose exec application php vendor/atoum/atoum/bin/atoum -d tests/units
```

## Se connecter en bash au container
Pour se connecter en bash au container, il suffit de lancer la commande suivante :
```bash
docker-compose exec application bash
```

## Lancer le mode watch pour le front
Pour lancer le mode watch pour le front, il suffit de lancer la commande suivante :
```bash
docker-compose exec application npm run watch
```

## Convention de commit
Le projet exige une norme de commit afin de faciliter la lecture de ces derniers. Il vient respecter le format suivant :

`<type>(<scope>): <subject>`
`<BLANK LINE>`
`<body>`

Par exemple :
```
feat(README): Ajout d'une section sur les tests unitaires

Ajout d'une section sur les tests unitaires dans le README
```

```
fix(demande clinique): Correction d'un bug sur la création d'une demande clinique

Un bug était présent sur la création d'une demande clinique. Il concernait la prise en compte du paramètre optionnel comme étant requis.
```
