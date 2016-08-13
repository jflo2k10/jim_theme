<?php

	wp_enqueue_style( 'jqueryui-css', 'https://code.jquery.com/ui/1.10.4/themes/flick/jquery-ui.css', array(), '', 'all');
	wp_enqueue_style( 'budget-css', get_stylesheet_directory_uri() . '/css/budget-styles.css', array('jqueryui-css'), '', 'all');
	wp_enqueue_script( 'jquery-ui' , 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'budget-js' , '/wp-content/themes/insivia2015_child_theme/js/budget-scripts.js', array('bootstrap', 'jquery-ui'), '', true );

?>

<div class="container">
	<div class="row">
		<div class="col-md-8">

			<div class="container-fluid calc-fields">
				<div class="row">
					<div class="col-md-6">
						
						<span class="input input--jiro">
							<input class="input__field input__field--jiro" type="text" id="calc-revenue" data-map="rev" />
							<label class="input__label input__label--jiro" for="input-1">
								<span class="input__label-content input__label-content--jiro">Last Year's Revenue</span>
							</label>
						</span>
								
					</div>
					<div class="col-md-6">
						
						<select id="cd-dropdown" class="cd-select" data-map="ind">
							<option value="-1" selected>Select Your Industry</option>
							<option value="1">Professional Services</option>
							<option value="2">Manufacturing</option>
							<option value="3">Consumer Products</option>
							<option value="4">Software</option>
							<option value="5">Real Estate</option>
						</select>
								
					</div>
				</div>
				
				<div class="row">
					<div class="slider-container">
						<div class="col-md-10 col-md-offset-1">
							<h3>We are looking to market our business:</h3>
							<div id="reach" class="circles-slider"></div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="checkbox-container">
						<div class="col-md-2">
							<input type="checkbox" id="checkbox-7-1" data-map="exp" checked="true" /><label for="checkbox-7-1"><span>Yes</span></label>
						</div>
						<div class="col-md-10">
							<p>Our company is <strong>looking to expand</strong> into new regions, states or countries.</p>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="checkbox-container">
						<div class="col-md-2">
							<input type="checkbox" id="checkbox-7-2" data-map="fir" /><label for="checkbox-7-2"><span>Yes</span></label>
						</div>
						<div class="col-md-10">
							<p>My product / service is a <strong>first mover or not very well known</strong>.</p>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="slider-container">
						<div class="col-md-10 col-md-offset-1">
							<h3>How aggresively do you want to be in going after market share &amp; driving leads?</h3>
							<div id="agressive" class="circles-slider"></div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="checkbox-container">
						<div class="col-md-2">
							<input type="checkbox" id="checkbox-9-1" data-map="web" checked /><label for="checkbox-9-1"></label>
						</div>
						<div class="col-md-10">
							<p>Has your website been updated in the last 4 years?</p>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
		<div class="budget-sidebar col-md-4">
			
			<div class="budget-summary">
				<div class="budget-title">Recommended Budget</div>
				<div id="total" class="budget">___</div>
				<div class="budget-text">Budget is not a cut and dry situation depends on a lot of factors, but here is an exercise to help you.</div>
			</div>
			
			<div class="budget-detail">
				
				<div class="budget-gate">
					<h3>Get Even More Detail</h3>
					<p>See breakdowns by channel, payroll recommendations and formula details.</p>
					<form method="post" enctype="multipart/form-data" id="gform_17" action="/thankyou">
					<p>
						<input type="hidden" class="gform_hidden" name="is_submit_17" value="1">
			            <input type="hidden" class="gform_hidden" name="gform_submit" value="17">
			            
			            <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
			            <input type="hidden" class="gform_hidden" name="state_17" value="WyJbXSIsImY5M2YyNmU5MjEzOGUyOTU1MTQ2YWUwMzQ0MDZiYTdmIl0=">
			            <input type="hidden" class="gform_hidden" name="gform_target_page_number_17" id="gform_target_page_number_17" value="0">
			            <input type="hidden" class="gform_hidden" name="gform_source_page_number_17" id="gform_source_page_number_17" value="1">
			            <input type="hidden" name="gform_field_values" value="">
			            <input name="input_1" id="input_17_1" type="text" value="" class="medium" placeholder="Enter Your E-Mail" tabindex="1">
						<input type="submit" class="btn smaller" value="Send My Detailed Report" onclick="if(window[&quot;gf_submitting_17&quot;]){return false;}  window[&quot;gf_submitting_17&quot;]=true;  " />
					</p>
					</form>
				</div>
				
			</div>
				
			<div class="planbold-ad">
				<h3>Check Out PlanBold</h3>
				<p>You need a plan and we make it easy to have one.  PlanBold is a marketing strategy builder and management tool.</p>
				<p><a href="http://www.planbold.com" target="_blank" class="btn-white smaller">Start A Free Trial</a></p>
			</div>
			
		</div>
	</div>
</div>

		<script>
		$(document).ready(function(){
			(function() {
				// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
				if (!String.prototype.trim) {
					(function() {
						// Make sure we trim BOM and NBSP
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					// in case the input is already filled..
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}

					// events:
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );

				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}

				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
			})();
			
			$( '#cd-dropdown' ).dropdown({
				gutter : 5,
				stack : false,
				slidingIn : 100
			});
			
			$('#calc-revenue').priceFormat();
			
			
			$("#reach")
			    .slider({
			        max: 3
			    })
			    .slider("pips", {
			        rest: "label",
			        labels: [
			        	"Regional",
			        	"Multi-Regional",
			        	"National",
			        	"International"
			        ]
			    });
			
			$("#agressive")
			    .slider({
			        max: 2
			    })
			    .slider("pips", {
			        rest: "label",
			        labels: [
			        	"Mild",
			        	"Normal",
			        	"Very Agressive"
			        ]
			    });
			
			bcalc.init();
			
		});
		
		var bcalc = bcalc || {};
			bcalc = {
				r:0,
				t:0,
				p:.03,
				pc:0,
				init: function(){
					bcalc.pc = bcalc.p;
					$('#calc-revenue').blur(function() {
						bcalc.updateT();
					});
					$('#checkbox-7-1,#checkbox-7-2,#checkbox-9-1').change(function() {
						bcalc.updateT();
					});
					$('.circles-slider').slider({
					    change: function(event, ui) {
					        bcalc.updateT();
					    }
					});
					$('.cd-dropdown ul li').click(function() {
						$('[name="cd-dropdown"]').val( $(this).attr('data-value') );
						bcalc.updateT();
					});
				},
				updateT: function(){
					bcalc.r = $('#calc-revenue').val();
					if( bcalc.r == '' ){
						alert('Please enter Last Year\'s Revenue');
						return;
					}
					bcalc.r=parseInt(bcalc.r.replace(/,/g, ''), 10);
					bcalc.updateP();
					bcalc.pc = Math.round(bcalc.pc*1000)/1000;
					bcalc.t = (bcalc.r * bcalc.pc);
					$('#total').html( bcalc.MF(bcalc.t) );
				},
				updateP: function(){
					bcalc.pc = bcalc.DA(0,bcalc.RS());
					bcalc.pc = bcalc.DA(bcalc.pc,bcalc.AS());
					bcalc.pc = bcalc.DA(bcalc.pc,bcalc.IND());
					bcalc.pc = ($('#checkbox-7-1').prop('checked'))?(bcalc.DA(bcalc.pc,.01)):(bcalc.DS(bcalc.pc,.001));
					bcalc.pc = ($('#checkbox-7-2').prop('checked'))?(bcalc.DA(bcalc.pc,.005)):(bcalc.DS(bcalc.pc,.0002));
					bcalc.pc = ($('#checkbox-9-1').prop('checked'))?(bcalc.DS(bcalc.pc,.0)):(bcalc.DA(bcalc.pc,.036));
				},
				DA: function(a,b){
					return Math.round((a + b) * 1e12) / 1e12;
				},
				DS: function(a,b){
					return Math.round((a - b) * 1e12) / 1e12;
				},
				RS: function(){
					var val = $('#reach').slider("option", "value");
					switch(val){
						case 0:return 0.032;break;
						case 1:return 0.042;break;
						case 2:return 0.048;break;
						case 3:return 0.055;break;
					}
				},
				AS: function(){
					var val = $('#agressive').slider("option", "value");
					switch(val){
						case 0:return -0.008;break;
						case 1:return 0.004;break;
						case 2:return 0.012;break;
					}
				},
				IND: function(){
					var val = $('[name="cd-dropdown"]').attr('value');
					switch( parseInt(val) ){
						case 1:return 0.001;break;
						case 2:return 0.004;break;
						case 3:return 0.0065;break;
						case 4:return 0.005;break;
						case 5:return 0;break;
						default:return 0;break;
					}
				},
				MF: function(labelValue){
				  return Math.abs(Number(labelValue)) >= 1.0e+9
				       ? Math.abs(Number(labelValue)) / 1.0e+9 + "B"
				       : Math.abs(Number(labelValue)) >= 1.0e+6
				       ? Math.abs(Number(labelValue)) / 1.0e+6 + "M"
				       : Math.abs(Number(labelValue)) >= 1.0e+3
				       ? Math.abs(Number(labelValue)) / 1.0e+3 + "K"
				       : Math.abs(Number(labelValue));
				}
			}
		</script>
		