<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <?php echo anchor('dashboard',"Dashboard");?></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
 
  <script src="<?php echo base_url()?>assets/js/jquery.min.js"> </script>

<script>
$(document).ready(function(){
          loadjurusan();  
  });
</script>

<script type="text/javascript">
function loadjurusan()
{
     var prodi=$("#prodi").val();   
      $.ajax({
	url:"<?php echo base_url();?>mahasiswa/tampilkankonsentrasi",
	data:"prodi=" + prodi ,
	success: function(html)
	{
            $("#konsentrasi").html(html);
             var konsentrasi=$("#konsentrasi").val();
	}
	});
}
</script>
<script>
$(document).ready(function(){
  $("#prodi").change(function(){
     
        loadjurusan();
  });
});
</script>
<?php
echo $this->session->flashdata('pesan');
echo form_open_multipart($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[obat_id]'>";
$jenis=array(1=>'Chemicals',
                2=>'Dyestuffs',
				3=>'PASTA');
                
$unit=array('KG'=>'KG',
                'Liter'=>'Liter');
				
if($this->session->userdata('level')==1)
{
    $param="";
}
else
{
    $param=array('prodi_id'=>$this->session->userdata('keterangan'));
}
?>
 <div class="row">
                        <div class="col-md-12 clearfix">
                            <ul id="example-tabs" class="nav nav-tabs" data-toggle="tabs">
                                <li class="active"><a href="#dataobat">DATA OBAT</a></li>
                                <li><a href="#leadtime">Leadtime</a></li>
                                
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="dataobat">
                                    <table class="table table-bordered">
                                        <tr class="success"><th colspan="2">DATA OBAT</th></tr>
                                        <tr>
    <td width="250">Kode / Deskripsi Obat</td><td>
        <?php echo inputan('text', 'kode','col-sm-2','Kode Obat ..', 1, $r['kode_obat'],'');?>
        <?php echo inputan('text', 'nama','col-sm-4','Deskripsi ..', 1, $r['deskripsi'],'');?>
        
    </td>
    </tr>
    
    <tr>
    <td width="250">Supplier</td><td>
        <?php echo editcombo('supplier', 'supplier', 'col-sm-6', 'nama_supplier', 'supplier_id', '',array('id'=>'supplier_id'), $r['supplier_id'])?>
    </td>
    </tr>
    
    <tr>
    <td width="250">Jenis</td><td>
    	<?php //echo inputan('text', 'sks','col-sm-1','SKS ..', 1, '','');?>
        <div class="col-sm-3">
        <?php echo form_dropdown('jenis',$jenis,$r['jenis_id'],"class='form-control'")?>
    </td>
    </tr>
    
    <tr>
    <td width="250">Safety Stock</td><td>
        <?php echo inputan('text', 'safety','col-sm-2','0', 0, $r['safetystock'],'');?>
        <div class="col-sm-2">
        <?php echo form_dropdown('unit0',$unit,$r['unit'],"class='form-control'")?>
        </div>
    </td>
    </tr>
    
    <tr>
    <td width="250">Qty Packing</td><td>
        <?php echo inputan('text', 'packing','col-sm-2','0', 0, $r['packing'],'');?>
        <div class="col-sm-2">
        <?php echo form_dropdown('unit',$unit,$r['unit'],"class='form-control'")?>
        </div>
    </td>
    </tr>
    
     <tr>
    <td width="250">Cost / KG</td><td>
        <?php echo inputan('text', 'cost','col-sm-2','0', 0, $r['cost'],'');?> USD
    </td>
    </tr>
                                    </table>
                                    
                                </div>
                                
                                
                                
                                
                                <div class="tab-pane" id="leadtime">
                                    <table class="table table-bordered">
                                        <tr class="success"><th colspan="2">LEADTIME</th></tr>
                                       <?php									  
										
										$kodeld="";
											$ket=""; 	
									   $q="select * from leadtime where obat_id=$r[obat_id]";
									   $d=$this->db->query($q)->result();
									   foreach($d as $l)
									   {
											$kodeld=$l->kode_leadtime;
											$ket=$l->keterangan   ;
									   }
									   ?> 
                                        <tr><td>Leadtime</td>
                                            <td>
                                                <?php 
												if ($kodeld==""){
													echo buatcombo('leadid','kode_leadtime','col-sm-3','time','id','','');
												}else{
													
												echo editcombo('leadid','kode_leadtime','col-sm-3','time','id','',array('id'=>'id'), $kodeld); 
												}
												?>
                                                
                                            </td></tr>
                                        <tr><td>Keterangan</td>
                                            <td>
                                                <?php echo textarea('keterangan', '', 'col-sm-6', 2, $ket)?>
                                                
                                            </td></tr>
                                        
                                    </table>
                                </div>
                                
                                
                            </div>
                        </div>
     
    
            
     
            


<input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
</form>

