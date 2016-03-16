<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script type="text/javascript">
        function   fr_insert()
        {
            $('#win_medi').window('open');
           // var url='<?=base_url()?>index.php/adr/insertADR/';
            
        }
        function  saveMedi(url)
        {
            $('#fr_medi').form('submit',{
                //url: '<?=base_url()?>index.php/adr/insertADR/' ,
                url:url ,
                success:function(result)
                {
                      //alert(result);
                    $("#win_medi").window('close');
                    $('#dg_medi').datagrid('reload');
                }
            });
        }
        function updateMedi()
        {
           $('#fr_medi').form('submit',{
                //url: '<?=base_url()?>index.php/adr/insertADR/' ,
                url:url ,
                success:function(result)
                {
                   // alert(result);
                    $("#win_medi").window('close');
                    $('#dg_medi').datagrid('reload');
                }
            }); 
        }
 
 //-- datagrid Main---
 $(function(){
     
  $('#dg_medi').datagrid({
            url:'<?=base_url()?>index.php/medication/loadMedi/',
            rownumbers:true,
            fitColumns:true,
            singleSelect:true,
            columns:[[ 
            { field:'HN',title:'HN'   },
            { field:'MonitoringDate',title:'MonitoringDate'  },
            { field:'DRPselection4',title:'Medication error' },
            { field:'MedicationErrorDrug4',title:'Drug/Product' },
            { field:'MedicationErrorDetail',title:'Detail' },
            { field:'Action4',title:'Action' },
            { field:'Response4',title:'Result'},
            { field:'ResponseDetail4',title:'Result Detail' },
            { field:'followup',title:'follow up' },
            { field:'week',title:'week' },
            
            
            
                    ]],
            toolbar:[  
                        { text:'Reload',iconCls:'icon-reload',handler:function(data){ $('#dg_medi').datagrid('reload');   }    },
                        { text:'เพิ่มข้อมูล',iconCls:'icon-add',handler:function(data)
                            { 
                                //$.messager.alert('t'); 
                                $('#win_medi').window('open');
                                
                                
                                /*
                                  $('#btn_save_adr').bind('click',function()
                                        {
                                            //alert('t');
                                            saveADR('<?=base_url()?>index.php/adr/insertADR/');
                                        });
                                */
                                
                            }    
                        },
                        { text:'ลบข้อมูล', iconCls:'icon-remove',handler:function(data)
                                {  
                                     var  row=$('#dg_medi').datagrid('getSelected');
                                     if(row)
                                     {
                         
                                           $.messager.confirm('สถานะการลบข้อมูล','คุณแน่ต้องการลบข้อมูลหรือไม่',function(r)
                                           {
                                               
                                               
                                                if(r) 
                                                   { 
                                                        $.post("<?=base_url()?>index.php/medication/delMedi/" + row.HN + "/"  +  row.MonitoringDate ,function(data)
                                                          {                                                                                                     
                                                            var ck=data.success;
                                                             if( ck == 1 )
                                                             {
                                                                 $.messager.alert('สถานะการลบข้อมูล','ลบข้อมูลแล้ว','Info');
                                                                 $('#dg_medi').datagrid('reload'); 
                                                             }
                                                             else if( ck == 0 )
                                                             {
                                                                 $.messager.alert('สถานะการลบข้อมูล','ไม่สามารถลบข้อมูลได้','error');
                                                             }
                                                          },'json');
                                                   
                                                    }     
                                                   
                                           });
                                   
                                     }
                                             
                                }  
                        },
                        {  
                           text:'แก้ไขข้อมูล',iconCls:'icon-edit',handler:function(data)
                            {
                                var  row=$('#dg_medi').datagrid('getSelected');
                                if( row ) 
                                    { 
                                                       
                                           //alert('t');            
                                                      
                                          $('#win_medi').window('open');
                                          $('#fr_medi').form('load','<?=base_url()?>index.php/medication/fetchMedi/'  +  row.HN  + '/' + row.MonitoringDate );
                                         
                                         // _url='<?=base_url()?>index.php/noncomp/updateNoncomp/'   +  row.HN  + '/' + row.MonitoringDate;
                                          
                                                   
                                    } 
                            }
                        }
                     ] 
        });   
     
     
 });
 
 





    </script>
    
</head>

<body>
    
    
    
    <div style="margin:10px 0 10px 0;"></div>
    
  
    
    <table id="dg_medi" class="easyui-datagrid">           
    </table>
    
    <div id="win_medi" class="easyui-window" title="เพิ่มข้อมูล/แก้ไขข้อมูล Medication error" data-options="
         modal:true,
         closed:true,
         iconCls:'icon-large-smartart',
         size:'large',
         " 
         style="width:600px;height:600px;padding:10px;">
                        <form id="fr_medi" class="easyui-form" method="post" data-options="novalidate:true">
                            <table cellpadding="5">
                                <tr>
                                    <td>
                                        HN :
                                    </td>
                                    <td>
                                      <input class="easyui-textbox" style="width:70%;height: 30px" id="HN_medi" name="HN_medi" data-options="iconCls:'icon-man',readonly:true " required="require" >
                                    </td>
                                </tr>
                                <tr>
                                    
                                    
                <tr>
                    <td>
                       MonitoringDate : 
                    </td>
                    <td>
                         <input  class="easyui-datebox" id="MonitoringDate_medi" name="MonitoringDate_medi"  required="true">
                    </td>
                </tr>
                
                                <tr>  
                                    <td>
                                        Medication error :
                                    </td>
                                    <td>
                                         <select class="easyui-combobox" name="DRPselection4" id="DRPselection4" style="width:200px;height: 30px" >
                                                <option value=0>No</option>
                                                <option value=1>Prescribing error</option>
                                                 <option value=2>Trancribing error</option>
                                                 <option value=3>Dispensing error</option>
                                                 <option value=4>Administration error</option>
                                                 <option value=5>Unclear order</option>
                                        </select>
                                        
                                        <a href="#" class="easyui-linkbutton"  data-options=" iconCls:'icon-print' "  onclick="$('#dia_medi').dialog('open');   " >View</a>  
                                        <a href="#"  class="easyui-linkbutton"  data-options=" iconCls:'icon-add' " >Add</a>
                                        
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td> Drug/Product : </td>
                                    <td>
                                        <input class="easyui-combobox" name="MedicationErrorDrug4" id="MedicationErrorDrug4"  style="height: 30px;" data-options="
                                               url:'<?=base_url()?>index.php/noncomp/option_drug',
                                               method:'post',
                                               valueField:'Drug',
                                               textField:'Drug',
                                               panelHeight:'auto',
                                               " />
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td> Detail : </td>
                                    <td>
                                        <input class="easyui-textbox"  id="MedicationErrorDetail" name="MedicationErrorDetail" style="width:200px;height: 30px;"  data-options=" iconCls:'icon-man'   " >
                                     </td>
                                </tr>
                                
                                 <tr>
                                    <td> Action : </td>
                                    <td>
                                        <input  type="radio" name="Action4" id="Action2_use" value="1" /> Prevent
                                        <input  type="radio" name="Action4" id="Action2_no"  value="2"/> Correct 
                                     </td>
                                </tr>
                                
                                <tr>
                                    <td> Intervention : </td>
                                    <td>
                                        <a href="#" class="easyui-linkbutton" data-options=" iconCls:'icon-print',size:'large' "  style="height:30px" >Click To Add Intervention</a>
                                     </td>
                                </tr>
                                
                                  <tr>
                                    <td> Result : </td>
                                    <td>
                                        <input  type="radio" name="Response4" id="Response2_Resolved"  value="1" /> Resolved
                                        <input  type="radio" name="Response4" id="Response2_Improved" value="2"/> Improved 
                                        <input  type="radio" name="Response4" id="Response2_Not_Improved" value="3" /> Not Improved
                                        <input  type="radio" name="Response4" id="Response2_N/A" value="4"/> N/A 
                                        <br>
                                        <input class="easyui-textbox" style="width:300px;height: 40px" data-options=" iconCls:'icon-man' " id="ResponseDetail4" name="ResponseDetail4" />
                                     </td>
                                </tr>
                                
                                      
                                       
                                       <tr>
                                           <td>
                                               Follow Up :
                                           </td>
                                           <td>
                                               <input class="easyui-numberbox" id="followup_medi"  name="followup_medi"  style="width:50px;height: 30px;" />
                                           </td>
                                       </tr>
                                       
                                       <tr>
                                           <td>
                                               week :
                                           </td>
                                           <td>
                                               <input class="easyui-datebox" id="week_medi" name="week_medi"  style="height: 30px;" >
                                           </td>
                                       </tr>
                                       
                                       
                                       <tr>
                                           <td colspan="2">
                                               <a id="btn_save_adr"  href="#" class="easyui-linkbutton" data-options=" iconCls:'icon-add',size:'large' "  style="height:30px" onclick="saveMedi('<?=base_url()?>index.php/medication/insertMedi')" > บันทึก </a>
                                               
                                               <!-- onclick="saveADR('<?=base_url()?>index.php/adr/insertADR/')" -->
                                               
                                               <a id="btn_save_adr"  href="#" class="easyui-linkbutton" data-options=" iconCls:'icon-add',size:'large' "  style="height:30px" onclick="saveMedi('<?=base_url()?>index.php/medication/updateMedi')" > แก้ไข </a> 
                                               
                                               
                                               <a href="#" class="easyui-linkbutton" data-options=" iconCls:'icon-remove',size:'large' "    style="height:30px"  onclick=" $('#win_medi').window('close');">ปิด </a>
                                               
                                           </td>
                                       </tr>
                                       
                                       
                                       
                            </table>
                        </form>    
    </div>


    <!-- view -->
    <div class="easyui-dialog" id="dia_medi"  title=" C.Medication error History " style="width:600px;height:840px;top:10px;left:10px;" 
            data-options="
                 iconCls:'icon-large-chart',
                 closed:true,
                 buttons:[
                  {   text:'Close',iconCls:'icon-cancel',handler:function(){  $('#dia_medi').dialog('close');  }   }
                 ]

            ">
         <div style="padding:10px">
             Monitoring Date : <input class="easyui-combobox"   id="MonitoringDate_medi"  style="width:200px;height: 30px;"   data-options="
                                     url:'<?=base_url()?>index.php/medication/date_medication/AB0216/11/12/2551',
                                     valueField:'MonitoringDate',
                                     textField:'MonitoringDate',
                                     
                                     " />


         </div>
        
        <div style="padding:10px">
            Medication error : <input class="easyui-combobox" name="DRPselection3_medi" id="DRPselection3" style="width:200px;height: 30px" />
                                        
        </div>
        
         <div style="padding: 10px;">
            <label>
                Drug/Product : <input class="easyui-combobox"   id="DRPDrug3_medi"  name="DRPDrug3_view"  style="width: 200px;height: 30px;" 
                                      data-options="
                                      url:'<?=base_url()?>index.php/otherdrp/tb_drug',
                                      valueField:'Drug',
                                      textField:'Drug',
                                      mode:'remote',
                                      "
                                      />
            </label>
        </div>
        
        <div style="padding: 10px;">
            Detail :  <input class="easyui-textbox"  style="width:300px;height:50px;"  data-options=" multiline:true  "  />
        </div>
        
        <div style="padding: 10px;">
            Action :    <input  type="radio"    /> Prevent      <input  type="radio"   /> Correct
          </div>
        
        
        <div style="padding: 10px;">
            <?=nbs(10)?>
            <label>
                   Patient                                
            </label>
            <?=nbs(70)?>
            <label>
                   Doctor
            </label>
            
        </div>
        <div style="padding: 10px;">
            <label>
                <input  type="checkbox"  id="InterventionPT3-1_drp"  name="InterventionPT3-1_drp" /> Adjust for appropriate therapy due to health system
            <input  type="checkbox"  id="InterventionDoctor3_1_drp"  name="InterventionDoctor3_1_drp" /> Add new medication
            </label>
        </div>
        
        <div style="padding: 10px;">
            <label>
                <input  type="checkbox" id="InterventionPT3_2_drp"  name="InterventionPT3_2_drp"  /> Correct technique of administration
                <input  type="checkbox"  id="InterventionDoctor3_2_drp"  name="InterventionDoctor3_2_drp"  /> Adjust dosage reqimen
            </label>
        </div>
        
        <div style="padding: 10px;">
            <label>
                <input  type="checkbox" id="InterventionPT3_3_drp"  name="InterventionPT3_3_drp" /> Improve compliance
                <input  type="checkbox"   id="InterventionDoctor3_3_drp"   name="InterventionDoctor3_3_drp"  /> Confirm prescription
            </label>
        </div>
        
                <div style="padding: 10px;">
            <label>
                <input  type="checkbox" id="InterventionPT3_4_drp"  name="InterventionPT3_4_drp" /> Inform drug related problems
                <input  type="checkbox"  id="InterventionDoctor3_4_drp"  name="InterventionDoctor3_4_drp" /> Discontinue medication
            </label>
        </div>
        
                        <div style="padding: 10px;">
            <label>
                <input  type="checkbox"  id="InterventionPT3_5_drp"  name="InterventionPT3_5_drp" /> Life style modication
                <input  type="checkbox"  id="InterventionDoctor3_5_drp"  name="InterventionDoctor3_5_drp"  /> Inform drug related problems
            </label>
        </div>
        
         <div style="padding: 10px;">
            <label>
                <input  type="checkbox"  id="InterventionPT3_6_drp"  name="InterventionPT3_6_drp" /> Monitor efficacy and toxicity
                <input  type="checkbox"  id="InterventionDoctor3_6_drp"  name="InterventionDoctor3_6_drp" /> Suggest changing medication
            </label>
        </div>
        
                 <div style="padding: 10px;">
            <label>
                <input  type="checkbox"  id="InterventionPT3_7_drp" name="InterventionPT3_7_drp" /> Prevention of Adverse drug reaction
                <input  type="checkbox"  id="InterventionDoctor3_7_drp"  name="InterventionDoctor3_7_drp" /> Suggest laboratory
            </label>
        </div>
        
        <div style="padding: 10px">
            <label>
                 Response :
            </label>
            
        </div>
        
        <div style="padding: 10px">
            <label>
               
                <input type="radio"  id="drp_response"  name="drp_response"  /> Resolved
                <input type="radio"  id="drp_improved"  name="drp_improved" /> Improved 
                
                
                <input class="easyui-textbox"  data-options=" multiline:true "  id="ResponseDetail3_drp"  name="ResponseDetail3_drp"  style="width:300px;height: 50px;"   />
                  
                <br>
                
                <input type="radio" id="drp_notim"   name="drp_notim" /> Not Improved
                <input type="radio"  id="drp_na" name="drp_na" /> N/A
                
            </label>

        </div>
        
        
        <div style="padding: 10px">
                     <label>
                         ผู้ประเมิน : <input class="easyui-combogrid"  style="width:200px;height: 30px;"  
                                             data-options="
                                                url:'<?=base_url()?>index.php/otherdrp/tb_user',
                                             idField:'UserCode',
                                              textField:'UserName'  ,
                                              mode:'remote',
                                             method:'post',
                                             singleSelect:true,
                                          
                                              fitColumns:true,
                                              columns : [[
                                                {  field:'UserName', title:'UserName', },
                                                {  field:'UserSurname',title:'UserSurname', },
                                                
                                              ]]
                                             "
                                             />    
                     </label>
              </div>
        
        
    </div>

    <!-- view -->
    
</body>
</html>
    