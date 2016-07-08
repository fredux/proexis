<div id='form-cadastro'>
<?php
	echo validation_errors();
    if ($acao == 'Adicionar' ):
	    echo form_open(site_url().'/cadastros/Trafar/adicionar');
	    echo form_fieldset('Adicionar Trafar');

		echo form_label('ID','id');
		echo form_input('id',set_value('id'), 'disabled=disabled');

		echo form_label('Nome','nome_trafar' );
		echo form_input('nome_trafar',set_value('nome_trafar'),'autofocus');

		echo form_label('Descri&ccedil;&atilde;o','descricao' );
		echo form_textarea('descricao_trafar',set_value('descricao_trafar'));

		echo form_submit('mysubmit', 'Adicionar');
    elseif ($acao == 'Alterar'):
    	echo form_open(site_url().'/cadastros/Trafar/gravarAlteracao');
	    echo form_fieldset("Alterar Trafar");

		echo form_label('ID','id');
		echo form_input('cid',$dados_Trafar['0']->id, 'disabled=disabled');
        echo form_hidden('id',$dados_Trafar['0']->id);
		

		echo form_label('Nome','nome');
		echo form_input('nome_trafar',$dados_Trafar['0']->nome_trafar);
		
		echo form_label('Descri&ccedil;&atilde;o','descricao');
		echo form_textarea('descricao_trafar',$dados_Trafar['0']->descricao_trafar);

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
	        foreach($trafar as $t):

			   $link  = anchor("./cadastros/Trafar/excluir/".$t->id, "[X]","onclick=\"return confirm('Confirma a exclsao deste trafar?')\"");
			   $link .= " - ";
			   $link .= anchor("./cadastros/Trafar/alterar/".$t->id, $t->id . '-' . $t->nome_trafar);
			   $ul[]  = $link;

		   endforeach;
		   
   		   if (isset($ul))
		   {
		      echo ul($ul);
		    }
        endif;

?>
</div>