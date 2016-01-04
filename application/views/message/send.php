<?php $data['page_title'] = "Send Message"; 
$data['style']='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
		<style type = "text/css">
			input{
				text-transform:capitalize;
			}
			.form-group{ width:100% !important;
			}
				textarea{width:90% !important}
		</style>'?>
<?php $this->load->view('includes/header.php',$data);?>
<div class="container main-container">
    
    <section class="span6">
    <?php echo form_open_multipart("message/scholar_send",array("class"=>"form"));?>
    <div class="container-fluid">
    	<div class="">
    		<h3>Create Message</h3>
    	</div>
    	<hr>
    	<div class="">
    		
		 <?php if(isset($error))echo $error?>
			<div class="form-group span8">
                <label class="control-label" for="a_to">To</label>
                <?php echo form_dropdown('a_to',$to,set_value("a_to"),'class="form-control input-sm"'); 
                		echo form_error("a_to");?>
            </div>			
			<div class="form-group span8">
                <label class="control-label" for="a_title">Subject</label>
                <?php echo form_input(array("name"=>"a_title","class"=>"form-control input-sm","placeholder"=>"Subject","required"=>"required"),set_value("a_title")); 
                		echo form_error("a_title");?>
            </div>
            
           
            <div class="form-group span12">
                <label class="control-label" for="a_msg">Message</label>
                <?php echo form_textarea(array("name"=>"a_msg","id"=>"a_msg","class"=>"form-control input-sm","placeholder"=>"Message"),set_value("a_msg"));
						echo form_error("a_msg"); ?>
            </div>
	           
    	</div>
    		
    	<div class="container-fluid">
    		<hr> 
	    	<?php echo form_submit(array("value"=>"Send","class"=>"form-control btn btn-primary pull-right")) ?>
	    </div>		    
	    		
    </div>    	
     <?php echo form_close();?>
    </section>
    
    
    
</div>
<?php $this->load->view('includes/footer.php',$data);?>
<script src="<?php echo base_url();?>js/htmlarea/jHtmlArea-0.8.min.js"></script>
<script>
	$(document).ready(function(){
		$("#btn-attach").click(function(){
			a = $("<input>").attr('type','file').attr('name','attachment[]').attr('multiple','multiple').addClass('form-control input-sm');
			$(this).before($(a)).remove();
		});
		$("textarea").htmlarea({
		toolbar: [
		        ["bold", "italic", "underline","strikethrough","|","subscript","superscript"],
		        ["orderedList","unorderedList"],
		        ["indent","outdent"],
		        ["justifyleft","justifycenter","justifyright"],
		        ["link", "unlink"]
		    ]
		});
		$(".form").validate({
		rules: {  			             
            a_title:{
            	required:true,
            	maxlenght:80
            },  
            a_msg:{
            	maxlength:2000
            }
       },
       messages:{
       		a_title:{
            	maxlenght:"Subject is too long."
            },  
            a_msg:{
            	maxlength:"Message is up to 2000 characters only."
            }
       }
	});
	});
</script>
