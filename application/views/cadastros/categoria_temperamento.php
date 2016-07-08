<div id='form-cadastro'>
<?php
$atrib_homeostatico = array(
              'name'        => 'homeostatico',
              'id'          => 'homeostatico',
               'maxlength'   => '30',
               'style'       => 'width:50%',
            );
$atrib_nosografico = array(
              'name'        => 'nosografico',
              'id'          => 'nosografico',
               'maxlength'   => '30',
               'style'       => 'width:50%',
            );
			
$atrib_obs = array(
              'name'        => 'obs',
              'id'          => 'obs',
              'maxlength'   => '200',
            );  
			  
  
	echo validation_errors();
    if ($acao == 'Adicionar' ):
	    echo form_open(site_url().'/cadastros/CategoriaTemperamento/adicionar');
	    echo form_fieldset('Adicionar Categoria do Temperamento');

		echo form_label('ID','id');
		echo form_input('id',set_value('id'), 'disabled=disabled');

		echo form_label('Homeostático','homeostatico' );
		echo form_input($atrib_homeostatico, set_value('homeostatico'),'autofocus');

		echo form_label('Nosográfico','nosografico' );
		echo form_input($atrib_nosografico,set_value('nosografico'));

		
		echo form_label('obs','Obs' );
		echo form_textarea($atrib_obs,set_value('obs'));

		echo form_submit('mysubmit', 'Adicionar');
    elseif ($acao == 'Alterar'):
    	echo form_open(site_url().'/cadastros/CategoriaTemperamento/gravarAlteracao');
	    echo form_fieldset("Alterar Trafor");

		echo form_label('ID','id');
		echo form_input('cid',$dados_CategoriaTemperamento['0']->id, 'disabled=disabled');
        echo form_hidden('id',$dados_CategoriaTemperamento['0']->id);
		
		echo form_label('Homeostático','homeostatico' );
		echo form_input($atrib_homeostatico,$dados_CategoriaTemperamento['0']->homeostatico);
		
		echo form_label('nosografico','Nosográfico');
		echo form_input($atrib_nosografico,$dados_CategoriaTemperamento['0']->nosografico);

		echo form_label('Obs','obs');
		echo form_textarea($atrib_obs,$dados_CategoriaTemperamento['0']->obs);

		echo form_submit('mysubmit', 'Salvar');
		echo form_reset('myreset', 'Cancelar' );
    endif;
     echo form_fieldset_close();
    echo form_close();

?>

</div>
	<div id='lista-geral'>
	<?php
	    if ($acao == 'Adicionar'):
	        foreach($categoria_temperamento as $ct):

			   $link  = anchor("./cadastros/CategoriaTemperamento/excluir/".$ct->id, "[X]","onclick=\"return confirm('Confirma a exclsao desta Categoria do Temperamento?')\"");
			   $link .= " - ";
			   $link .= anchor("./cadastros/CategoriaTemperamento/alterar/".$ct->id, $ct->id . '-' . $ct->homeostatico . ' X ' . $ct->nosografico);
			   $ul[]  = $link;

		   endforeach;
		   
   		   if (isset($ul))
		   {
		      echo ul($ul);
		    }
        endif;

?>
</div>