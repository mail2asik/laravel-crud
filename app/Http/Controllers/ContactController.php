<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactBulkStoreRequest;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Repositories\ContactRepository;

use App\Models\Contact;
use Exception;

class ContactController extends Controller
{
    protected $contactRepository;

    /**
     * ContactController constructor.
     * @param RecipeRepository $user
     */
    public function __construct(ContactRepository $contact)
    {
        $this->contactRepository = $contact;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page  = request()->input('page', 1);
        $limit = request()->input('limit', 5);
        $contacts = $this->contactRepository->getContacts($limit);
          
        return view('contacts.index', compact('contacts'))
                    ->with('i', ($page - 1) * $limit);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactStoreRequest $request)
    {
        $params = $request->validated();

        $this->contactRepository->create($params);
                  
        return redirect()->route('contacts.index')
                         ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uid)
    {
        try {
            $contact = $this->contactRepository->getContactByUid($uid);
            return view('contacts.show', compact('contact'));
        } catch (Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Contact not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uid)
    {
        try {
            $contact = $this->contactRepository->getContactByUid($uid);
            return view('contacts.edit', compact('contact'));
        } catch (Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Contact not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactUpdateRequest $request, string $uid)
    {
        try {

            $params = $request->validated();
            $contact = $this->contactRepository->updateContactByUid($params, $uid);
              
            return redirect()->route('contacts.index')
                        ->with('success', 'Contact updated successfully');

        } catch (Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Contact not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uid)
    {
        try {
            $contact = $this->contactRepository->deleteContactByUid($uid);
            return redirect()->route('contacts.index')
                        ->with('success', 'Contact deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Contact not found.');
        }
    }

    /**
     * Show the form for creating a bulk import contacts.
     */
    public function xmlBulkCreate()
    {
        return view('contacts.xmlBulkCreate');
    }

    /**
     * Store a newly created xml bulk import in storage.
     */
    public function xmlBulkStore(ContactBulkStoreRequest $request)
    {
        $params = $request->validated();

        $this->contactRepository->importContacts($request);
                  
        return redirect()->route('contacts.index')
                         ->with('success', 'Contact imported successfully.');
    }
}
