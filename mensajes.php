<?
if (issset($_SESSION['mensaje']){
	?>
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensaje</h4>
      </div>
      <div id="divMensaje" class="modal-body">
        <p><?= $_SESSION['mensaje']; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

	</div>
	</div>
	<?
	unset($_SESSION['mensaje']);
}
?>