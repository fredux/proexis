<?php

    
//	echo "<a href='" . base_url() . "'>HOME</a>";
//	echo br();

    
	    echo "<div id='menu-administracao'>";
    
        if ($admin == TRUE): 
		echo heading('Cadastros',3, 'id="menu-cabecalho"');
	
		$lista[] = "<a href='" . site_url() . "cadastros/TipoPensene'>Tipo de Pensene</a>";
		$lista[] = "<a href='" . site_url() . "cadastros/Trafor'>Trafor</a>";
		$lista[] = "<a href='" . site_url() . "cadastros/Trafar'>Trafar</a>";
		$lista[] = "<a href='" . site_url() . "cadastros/CategoriaTemperamento'>Categoria do Temperamento</a>";
		$lista[] = "<a href='" . site_url() . "cadastros/FenomenosParapsiquicos'>Fenômenos Parapsíquicos</a>";
		$lista[] = "<a href='" . site_url() . "cadastros/Sinais'>Sinais</a>";
		$lista[] = "<a href='" . site_url() . "cadastros/TecnicasProjetivas'>Técnicas Projetivas</a>";
	endif;
    $lista[] = "<a href='" . site_url() . "/Home/logout'>Sair</a>";
	
	//echo ul($lista, $atributos);
	echo ul($lista);

    echo "</div>";
	
    echo "<div id='menu-direita'>";
	echo heading('Dicas',3, 'id="menu-cabecalho"');
	$lista1[] = "Ajuda";
    echo ul($lista1);

    echo "</div>";
