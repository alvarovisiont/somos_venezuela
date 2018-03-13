 </div>			
			</div><!-- /.main-content -->

<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Sistemaweb21</span>
							Sistema &copy; 2018-2019
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<script src="<?= base_url('assets_sistema/js/jquery-2.1.4.min.js') ?>"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) 
				document.write("<script src='<?= base_url('assets_sistema/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
		</script>
		<script src="<?= base_url('assets_sistema/js/bootstrap.min.js') ?>"></script>

		<script src="<?= base_url('assets_sistema/js/chosen.jquery.min.js') ?>"></script>

		<!-- page specific plugin scripts -->
		  <script src="<?= base_url('assets_sistema/js/jquery.colorbox.min.js') ?>"></script>

		<!-- ace scripts -->
		<script src="<?= base_url('assets_sistema/js/ace-elements.min.js') ?>"></script>
		<script src="<?= base_url('assets_sistema/js/ace.min.js') ?>"></script>
		<!-- ace settings handler -->
		<script src="<?php echo base_url()?>assets_sistema/js/ace-extra.min.js"></script>
		<script src="<?php echo base_url()?>assets_sistema/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url()?>assets_sistema/js/jquery.dataTables.bootstrap.min.js"></script>

		<!-- inline scripts related to this page -->

<!-- page specific plugin scripts -->
      
	
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				var $overflow = '';
				var colorbox_params = {
					rel: 'colorbox',
					reposition:true,
					scalePhotos:true,
					scrolling:false,
					previous:'<i class="ace-icon fa fa-arrow-left"></i>',
					next:'<i class="ace-icon fa fa-arrow-right"></i>',
					close:'&times;',
					current:'{current} of {total}',
					maxWidth:'100%',
					maxHeight:'100%',
					onOpen:function(){
						$overflow = document.body.style.overflow;
						document.body.style.overflow = 'hidden';
					},
					onClosed:function(){
						document.body.style.overflow = $overflow;
					},
					onComplete:function(){
						$.colorbox.resize();
					}
				};

				$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
				$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
	
	
				$(document).one('ajaxloadstart.page', function(e) {
					$('#colorbox, #cboxOverlay').remove();
			   });

				$('#tabla').dataTable({
					"order": []
				})

    			$('[data-tool="tooltip"]').tooltip();



    				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
				}
		})
		</script>
	</body>
</html>


	
