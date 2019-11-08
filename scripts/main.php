<?php

    require 'game.php';

    //variáveis customizaveis
    $dezenas = 6; //escolha suas dezenas (caso não estiver entre 06 e 10 a função não ira salva-la)
    $matches = 10; //escolha o numero de jogos que serão feitos

    $game = new Game($dezenas,$matches);
    //execute all methods that fill the object with results
    $game->selectGames();
    $game->resultArray();
    //print HTML table
    $game->getHTML();


?>