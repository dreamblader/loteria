<?php

define("valoresJogo", range(1,60));

class Game
{
    //const valoresJogo = range(1,60);
    private $dezenas;
    private $resultado;
    private $totalJogos;
    private $jogos;


    public function __construct($dezenas, $totalJogos) 
    {
        $this->setDezenas($dezenas);
        $this->setTotalJogos($totalJogos);
    }

    //Gets
    public function getDezenas()
    {
        return $this->dezenas;
    }

    public function getResultados()
    {
        return $this->resultado;
    }

    public function getTotalJogos()
    {
        return $this->totalJogos;
    }

    public function getJogos()
    {
        return $this->jogos;
    }

    //Sets
    public function setDezenas($value)
    {
        if($value >= 6 && $value<=10)
        {
            $this->dezenas = $value;
        }
    }

    public function setResultados($value)
    {
        $this->resultado = $value;
    }

    public function setTotalJogos($value)
    {
        $this->totalJogos = $value;
    }

    public function setJogos($value)
    {
        $this->jogos = $value;
    }

    //Methods
    private function dezenasArray() //retorna 01 a 60 de acordo com o especificado em $dezenas
    {
        return $this->sortArray($this->getDezenas());
    }

    private function sortArray($value) //metodo que sorteia o Array (aplicado em dezenasArray e resultArray)
    {
        $resultArray = [];
        $sorteio = valoresJogo;
        shuffle($sorteio);

        for($i=0; $i<$value;$i++)
        {
            $resultArray[] = $sorteio[$i];
        }

        sort($resultArray);

        return $resultArray;
    }

    public function selectGames()//roda todos os Jogos e adiciona seu resultado para $jogos
    {
        $resultArray = [];
        $games = $this->getTotalJogos();

        for($i=0; $i<$games;$i++)
        {
            $resultArray[] = $this->dezenasArray();
        }

        $this->setJogos($resultArray);
    }

    public function resultArray()//sorteia os 6 numeros
    {
        $this->setResultados($this->sortArray(6));
    }

    public function getHTML()//retorna tabela html
    {
        $table = $this->getJogos();
        $resultsTable = $this->getResultados();
        $colCount = $this->getDezenas();
        $gameCount = 1;

        //print table
        echo "<table>\n";

        echo "<tr>\n";
        echo "<td>Numero Jogo</td>\n";
        for($i=0;$i<$colCount;$i++)
        {
            $num = $i+1;
            echo "<td>Dezena ".$num."</td>\n";
        }
        echo "<td>Dezenas Sorteadas</td>\n";
        echo "</tr>\n";

        foreach($table as $row)
        {
            echo "<tr>\n";
            echo "<td>Jogo ".$gameCount."</td>\n";

            $matches = $this->verifyMatches($row);
            $row[] = $matches;
        
            foreach($row as $elem)
            {
                echo "<td>\n";
                echo $elem;
                echo "</td>\n";
            }

            echo "</tr>\n";
            $gameCount++;
        }

        echo "</table>\n";

        echo "<br><p>Números Resultado</p>\n";
        echo "<table><tr>\n";

        foreach($resultsTable as $r)
        {
            echo "<td>".$r."</td>\n";
        }

        echo "</tr></table>\n";

    }

    private function verifyMatches($match)// verifica quantos dos resultados batem com as dezenas sorteadas
    {
        $verifier = $this->getResultados();
        $result = 0;

        foreach($match as $n)
        {
            for($i=0;$i<6;$i++)
            {
                if($verifier[$i] == $n)
                {
                    $result++;
                }
            }
        }

        return $result;
    }
}
?>