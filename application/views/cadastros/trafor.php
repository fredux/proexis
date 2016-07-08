<div id='form-cadastro'>
<?php
$atrib_nome = array(
              'name'        => 'nome_trafor',
              'id'          => 'nome_trafor',
               'maxlength'   => '30',
               'style'       => 'width:50%',
            );
$atrib_descricao = array(
              'name'        => 'descricao_trafor',
              'id'          => 'descricao_trafor',
              'maxlength'   => '200',
            );  
			  
  
	echo validation_errors();
    if ($acao == 'Adicionar' ):
	    echo form_open(site_url().'/cadastros/Trafor/adicionar');
	    echo form_fieldset('Adicionar Trafor');

		echo form_label('ID','id');
		echo form_input('id',set_value('id'), 'disabled=disabled');

		echo form_label('Nome','nome_trafor' );
		echo form_input($atrib_nome, set_value('nome_trafor'),'autofocus');

		echo form_label('Descri&ccedil;&atilde;o','descricao' );
		echo form_textarea($atrib_descricao,set_value('descricao_trafor'));

		echo form_submit('mysubmit', 'Adicionar');
    elseif ($acao == 'Alterar'):
    	echo form_open(site_url().'/cadastros/Trafor/gravarAlteracao');
	    echo form_fieldset("Alterar Trafor");

		echo form_label('ID','id');
		echo form_input('cid',$dados_Trafor['0']->id, 'disabled=disabled');
        echo form_hidden('id',$dados_Trafor['0']->id);
		

		echo form_label('Nome','nome');
		echo form_input($atrib_nome,$dados_Trafor['0']->nome_trafor);
		
		echo form_label('Descri&ccedil;&atilde;o','descricao');
		echo form_textarea($atrib_descricao,$dados_Trafor['0']->descricao_trafor);

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
	        foreach($trafor as $t):

			   $link  = anchor("./cadastros/Trafor/excluir/".$t->id, "[X]","onclick=\"return confirm('Confirma a exclsao deste trafor?')\"");
			   $link .= " - ";
			   $link .= anchor("./cadastros/Trafor/alterar/".$t->id, $t->id . '-' . $t->nome_trafor);
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