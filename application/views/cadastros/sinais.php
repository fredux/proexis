<div id='form-cadastro'>
<?php
	$options = array(
	        'SOMA'        => 'SOMA',
	        'ENERGOSSOMA' => 'ENERGOSSOMA',
	        'PSICOSSOMA'  => 'PSICOSSOMA',
	        'MANTALSOMA'  => 'MENTALSOMA',
	        'EXTRAFÍSICO' => 'EXTRAFÍSICO',

	);
	echo validation_errors();
    if ($acao == 'Adicionar' ):
	    echo form_open(site_url().'/cadastros/Sinais/adicionar');
	    echo form_fieldset('Adicionar Sinais');

		echo form_label('ID','id');
		echo form_input('id',set_value('id'), 'disabled=disabled');

		echo form_label('Variável','tipo_sianais');
        echo form_dropdown('tipo_sinais', $options, 'SOMA');

		echo form_label('Descri&ccedil;&atilde;o','descricao_sinais' );
		echo form_textarea('descricao_sinais',set_value('descricao_sinais'));

		echo form_submit('mysubmit', 'Adicionar');
    elseif ($acao == 'Alterar'):
    	echo form_open(site_url().'/cadastros/Sinais/gravarAlteracao');
	    echo form_fieldset("Alterar Sinais");

		echo form_label('ID','id');
		echo form_input('cid',$dados_Sinais['0']->id, 'disabled=disabled');
        echo form_hidden('id',$dados_Sinais['0']->id);

		echo form_label('Variável','tipo_sianais');
        echo form_dropdown('tipo_sinais', $options,  $dados_Sinais['0']->tipo_sinais);


		echo form_label('Descri&ccedil;&atilde;o','descricao_sinais');
		echo form_textarea('descricao_sinais',$dados_Sinais['0']->descricao_sinais);

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
	        foreach($sinais as $inal):

			   $link  = anchor("./cadastros/Sinais/excluir/".$inal->id, "[X]","onclick=\"return confirm('Confirma a exclsao deste sinal?')\"");
			   $link .= " - ";
			   $link .= anchor("./cadastros/Sinais/alterar/".$inal->id, $inal->descricao_sinais . '-' . $inal->tipo_sinais);
			   $ul[]  = $link;

		   endforeach;

   		   if (isset($ul))
		   {
		      echo ul($ul);
		    }
        endif;

?>
</div>