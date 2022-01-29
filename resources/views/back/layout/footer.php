<?php
echo '
         </div>
    </div>
    
    <!-- jQuery -->
    <script src="'.url('back/vendors/jquery/dist/jquery.min.js').'"></script>
    <!-- Bootstrap -->
    <script src="'.url('back/vendors/bootstrap/dist/js/bootstrap.min.js').'"></script>
    <!-- FastClick -->
    <script src="'.url('back/vendors/fastclick/lib/fastclick.js').'"></script>
    <!-- NProgress -->
    <script src="'.url('back/vendors/nprogress/nprogress.js').'"></script>
    
    <!-- bootstrap-progressbar -->
    <script src="'.url('back/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js').'"></script>
    <!-- iCheck -->
    <script src="'.url('back/vendors/iCheck/icheck.min.js').'"></script>
    <!-- Custom Theme Scripts -->
    <script src="'.url('back/build/js/custom.min.js').'"></script>
    
    
    <!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="'.url('back/vendors/fancybox/jquery.fancybox.pack.js?v=2.1.5').'"></script>
	<link rel="stylesheet" type="text/css" href="'.url('back/vendors/fancybox/jquery.fancybox.css?v=2.1.5').'" media="screen" />
	<script type="text/javascript" src="'.url('back/vendors/fancybox/jquery.mousewheel.pack.js').'"></script>

	<!-- multi-select-dropdown it needed on financial-management console -->
    <script type="text/javascript" src="'.url('back/vendors/multi-select-dropdown/multi-select-dropdown.js').'"></script>

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="'.url('back/vendors/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5').'" />
	<script type="text/javascript" src="'.url('back/vendors/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5').'"></script>

    
    '.$extra_links_footer.'

</body>
</html>' ;
?>

<script type="text/javascript">
    /*
     *  multi-select-dropdown it needed on financial-management console
     */
    $(function() {
        $('.multiselect-ui').multiselect({
            includeSelectAllOption: true
        });
    });
</script>

<script type="text/javascript">
     /*
     *  FanCy box
     */
    $(document).ready(function() {

        /*
         *  Simple image gallery. Uses default settings
         */

        $('.fancybox').fancybox();

        /*
         *  Different effects
         */
        /* Examples - various */
          $("#various222").fancybox({

          'padding'			: 0,
          'margin'			 : 0,
          'titlePosition'	  : 'inside',
          'transitionIn'	   : 'none',
          'transitionOut'	  : 'none',

          });

    });

    /*
     *  FanCy box Button helper. Disable animations, hide close button, change title type and content
     */
    $('.fancybox-buttons').fancybox({
        helpers : {
            title : {
                type : 'inside'
            },
            buttons	: {}
        },

        afterLoad : function() {
            this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
        }
    });
</script>

<script>
    var  buttonBtn = $('.uiuxtrick');

    // Define add class ajax loading function to use on DR click on save button show this function.
    buttonBtn.click(function(e)
    {
        $('#medical-file-form').addClass('ajax-loading');
    });
</script>
