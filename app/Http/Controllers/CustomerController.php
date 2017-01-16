<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmergencyPlanTemplate;
use DB;
use File;
use Storage;


use App\PHPExcel_v1_8\Classes\PHPExcel;




class CustomerController extends Controller
{
    function customerShowList()
    {
        $data = EmergencyPlanTemplate::select('id','tenant_id','organisation_id','facility_id','slug','name','description','display_sequence','required','template')->orderBy('sortOrder','asc')->get();
        return view("test")->with(['data'=>$data]);
    }
    public function emergencyAddForm(Request $request)
    {

       

        $this->validate($request, [
            'tenant_id' => 'required',
            'organisation_id' => 'required',
            'facility_id' => 'required',
            'slug' => 'required',
            'name' => 'required',
            'description' => 'required',
            'display_sequence' => 'required',
            'required' => 'required',
            'template' => 'required',
            ]);
    

            $id = 0;
            $tenant_id = $request->tenant_id;
            $organisation_id = $request->organisation_id;
            $facility_id = $request->facility_id;
            $slug = $request->slug;
            $name = $request->name;
            $description = $request->description;
            $display_sequence = $request->display_sequence;
            $required = $request->required;
            $template = $request->template;



        if(isset($request->pid) && $request->pid>0) {

            $id = (int)$request->pid;

            $data = EmergencyPlanTemplate::find($request->pid);
            $data->tenant_id = $request->tenant_id;
            $data->organisation_id = $request->organisation_id;
            $data->facility_id = $request->facility_id;
            $data->slug = $request->slug;
            $data->name = $request->name;
            $data->description = $request->description;
            $data->display_sequence = $request->display_sequence;
            $data->required = $request->required;
            $data->template = $request->template;
            $data->save();

        } else {

            $sortOrder = EmergencyPlanTemplate::max('sortOrder');

            $data = EmergencyPlanTemplate::create(['tenant_id'=>$tenant_id,'organisation_id'=>$organisation_id,'facility_id'=>$facility_id,'slug'=>$slug,'name'=>$name,'description'=>$description,'display_sequence'=>$display_sequence,'required'=>$required,'template'=>$template,'sortOrder'=>$sortOrder+1]);
            if(isset($data->id) && $data->id>0) {
                $id = (int)$data->id;
            }

        }
        
        echo $id;

    }
    public function deleteData(Request $request,$id)
    {
            $data = EmergencyPlanTemplate::find($id);
            $data->delete();
            return "true";

    }
    public function editForm($id)
    {
        $data = EmergencyPlanTemplate::select('tenant_id','organisation_id','facility_id','slug','name','description','display_sequence','required','template')->where('id',$id)->get();
        
        $arr = array();
        foreach ($data as $key => $value) {
            $arr['tenant_id'] = $value->tenant_id;
            $arr['organisation_id'] = $value->organisation_id;
            $arr['facility_id'] = $value->facility_id;
            $arr['slug'] = $value->slug;
            $arr['name'] = $value->name;
            $arr['description'] = $value->description;
            $arr['display_sequence'] = $value->display_sequence;
            $arr['required'] = $value->required;
            $arr['template'] = $value->template;
        }
        
        return json_encode($arr);
    }
    function ExportExcel(){

        require_once base_path().'/PHPExcel_v1_8/Classes/PHPExcel/IOFactory.php';

        $users =EmergencyPlanTemplate::select('tenant_id','organisation_id','facility_id','slug','name','description','display_sequence','required','template')->simplepaginate(100);    
        
        $colNames = array('tenant_id','organisation_id','facility_id','slug','name','description','display_sequence','required','template');
        $showClientValInCol = 9;

        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $row = 1;

        for ($i=0; $i < count($colNames); $i++) { 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i,$row, $colNames[$i]);    
        }

        $objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());

        //set background color
        $objPHPExcel->getActiveSheet()->getStyle($objPHPExcel->getActiveSheet()->calculateWorksheetDimension())->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000');

        //Set font color
        $styleArray = array(
            'font'  => array(
                'color' => array('rgb' => 'FFFFFF'),
            ));
        $objPHPExcel->getActiveSheet()->getStyle($objPHPExcel->getActiveSheet()->calculateWorksheetDimension())->applyFromArray($styleArray);

        $objPHPExcel->getActiveSheet()->setTitle('data');

        $previousEmailVal = '';
        foreach ($users as $val) {
            
           
            $row++;
             

             $col = 0;
            foreach ($colNames as $cname) {

                $clname = '';
                if(isset($colNames[$col])){
                    $clname = $colNames[$col];
                }

                if($clname!='') {
                    
                    
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row, $val->$clname);
                   
                    
                    
                    
                    $col++;
                }
            }
            
        }

        
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data-'.date('Y-m-d').'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 2017 05:00:00 GMT');
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public');

        
        $objWriter->save('php://output');
        exit;

    
    }
    function exportcsv(){

        require_once base_path().'/PHPExcel_v1_8/Classes/PHPExcel/IOFactory.php';

        $users =EmergencyPlanTemplate::select('tenant_id','organisation_id','facility_id','slug','name','description','display_sequence','required','template')->simplepaginate(100);    
        
        $colNames = array('tenant_id','organisation_id','facility_id','slug','name','description','display_sequence','required','template');
        $showClientValInCol = 9;

        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $row = 1;

        for ($i=0; $i < count($colNames); $i++) { 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i,$row, $colNames[$i]);    
        }

        $objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());

        //set background color
        $objPHPExcel->getActiveSheet()->getStyle($objPHPExcel->getActiveSheet()->calculateWorksheetDimension())->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000');

        //Set font color
        $styleArray = array(
            'font'  => array(
                'color' => array('rgb' => 'FFFFFF'),
            ));
        $objPHPExcel->getActiveSheet()->getStyle($objPHPExcel->getActiveSheet()->calculateWorksheetDimension())->applyFromArray($styleArray);

        $objPHPExcel->getActiveSheet()->setTitle('data');

        $previousEmailVal = '';
        foreach ($users as $val) {
            
           
            $row++;
             

             $col = 0;
            foreach ($colNames as $cname) {

                $clname = '';
                if(isset($colNames[$col])){
                    $clname = $colNames[$col];
                }

                if($clname!='') {
                    
                    
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row, $val->$clname);
                   
                    
                    
                    
                    $col++;
                }
            }
            
        }

        
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data-'.date('Y-m-d').'.csv"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 2017 05:00:00 GMT');
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public');

        
        $objWriter->save('php://output');
        exit;

    
    }
    function exportPdf(){

       require_once(base_path().'/TCPDF/examples/tcpdf_include.php');

        // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Developer');
        $pdf->SetTitle('Laravel Datatable export to PDF');
        $pdf->SetSubject('Laravel Datatable export to PDF');
        $pdf->SetKeywords('Laravel, Datatable, mysql, jquery');

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(base_path().'/TCPDF/examples/lang/eng.php')) {
            require_once(base_path().'/TCPDF/examples/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', 'B', 20);

        // add a page
        $pdf->AddPage();

        //$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

        $pdf->SetFont('helvetica', '', 8);

        $users =EmergencyPlanTemplate::select('tenant_id','organisation_id','facility_id','slug','name','description','display_sequence','required','template')->simplepaginate(100); 
        
        $colNames = array('tenant_id','organisation_id','facility_id','slug','name','description','display_sequence','required','template');
       
        $previousEmailVal = '';

        $str = '<table cellspacing="0" cellpadding="1" border="1">';
        $str .= '<tr>';
        $str .= '<th>Tenant id</th>';
        $str .= '<th>Organisation id</th>';
        $str .= '<th>Facility id</th>';
        $str .= '<th>Slug</th>';
        $str .= '<th>Name</th>';
        $str .= '<th>Description</th>';
        $str .= '<th>Display sequence</th>';
        $str .= '<th>Required</th>';
        $str .= '<th>Template</th>';
        $str .= '</tr>';
        foreach ($users as $val) {
            
           
            $str .= '<tr>';
            $str .= '<td>'.$val->tenant_id.'</td>';
            $str .= '<td>'.$val->organisation_id.'</td>';
            $str .= '<td>'.$val->tenant_id.'</td>';
            $str .= '<td>'.$val->slug.'</td>';
            $str .= '<td>'.$val->name.'</td>';
            $str .= '<td>'.$val->description.'</td>';
            $str .= '<td>'.$val->display_sequence.'</td>';
            $str .= '<td>';
            if ($val->required==1) {
                $str .= 'yes';
            }else{
                $str .= 'no';
            } 
            $str .= '</td>';
            $str .= '<td>'.$val->required.'</td>';
            $str .= '<td>'.$val->template.'</td>';
            $str .= '</tr>';
            
        }
        $str .= '</table>';

        $pdf->writeHTML($str, true, false, false, false, '');

        $pdf->Output('Content-Disposition: attachment;filename="data-'.date('Y-m-d').'.pdf', 'D');
    
    }

    function reorder($allIds,$bothIds){

         

        $sortArr = array();

        $res = DB::Select(DB::raw("select id, sortOrder from emergency_plan_templates where  id in (".$allIds.")"));
       

        foreach ($res as $row) {
           $sortArr[$row->id] = $row->sortOrder; 
        }
       
        if(trim($bothIds)!='') {
            $arr = explode(",",$bothIds);

            for ($i=0; $i < count($arr); $i++) {                  
                

                if(isset($arr[$i])){
                    $arr1 = explode(":",$arr[$i]);
                    if(isset($arr1[0]) && isset($arr1[1])) {
                            

                            $record = EmergencyPlanTemplate::find($arr1[1]);
                            $record->sortOrder = $sortArr[$arr1[0]];
                            $record->save();
                    }
                }
               

              

            }
        }

        //$newId,$previousId both are primary ids
        /*$preArr = EmergencyPlanTemplate::select('sortOrder')->where('id',$previousId)->first();
        $newArr = EmergencyPlanTemplate::select('sortOrder')->where('id',$newId)->first();

        if(isset($preArr->sortOrder)) {
            $record = EmergencyPlanTemplate::find($newId);
            $record->sortOrder = $preArr->sortOrder;
            $record->save();
        }

        if(isset($newArr->sortOrder)) {
            $record = EmergencyPlanTemplate::find($previousId);
            $record->sortOrder = $newArr->sortOrder;
            $record->save();
        }*/
    }
}
