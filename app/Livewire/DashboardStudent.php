<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Student;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

use function Laravel\Prompts\password;

class DashboardStudent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $image, $umur, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $kelas, $alamat, $email, $password;

    public $updateData = false;
    public $preview = false;
    public $detail = false;
    public $studentId, $oldImage, $oldPassword, $imagePreview, $studentDetail;
    // public $count_student, $male_count, $female_count;

    protected $rules = [
        'name' => 'required|max:255',
        'image' => 'nullable|image|file|max:1024',
        'umur' => 'required|max:255',
        'jenis_kelamin' => 'required|max:255',
        'tempat_lahir' => 'required|max:255',
        'tanggal_lahir' => 'required|max:255',
        'kelas' => 'required|max:255',
        'alamat' => 'required|max:255',
        'email' => 'required|email:dns|unique:users',
        'password' => 'required|min:5|max:255'
    ];
    protected $rulesUpdate = [
        'name' => 'required|max:255',
        'image' => 'nullable|image|file|max:1024',
        'umur' => 'required|max:255',
        'jenis_kelamin' => 'required|max:255',
        'tempat_lahir' => 'required|max:255',
        'tanggal_lahir' => 'required|max:255',
        'kelas' => 'required|max:255',
        'alamat' => 'required|max:255',
        'email' => 'required|email:dns|',
        'password' => 'nullable|min:5|max:255'
    ];

    public function updatedImage()
    {
        $this->preview = true;
        $this->validateOnly('image');
        $this->imagePreview = $this->image->temporaryUrl();
        // dd($this->imagePreview);
    }

    public function store(){
        
        $validatedData = $this->validate();
        
        if($this->image){
            $validatedData['image'] = $this->image->store('profile-image');
        }
        
        $files = Storage::allFiles('livewire-tmp');
        
        if(count($files) > 0){
            foreach($files as $file){
                Storage::delete($file);
            }
        }

        Student::create($validatedData);
        $this->reset([
            'name', 'image', 'umur', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'kelas', 'alamat', 'email', 'password', 'imagePreview'
        ]);
        session()->flash('success', 'Berhasil Input Data Siswa');
        
    }

    public function edit($id){

        $this->detail = false;
        $data = Student::find($id);
        
        $this->oldImage = $data->image;
        $this->oldPassword = $data->password;
        $this->name = $data->name;
        $this->image = "";
        $this->umur = $data->umur;
        $this->jenis_kelamin = $data->jenis_kelamin;
        $this->tempat_lahir = $data->tempat_lahir;
        $this->tanggal_lahir = $data->tanggal_lahir;
        $this->kelas = $data->kelas;
        $this->alamat = $data->alamat;
        $this->email = $data->email;
        $this->studentId = $id;
        $this->imagePreview = $data->image;
        // dd($this->imagePreview);

        $this->updateData = true;
    }

    public function update(){
        
        // $this->rules['password'] = 'nullable|min:5|max:255';
        $validatedData = $this->validate($this->rulesUpdate);
        
        $data = Student::find($this->studentId);
        // dd($this->image);

        if($this->image){
            // dd("test");
            if($this->oldImage != null){
                Storage::delete($this->oldImage);
            }
            $data->image = $this->image->store('profile-image');
        }


        $files = Storage::allFiles('livewire-tmp');
        
        if(count($files) > 0){
            foreach($files as $file){
                Storage::delete($file);
            }
        }

        if(empty($this->password)){
            $data->password = $this->oldPassword;
        }else{
            $data->password = $this->password;
        }

        $data->name = $this->name;
        $data->umur = $this->umur;
        $data->jenis_kelamin = $this->jenis_kelamin;
        $data->tempat_lahir = $this->tempat_lahir;
        $data->tanggal_lahir = $this->tanggal_lahir;
        $data->kelas = $this->kelas;
        $data->alamat = $this->alamat;
        $data->email = $this->email;
        
        $data->save();
        $this->updateData = false;
        $this->preview = false;

        $this->reset([
            'name', 'image', 'umur', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'kelas', 'alamat', 'email', 'password', 'imagePreview'
        ]);
        session()->flash('success', 'Berhasil Edit Data Siswa');
    }

    public function cancel(){
        $this->updateData = false;
        $this->preview = false;
        $this->detail = false;

        $this->reset([
            'name', 'image', 'umur', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'kelas', 'alamat', 'email', 'password', 'imagePreview', 'studentDetail'
        ]);
    }

    public function showDetail($id){
        $this->detail = true;
        $this->studentDetail = Student::find($id);
    }

    public function delete(){
        $data = Student::find($this->studentId);
        if($data->image != null){
            Storage::delete($data->image);
        } 
        $data->delete();
        $this->detail = false;
        $this->reset([
            'name', 'image', 'umur', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'kelas', 'alamat', 'email', 'password', 'imagePreview', 'studentDetail'
        ]);
        session()->flash('success', 'Berhasil Hapus Data Siswa');

    }

    public function konfirmasiDelete($id){
        $this->studentId = $id;
    }

    public function render()
    {
        $data = Student::orderBy('created_at', 'desc')->paginate(3);
        return view('livewire.dashboard-student', [
            'students'=>$data,
            'count_students' => Student::all()->count(),
            'male_count' => Student::where('jenis_kelamin', 'L')->count(),
            'female_count' => Student::where('jenis_kelamin', 'P')->count(),
        ]);
    }
}
