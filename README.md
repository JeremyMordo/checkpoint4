Checkpoint 4 : Portefolio perso

Backlog : https://i.ibb.co/vXPwjZF/backlog.png

Wireframe : https://i.ibb.co/z4Pj4Mx/wireframe.png

BDD : https://i.ibb.co/BBWSRGF/bdd.png

Afin de tester l'application, suis-les étapes suivantes :

1) clone le projet sur ton IDE préféré : https://github.com/JeremyMordo/checkpoint4.git
2) composer Install
3) composer require symfony/google-mailer, l'email de réception est privée => ça marche ! (https://i.ibb.co/R6VQfnT/email.png)
4) php bin/console d:s:u --force
5) php bin/console d:f:l
6) Enjoy !

L'application permet de : 
  - Avoir un lien vers mon github / linkedin / canva (CV)
  - Voir mon parcours / mes objectifs / mes compétences
  - Voir les avis des gens qui ont travailler avec moi
  - En tant qu'utilisateur, s'enregistrer et se connecter pour déposer/modifier/supprimer un avis
  - En tant qu'utilisateur, prendre contact avec moi par email
  - En tant qu'admin, de voir le nombre d'avis edepuis la création du site et un calcul est fait pour les cinq dernières années
  - En tant qu'admin, de supprimer un utilisateur indésirable
