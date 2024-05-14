<?php
      $raw = '1968.12.10';
     $start = datetime::createfromformat('Y.m.d', $raw);
        echo "Data de inicio" .$start -> format('d-m-Y'). "<br>";

    $end = clone $start;
        $end -> add (new DateInterval('P1M6D'));
         $diff = $end -> diff($start);
            echo "diferença:" .$diff -> format ('%m mês, %d dias (total: %a dias)'). "<br>";
        
     if( $start < $end){
        echo "começou antes do fim! <br>";

     }  
     //diferença: 1 mes, 6 dias .
     
     // mostra todas as quintas-feiras entre $start e $end 
     $periodInterval = DateInterval::createFromDateString('first thursday');
     $periodIterator = new DatePeriod($start, $periodInterval, $end,
     DatePeriod::EXCLUDE_START_DATE); 
     foreach($periodIterator as $date) { 

        echo $date->format('d-m-Y') . "<br>"; 

     } 


?>