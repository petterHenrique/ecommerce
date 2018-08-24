 <?php foreach ($categorias as $item) { ?>
  <tr data-codigo="<?=$item['COD_CATEGORIA']?>">
    <td class="hidden"><?=$item['COD_CATEGORIA']?></td>
    <td><a href="" class="text-primary"><?=$item['NOME_CATEGORIA']?></a></td>
    <td>
    <?php 
    	echo (bool)$item['TIP_ATIVO'] == true ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>';
    ?>
    </td>
    <td class="text-right"><i style="cursor:pointer;"  class="fa fa-pencil text-primary btn-editar" aria-hidden="true"></i> / <i style="cursor:pointer;" class="fa fa-trash-o text-danger btn-remover" aria-hidden="true"></i></td>
  </tr>
<?php	} ?>