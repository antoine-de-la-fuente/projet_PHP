# Projet PHP M3104


Votre équipe favorite a besoin de vous !

_L'entraîneur vous demande de réaliser une application qui l'aidera à faire les sélections des joueurs pour les matchs.  
Il souhaite pouvoir administrer la liste de ses joueurs (avec leurs noms et prénoms, une photo, leur numéro de licence, leur date de naissance, leur taille et leur poids, et leur poste préféré dans l'équipe) ainsi que celle des matchs (avec la date et l'heure, le nom de l'équipe adverse, le lieu de rencontre - domicile ou extérieur -, et le résultat qui sera saisi une fois le match terminé).  
Il souhaite également pouvoir ajouter des notes personnelles (commentaires) sur chaque joueur et préciser leur statut : Actif, Blessé, Suspendu, ou Absent.  
Avant chaque match il veut pouvoir choisir la liste des joueurs qui participeront, en précisant qui sera titulaire et qui sera remplaçant. Il ne faudra lui proposer que les joueurs actifs.  
Après chaque match, il souhaite pouvoir évaluer la performance de chaque joueur ayant participé au match ; l'évaluation peut être mise en oeuvre par un système de notation (de 1 à 5 par exemple) ou un système d'étoiles par exemple.  
Enfin, il souhaite avoir des statistiques qui l'aideront dans sa prise de décision._  
 

> Ce projet doit être réalisé en binôme.

> Vous pouvez choisir le sport d'équipe de votre choix (Football, Rugby, Basketball, Volleyball, etc.), vous ferez les adaptations nécessaires à chaque sport (nombre de titulaires par match par exemple).

> Avant de vous lancer dans le développement prenez le temps de bien réfléchir à votre application dans sa globalité. N'hésitez pas à faire des maquettes des différents écrans et posez-vous des questions d'ordre pratique (par exemple, est-ce qu'il ne serait pas intéressant de mémoriser le statut d'un match pour savoir s'il a déjà été préparé ou pas ?).

> Gardez à l'esprit que l'application devra être pratique à utiliser et accessible à des néophytes. Imaginez ce que ça ferait si vous deviez l'utiliser tous les jours !


---


### Liste des joueurs
- nom
- prénom
- photo
- numéro licence
- date de naissance
- taille
- poids
- poste préféré
- note du coach (commentaire)
- statut (actif/blessé/suspendu/absent)


### Liste des matchs
- date
- heure
- nom équipe adverse
- domicile/extérieur
- score une fois le match terminé


#### Avant chaque match
le coach choisit la liste des joueurs (feuille de match)  
qui est remplaçant, qui est tituaire  
proposer uniquement les joueurs actifs  


#### Après chaque match
le coach évalue chaque joueur avec une note sur 5 (slider)


### Statistiques joueur
__dernier match / 5 derniers matchs / total__  
__domicile / exiérieur__  

- temps de jeu
- buts marqués
- tirs arrêtés (si gardien)
- buts encaissés (si gardien)
- nb tirs, tirs cadrés
- % passes réussies
- ratio nb tirs/temps de jeu
- cartons
- ratio cartons/temps de jeu


### Statistiques équipe (matchs)
__dernier match / 5 derniers matchs / total__  
__domicile / exiérieur__  

- nb victoires/nul/défaite
- meilleur buteur
- buts marqués
- buts encaissés
- nb tirs, tirs cadrés
- % passes réussies
- cartons
- ratio cartons/temps de jeu
