<div id='form-cadastro'>
<?php
$atrib_nome = array(
              'name'        => 'nome',
              'id'          => 'nome',
               'maxlength'   => '60',
               'style'       => 'width:60%',
            );
$atrib_descricao = array(
              'name'        => 'descricao',
              'id'          => 'descricao'
            );  
			  
  
	echo validation_errors();
    if ($acao == 'Adicionar' ):
	    echo form_open(site_url().'/cadastros/TecnicasProjetivas/adicionar');
	    echo form_fieldset('Adicionar Técnica Projetiva');

		echo form_label('ID','id');
		echo form_input('id',set_value('id'), 'disabled=disabled');

		echo form_label('Nome','nome' );
		echo form_input($atrib_nome, set_value('nome'),'autofocus');

		echo form_label('Descri&ccedil;&atilde;o','descricao' );
		echo form_textarea($atrib_descricao,set_value('descricao'));

		echo form_submit('mysubmit', 'Adicionar');
    elseif ($acao == 'Alterar'):
    	echo form_open(site_url().'/cadastros/TecnicasProjetivas/gravarAlteracao');
	    echo form_fieldset("Alterar Técnica Projetiva");

		echo form_label('ID','id');
		echo form_input('cid',$dados_TecnicasProjetivas['0']->id, 'disabled=disabled');
        echo form_hidden('id',$dados_TecnicasProjetivas['0']->id);
		

		echo form_label('Nome','nome');
		echo form_input($atrib_nome,$dados_TecnicasProjetivas['0']->nome);
		
		echo form_label('Descri&ccedil;&atilde;o','descricao');
		echo form_textarea($atrib_descricao,$dados_TecnicasProjetivas['0']->descricao);

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
	        foreach($tecnicas_projetivas as $tp):

			   $link  = anchor("./cadastros/TecnicasProjetivas/excluir/".$tp->id, "[X]","onclick=\"return confirm('Confirma a exclusão desta Técnica Projetiva?')\"");
			   $link .= " - ";
			   $link .= anchor("./cadastros/TecnicasProjetivas/alterar/".$tp->id, $tp->id . '-' . $tp->nome);
			   $ul[]  = $link;

		   endforeach;
		   
   		   if (isset($ul))
		   {
		      echo ul($ul);
		    }
        endif;

?>
  <p><?php 
  if (isset($links))
      echo $links; 
   ?></p>
</div>