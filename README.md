# EVE AUDIT APP

Ce projet est une application web faite pour l'entreprise EVE - Expertise Végane Europe et remise à jour afin de la présenter de façon à anonymiser les données privées.
Elle permet à des utilisateurs externes de faire des rapports suites à des audits et de les gérer ensuite.

<hr>

Comment installer

Pour installer l'application, il vous faut télécharger le projet et le dézipper dans le dossier publique de votre serveur (www pour WAMP)
L'application a été développée sous `MySQL 5.7, Apache2 et PHP 7.4`
Créez une base de données appelée `audit` et importez la base de donnée via le fichier en .sql

Insérez les données de connexion dans la ligne 11 du fichier `models/Connexion.php`

L'utilisateur de base (admin) peut se connecter avec l'identifiant `admin` et le mot de passe `mdp` (d'après la base de données fournie), vous pouvez bien sûr en créer d'autres.
