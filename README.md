# Billetterie pour le Musée du Louvre

***Projet 4 du parcours Chef de Projet Multimédia - Développement Openclassrooms.***

*Le musée du Louvre vous a missionné pour un projet ambitieux : créer un nouveau système de réservation et de gestion des tickets en ligne pour diminuer les longues files d’attente et tirer parti de l’usage croissant des smartphones.*

**Technologies utilisées :**

 - **Symfony 3.4** (https://symfony.com)
 - **JQuery** (https://jquery.com) (Scripts personnalisés)
 - [**Bootsrap**](https://getbootstrap.com) (Design Front/Back/Responsive)
 - **[Stripe](https://stripe.com/fr)** (Application de paiement en ligne)
 - HTML / CSS (Architecture du site / Design personnel )

![enter image description here](https://cdn.discordapp.com/attachments/395859711825805317/606131927208165376/3d4016601f.png)

# Développez un back-end pour un client

[**Lien du projet**](https://openclassrooms.com/fr/projects/35/assignment) - [**Site du projet**](https://louvre.omen-design.com)

**Compétences à valider :**
![compétences](https://cdn.discordapp.com/attachments/395859711825805317/606129890130919445/unknown.png)

## Cours associés

![enter image description here](https://cdn.discordapp.com/attachments/395859711825805317/606139159685627944/unknown.png)

## **Consignes du projet :**

 
L’interface doit être accessible aussi bien sur ordinateur de bureau que tablettes et smartphones, et utiliser pour cela un design responsive.

L’interface doit être fonctionnelle, claire et rapide avant tout. Le client ne souhaite pas surcharger le site d’informations peu utiles : l’objectif est de permettre aux visiteurs d’acheter un billet rapidement.

Il existe 2 types de billets : le billet « Journée » et le billet « Demi-journée » (il ne permet de rentrer qu’à partir de 14h00). Le musée est ouvert tous les jours sauf le mardi (et fermé les 1er mai, 1er novembre et 25 décembre).

Le musée propose plusieurs types de tarifs :

-   Un tarif « normal » à partir de 12 ans à 16 €
    
-   Un tarif « enfant » à partir de 4 ans et jusqu’à 12 ans, à 8 € (l’entrée est gratuite pour les enfants de moins de 4 ans)
    
-   Un tarif « senior » à partir de 60 ans pour 12 €
    
-   Un tarif « réduit » de 10 € accordé dans certaines conditions (étudiant, employé du musée, d’un service du Ministère de la Culture, militaire…)
    

Pour commander, on doit sélectionner :

-   Le jour de la visite
    
-   Le type de billet (Journée, Demi-journée…). On peut commander un billet pour le jour même mais on ne peut plus commander de billet « Journée » une fois 14h00 passées.
    
-   Le nombre de billets souhaités
    

Le client précise qu’il n’est pas possible de réserver pour les jours passés (!), les dimanches, les jours fériés et les jours où plus de 1000 billets ont été vendus en tout pour ne pas dépasser la capacité du musée.

Pour chaque billet, l’utilisateur doit indiquer son nom, son prénom, son pays et sa date de naissance. Elle déterminera le tarif du billet.

Si la personne dispose du tarif réduit, elle doit simplement cocher la case « Tarif réduit ». Le site doit indiquer qu’il sera nécessaire de présenter sa carte d’étudiant, militaire ou équivalent lors de l’entrée pour prouver qu’on bénéficie bien du tarif réduit.

Le site récupèrera par ailleurs l’e-mail du visiteur afin de lui envoyer les billets. Il ne nécessitera pas de créer un compte pour commander.

Le visiteur doit pouvoir payer avec la solution **Stripe** par carte bancaire.

Le site doit gérer le retour du paiement. En cas d’erreur, il invite à recommencer l’opération. Si tout s’est bien passé, la commande est enregistrée et les billets sont envoyés au visiteur.

Vous utiliserez les environnements de test fournis par Stripe pour simuler la transaction, afin de ne pas avoir besoin de rentrer votre propre carte bleue.

> **La création d'un back-office pour lister les clients et commandes n'est pas demandée. Seule l'interface client est nécessaire ici.**

### Le billet

Un email de confirmation sera envoyé à l’utilisateur et fera foi de billet.

Le mail doit indiquer:

-   Le nom et le logo du musée
    
-   La date de la réservation
    
-   Le tarif
    
-   Le nom de chaque visiteur
    
-   Le code de la réservation (un ensemble de lettres et de chiffres)



## Architecture du projet

![enter image description here](https://cdn.discordapp.com/attachments/395859711825805317/606137701477122093/6acebe2612.png)
