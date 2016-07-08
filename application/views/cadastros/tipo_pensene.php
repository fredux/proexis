<div id='form-cadastro'>
<?php
	echo validation_errors();
    if ($acao == 'Adicionar' ):
	    echo form_open(site_url().'/cadastros/TipoPensene/adicionar');
	    echo form_fieldset("Adicionar Tipo de Pensene");

		echo form_label('Tipo de Pensene','pensene_tipo');
		echo form_input('pensene_tipo',set_value('pensene_tipo'),'autofocus');

		echo form_label('Descri&ccedil;&atilde;o','descricao_tipo');
		echo form_textarea('descricao_tipo',set_value('descricao_tipo'));

		echo form_submit('mysubmit', 'Adicionar');
    elseif ($acao == 'Alterar'):
    	echo form_open(site_url().'/cadastros/TipoPensene/gravarAlteracao');

	    echo form_fieldset("Alterar Tipo de Pensene");
        echo form_hidden('id',$dados_TipoPensene['0']->id);

		echo form_label('Tipo de Pensene','pensene_tipo');
		echo form_input('pensene_tipo',$dados_TipoPensene['0']->pensene_tipo);

		echo form_label('Descri&ccedil;&atilde;o','descricao_tipo');
		echo form_textarea('descricao_tipo',$dados_TipoPensene['0']->descricao_tipo);

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
	        foreach($tipo_pensene as $tipo):

			   $link  = anchor("./cadastros/TipoPensene/excluir/".$tipo->id, "[X]","onclick=\"return confirm('Confirma a exclsao deste tipo de pnesene?')\"");
			   $link .= " - ";
			   $link .= anchor("./cadastros/TipoPensene/alterar/".$tipo->id, $tipo->id . '-' . $tipo->pensene_tipo);
			   $ul[]  = $link;

		   endforeach;
   		   if (isset($ul))
		   {
		      echo ul($ul);
		    }
        endif;

?>
</div>