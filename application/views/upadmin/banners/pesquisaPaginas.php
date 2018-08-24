 <?php foreach ($categorias as $item) { ?>
  <tr data-codigo="<?=$item['COD_PAGINA']?>">
    <td class="hidden"><?=$item['COD_PAGINA']?></td>
    <td><a href="" class="text-primary"><?=$item['TITULO_PAGINA']?></a></td>
    <td>
    <?php 
    	echo (bool)$item['TIP_ATIVO'] == true ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>';
    ?>
    </td>
    <td class="text-right"><i style="cursor:pointer;" onclick="window.location.href='<?=base_url()?>/index.php/paginasAdmin/editar?id=<?=$item['COD_PAGINA']?>'" class="fa fa-pencil text-primary btn-editar" aria-hidden="true"></i> / <i style="cursor:pointer;" class="fa fa-trash-o text-danger btn-remover" aria-hidden="true"></i></td>
  </tr>
<?php	} ?>