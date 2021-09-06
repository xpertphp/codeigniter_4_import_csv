<?php 

namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\StudentModel;
use CodeIgniter\HTTP\RequestInterface;
 
class Student extends Controller
{
 
	public function __construct()
    {
         helper(['form', 'url']);
    }
    public function index()
    {   
		return view('add');
    }
	
	public function importFile()
    { 
		$rules = [
			'image' => [
				'uploaded[file]',
                'max_size[file,1024]',
                'ext_in[image,csv]',
			 ],
		];
		
		if (!$this->validate($rules)) {
			return view('add', ['validation' => $this->validator]);
		} else {
			$file = $this->request->getFile('file');
			if($file){
				$newName = $file->getRandomName();
               // Store file in public/csvfile/ folder
               $file->move('../public/csvfile', $newName);
               // Reading file
               $file = fopen("../public/csvfile/".$newName,"r");
               $i = 0;
               $numberOfFields = 5; // Total number of fields
               $importData_arr = array();
               while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                  $num = count($filedata);
					if($i > 0 && $num == $numberOfFields){ 
                     $importData_arr[$i]['first_name'] = $filedata[0];
                     $importData_arr[$i]['last_name'] = $filedata[1];
                     $importData_arr[$i]['email'] = $filedata[2];
                     $importData_arr[$i]['address'] = $filedata[3];
                     $importData_arr[$i]['mobile'] = $filedata[4];
                  }
                  $i++;
               }
               fclose($file);
			   
				$image->move(WRITEPATH . 'uploads');
				// Insert data
				$count = 0;
				foreach($importData_arr as $studentData){
				// Check record
				$model = new StudentModel(); 

				$checkrecord = $model->where('email',$studentData['email'])->countAllResults();
				if($checkrecord == 0){
					## Insert Record
					if($model->insert($studentData)){
					 $count++;
					}
				}
					return redirect()->to( base_url('student') );
				}
			}else{
				echo "File not imported";
			}
            
		}	
		
    }
   }
 
}

?>