<?php

namespace App\Http\Livewire;

use App\Models\Customers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Admins as Admin;

class AdminAddEdit extends Component
{
    use WithFileUploads;

    public $urlPath = null, $adminRoles = [
        [
            'name' => 'Nəzarətçi',
            'id' => 1,
        ],
        [
            'name' => 'Müştəri',
            'id' => 2,
        ],
        [
            'name' => 'Baş admin',
            'id' => 3,
        ],
        [
            'name' => 'Səbət nəzarətçisi',
            'id' => 4,
        ],
    ], $market = false, $customers = null, $customer = null, $admin = null, $formFields = [
        'profilePhoto' => null,
        'role' => null,
        'customer_id' => null,
        'name' => null,
        'email' => null,
        'password' => null,
    ];

    public function mount($id = null)
    {
        $this->urlPath = request()->path();
        $this->customers = Customers::all();
        if ($id !== null) {
            $this->admin = Admin::where('id', $id)->get();
            $this->formFields = [
                'role' => $this->admin[0]->role,
                'customer_id' => $this->admin[0]->customer_id,
                'name' => $this->admin[0]->name,
                'email' => $this->admin[0]->email,
                'password' => $this->admin[0]->password,
            ];
        }
    }

    public function updated()
    {
        $this->validate([
            'formFields.profilePhoto' => 'max:10240',
            'formFields.role' => 'required|integer|max:11',
            'formFields.customer_id' => 'integer|max:11',
            'formFields.name' => 'required|max:300',
            'formFields.email' => 'required|max:300|email',
            'formFields.password' => 'required|max:50',
        ]);
    }

    public function save()
    {
        $uniqueName = Str::slug($this->formFields['name']);
        $this->formFields['profilePhoto']->storeAs('admins', $uniqueName . '.png', 'uploads');
        Admin::create([
            'profilePhoto' => $uniqueName . '.png',
            'role' => $this->formFields['role'],
            'customer_id' => $this->formFields['customer_id'] ? $this->formFields['customer_id'] : 1,
            'name' => $this->formFields['name'],
            'email' => $this->formFields['email'],
            'password' => Hash::make($this->formFields['password']),
        ]);

        $this->formFields = [
            'profilePhoto' => null,
            'role' => null,
            'customer_id' => null,
            'name' => null,
            'email' => null,
            'password' => null,
        ];
        session()->flash('message', 'Məlumatlar əlavə edildi!');
        $this->redirect('/admins');
    }

    public function update()
    {
        if (array_key_exists('profilePhoto', $this->formFields)) {
            if ($this->formFields['profilePhoto'] !== null) {
                $this->formFields['profilePhoto']->storeAs('admins', $this->admin[0]->profilePhoto, 'uploads');
            }
        }
        Admin::where('id', $this->admin[0]->id)->update([
            'role' => $this->formFields['role'],
            'customer_id' => $this->formFields['customer_id'] ? $this->formFields['customer_id'] : 1,
            'name' => $this->formFields['name'],
            'email' => $this->formFields['email'],
            'password' => Hash::make($this->formFields['password']),
        ]);

        $this->formFields = [
            'profilePhoto' => null,
            'role' => null,
            'customer_id' => null,
            'name' => null,
            'email' => null,
            'password' => null,
        ];
        session()->flash('message', 'Məlumatlar dəyişdirildi!');
        $this->redirect('/admins');
    }

    public function render()
    {
        return view('livewire.admin-add-edit');
    }
}
