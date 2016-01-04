<?php $data['page_title'] = "Send Message"; 
$data['style']='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
		<style type = "text/css">
			input{
				text-transform:capitalize;
			}
		</style>'?>
<?php $this->load->view('admin/includes/header.php',$data);?>
<div id="page-wrapper">
	<h1>Compose</h1>
    <hr>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i> <?php echo anchor("admin/","Home")?>
        </li>
        <li><?php echo anchor("message/inbox","Messages")?></li>
        <li class="active">Compose</li>
    </ol>
    <div class="row">
    <div class="wrapper span6 col-md-7 col-sm-10">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Create Message
    	</div>
    	<div class="panel-body">
    		
    		<?php echo form_open_multipart("message/admin_send",array("class"=>"form"));?>	
    			 <?php if(isset($error))echo $error?>  	
	    		<div class="">	    	
	    			<div class="form-group span8">
	                    <label class="control-label" for="a_to">To</label>
	                    <?php echo form_dropdown('a_to',array("2"=>"Sponsors","4"=>"Scholars"),set_value("a_to"),'class="form-control input-sm"'); 
	                    		echo form_error("a_to");?>
	                </div>		
	    			<div class="form-group span8">
	                    <label class="control-label" for="a_title">Subject</label>
	                    <?php echo form_input(array("name"=>"a_title","class"=>"form-control input-sm","placeholder"=>"Subject"),set_value("a_title")); 
	                    		echo form_error("a_title");?>
	                </div>
	                
	               
	                <div class="form-group span12">
	                    <label class="control-label" for="a_msg">Message</label>
	                    <?php echo form_textarea(array("name"=>"a_msg","id"=>"a_msg","class"=>"form-control input-sm","placeholder"=>"Message"),set_value("a_msg"));
								echo form_error("a_msg"); ?>
	                </div>
	                
	    		</div>
	    		<div class="form-group col-md-8 span4">
	    			<?php echo form_submit(array("value"=>"Send","class"=>"form-control btn btn-primary")) ?>
	    		</div>		    
	    		
		    <?php echo form_close();?>
    	</div>
    </div>    	
    </div>
    </div>
    
    
</div>
<?php $this->load->view('admin/includes/footer.php',$data);?>
