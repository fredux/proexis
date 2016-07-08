<div id='form-cadastro'>
<?php
	echo validation_errors();
    if ($acao == 'Adicionar' ):
	    echo form_open(site_url().'/cadastros/FenomenosParapsiquicos/adicionar');
	    echo form_fieldset('Adicionar Fenômenos Parapsíquicos');

		echo form_label('ID','id');
		echo form_input('id',set_value('id'), 'disabled=disabled');

		echo form_label('Nome','nome' );
		echo form_input('nome',set_value('nome'),'autofocus');

		echo form_label('Descri&ccedil;&atilde;o','descricao' );
		echo form_textarea('descricao',set_value('descricao'));

		echo form_submit('mysubmit', 'Adicionar');
    elseif ($acao == 'Alterar'):
    	echo form_open(site_url().'/cadastros/FenomenosParapsiquicos/gravarAlteracao');
	    echo form_fieldset("Alterar Fenômenos Parapsíquicos");

		echo form_label('ID','id');
		echo form_input('cid',$dados_FenomenosParapsiquicos['0']->id, 'disabled=disabled');
        echo form_hidden('id',$dados_FenomenosParapsiquicos['0']->id);
		

		echo form_label('Nome','nome');
		echo form_input('nome',$dados_FenomenosParapsiquicos['0']->nome);
		
		echo form_label('Descri&ccedil;&atilde;o','descricao');
		echo form_textarea('descricao',$dados_FenomenosParapsiquicos['0']->descricao);

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
		foreach($fenomenos_parapsiquicos as $fenomeno):

  	        $link  = anchor("./cadastros/FenomenosParapsiquicos/excluir/".$fenomeno->id, "[X]","onclick=\"return confirm('Confirma a exclsao deste Fenômeno parapsíquico?')\"");
			 $link .= " - ";
			 $link .= anchor("./cadastros/FenomenosParapsiquicos/alterar/".$fenomeno->id, $fenomeno->id . '-' . $fenomeno->descricao);
			 $ul[]  = $link;

		 endforeach;
		   
   		 if (isset($ul))
		     echo ul($ul);

      endif;
?>
</div>