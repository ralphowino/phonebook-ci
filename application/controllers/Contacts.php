<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once __DIR__ . '/Controller.php';

class Contacts extends Controller
{

    public function index()
    {
        $search = $this->input->get('search');
        $contacts = $this->user->contacts()->search($search)->paginate();
        $data = ['contacts' => $contacts, 'search' => $search];
        $this->view('contacts/index', $data);
    }

    public function create()
    {
        return $this->view('contacts/create');
    }

    public function store()
    {
        $data = $this->input->post(['first_name', 'last_name', 'email', 'phone', 'notes']);
        $data['user_id'] = $this->user->id;
        $this->user->contacts()->create($data);
        return redirect('contacts');
    }

    public function show()
    {
        $id = $this->uri->segment(2);
        $data['contact'] = $this->user->contacts()->findOrFail($id);
        return $this->view('contacts/show', $data);
    }

    public function edit()
    {
        $id = $this->uri->segment(2);
        $data['contact'] = $this->user->contacts()->findOrFail($id);
        return $this->view('contacts/edit', $data);
    }

    public function update()
    {
        $id = $this->uri->segment(2);
        $contact = $this->user->contacts()->findOrFail($id);
        $contact->update($this->input->post(['first_name', 'last_name', 'email', 'phone', 'notes']));
        return redirect('contacts/'. $id);
    }


    public function destroy()
    {
        $id = $this->uri->segment(2);
        $contact = $this->user->contacts()->findOrFail($id);
        $contact->delete();
        return redirect('contacts');
    }
}
