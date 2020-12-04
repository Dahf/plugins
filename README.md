# Introduction
This is basically a team project by 4 students in class for computer science.
# Getting Started
go on http://silasbeckmann.de
# Bugs and Problems
Liste von Bugs:

Bug1: Problem erklären, Klasse und Zeile darin nennen, evtl. Lösung nennen
Bug2: Registrier-Bug, Seite hat Schaganfall / Fixed
# TODO
index.html

DEFINITION OF DONE: Wenn man seine Aufgabe (vorerst) als erledigt erachtet und das Produkt negativ auf Fehler überprüft wurde.

# MYSQL
CREATE TABLE plugins(id int AUTO_INCREMENT NOT NULL, TITEL varchar(255), DESCRIPTION varchar(255), CREATED_BY varchar(255), PICTURE varchar(255), PRICING varchar(255), CATEGORY varchar(255), PRIMARY KEY(id)) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE accounts(id int AUTO_INCREMENT NOT NULL, USERNAME varchar(255), PASSWORD varchar(255), EMAIL varchar(255), SERVERRANK varchar(255), PRIMARY KEY(id)) ENGINE=INNODB DEFAULT CHARSET=utf8;
